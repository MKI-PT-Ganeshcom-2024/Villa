<?php

namespace App\Http\Controllers;

use App\Models\PenugasanStaff;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\User;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenugasanStaffController extends Controller
{
    private function getLayoutBasedOnRole()
    {
        $role = Auth::user()->role; // Ambil role dari pengguna yang sedang login

        // Tentukan layout berdasarkan role
        switch ($role) {
            case 'Superadmin':
                return 'web.role.superadmin.layouts.app';
            case 'Owner':
                return 'web.role.owner.layouts.app';
            case 'Admin':
                return 'web.role.admin.layouts.app';
            case 'Resepsionis':
                return 'web.role.resepsionis.layouts.app';
            case 'Staff':
                return 'web.role.staff.layouts.app';
            default:
                return 'web.default.layouts.app'; // Layout default jika role tidak sesuai
        }
    }

    // Menampilkan daftar penugasan staff
    public function index()
    {
        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        $penugasanStaff = PenugasanStaff::with(['kamar', 'reservasi', 'user', 'layanan'])->get();
        return view('web.penugasanStaff.daftar_penugasanStaff', compact('penugasanStaff', 'layout'));
    }

    // Menampilkan form untuk menambah penugasan staff
    public function create()
    {
        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        $kamar = Kamar::all();
        $reservasi = Reservasi::all();
        $users = User::all();
        $layanan = Layanan::all();

        return view('web.penugasanStaff.tambah_penugasanStaff', compact('kamar', 'reservasi', 'users', 'layanan', 'layout'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_reservasi' => 'nullable|exists:reservasi,id_reservasi',
            'id_kamar' => 'nullable|exists:kamar,id_kamar',
            'id_layanan' => 'nullable|exists:layanan,id_layanan', // Layanan bisa kosong
            'id' => 'required|exists:users,id', // ID staff harus ada
            'deskripsi_penugasan' => 'required',
            'tgl_penugasan' => 'required|date', // Validasi untuk tanggal
        ]);
    
        // Cek apakah reservasi atau kamar diisi
        if (!$request->id_reservasi && !$request->id_kamar) {
            return redirect()->back()->withErrors('Anda harus memilih reservasi atau kamar.');
        }
    
        // Penugasan untuk kamar yang sudah direservasi
        if ($request->id_reservasi) {
            if (!$request->id_layanan) {
                return redirect()->back()->withErrors('Layanan harus dipilih untuk kamar yang sudah direservasi.');
            }
    
            // Buat penugasan
            PenugasanStaff::create([
                'id_reservasi' => $request->id_reservasi,
                'id_layanan' => $request->id_layanan,
                'id' => $request->id, // ID staff
                'deskripsi_penugasan' => $request->deskripsi_penugasan,
                'tgl_penugasan' => $request->tgl_penugasan,
                'status_penugasan' => 'ditugaskan',
            ]);
        } else {
            // Penugasan untuk kamar yang belum direservasi
            PenugasanStaff::create([
                'id_kamar' => $request->id_kamar,
                'id' => $request->id, // ID staff
                'deskripsi_penugasan' => $request->deskripsi_penugasan,
                'tgl_penugasan' => $request->tgl_penugasan,
                'status_penugasan' => 'ditugaskan',
            ]);
        }
    
        return redirect()->route('penugasan_staff.index')->with('success', 'Penugasan staff berhasil ditambahkan.');
    }
      
    

    // Menampilkan form edit penugasan staff
    public function edit($id_penugasan)
    {
        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        $penugasanStaff = PenugasanStaff::findOrFail($id_penugasan);
        $kamar = Kamar::all();
        $reservasi = Reservasi::all();
        $users = User::all();
        $layanan = Layanan::all();

        return view('web.penugasanStaff.edit_penugasanStaff', compact('penugasanStaff', 'kamar', 'reservasi', 'users', 'layanan', 'layout'));
    }

    // Mengupdate data penugasan staff
    public function update(Request $request, $id_penugasan)
    {
        $penugasanStaff = PenugasanStaff::findOrFail($id_penugasan);
    
        // Validasi berdasarkan kondisi apakah penugasan untuk kamar yang sudah dipesan atau belum
        if ($request->has('id_reservasi') && $request->id_reservasi !== null) {
            // Kondisi 2: Penugasan untuk kamar yang sudah dipesan
            $request->validate([
                'id_reservasi' => 'required|exists:reservasi,id_reservasi',
                'id_layanan' => 'required|exists:layanan,id_layanan',
                'id' => 'required|exists:users,id',
                'deskripsi_penugasan' => 'required',
                'tgl_penugasan' => 'required|date',
                'status_penugasan' => 'required|in:ditugaskan,selesai',
            ]);
    
            $penugasanStaff->update([
                'id_reservasi' => $request->id_reservasi,
                'id_layanan' => $request->id_layanan,
                'id' => $request->id,
                'deskripsi_penugasan' => $request->deskripsi_penugasan,
                'tgl_penugasan' => $request->tgl_penugasan,
                'status_penugasan' => $request->status_penugasan,
            ]);
        } else {
            // Kondisi 1: Penugasan untuk kamar yang belum dipesan
            $request->validate([
                'id_kamar' => 'required|exists:kamar,id_kamar',
                'id' => 'required|exists:users,id',
                'deskripsi_penugasan' => 'required',
                'tgl_penugasan' => 'required|date',
                'status_penugasan' => 'required|in:ditugaskan,selesai',
            ]);
    
            $penugasanStaff->update([
                'id_kamar' => $request->id_kamar,
                'id' => $request->id,
                'deskripsi_penugasan' => $request->deskripsi_penugasan,
                'tgl_penugasan' => $request->tgl_penugasan,
                'status_penugasan' => $request->status_penugasan,
            ]);
        }
    
        return redirect()->route('penugasan_staff.index')->with('success', 'Penugasan staff berhasil diupdate.');
    }
    

    // Menghapus penugasan staff
    public function destroy($id)
    {
        $penugasanStaff = PenugasanStaff::findOrFail($id);
        $penugasanStaff->delete();

        return redirect()->route('penugasan_staff.index')->with('success', 'Penugasan staff berhasil dihapus.');
    }
}
