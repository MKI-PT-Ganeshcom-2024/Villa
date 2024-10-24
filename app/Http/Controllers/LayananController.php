<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayananController extends Controller
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

    public function index()
    {
        
        // Ambil semua data layanan dan urutkan berdasarkan 'kategori_layanan'
        $layanan = Layanan::orderBy('kategori_layanan', 'asc')->get();

        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        return view('web.layanan.daftar_layanan', compact('layanan','layout'));
    }

    public function create()
    {
        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        // Tampilkan form untuk menambah layanan baru
        return view('web.layanan.tambah_layanan', compact('layout'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kategori_layanan' => 'required',
            'nama_layanan' => 'required',
            'harga_layanan_raw' => 'required|numeric', // Validasi untuk harga_layanan_raw
            'deskripsi_layanan' => 'nullable',
        ]);
    
        try {
            // Ganti harga_layanan dengan harga_layanan_raw
            Layanan::create(array_merge($request->all(), [
                'harga_layanan' => $request->harga_layanan_raw
            ]));
    
            return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('layanan.index')->with('error', 'Gagal menambahkan layanan.');
        }
    }

    public function edit(Layanan $layanan)
    {
        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        // Tampilkan form untuk edit layanan
        return view('web.layanan.edit_layanan', compact('layanan', 'layout'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_layanan' => 'required|string',
            'nama_layanan' => 'required|string',
            'harga_layanan' => 'required|string', // Ubah ini sesuai kebutuhan
            'deskripsi_layanan' => 'nullable|string',
            'status_layanan' => 'required|string',
        ]);
    
        $layanan = Layanan::findOrFail($id);
        $layanan->kategori_layanan = $request->kategori_layanan;
        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->harga_layanan = intval(str_replace('.', '', $request->input('harga_layanan')));
        $layanan->deskripsi_layanan = $request->deskripsi_layanan;
        $layanan->status_layanan = $request->status_layanan;
        $layanan->save();
    
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }    

    public function destroy(Layanan $layanan)
    {
        try {
            $layanan->delete();
            return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('layanan.index')->with('error', 'Gagal menghapus layanan.');
        }   
    }
}
