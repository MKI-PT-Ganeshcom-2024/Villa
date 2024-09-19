<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FasilitasController extends Controller
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
          // Dapatkan layout berdasarkan role
          $layout = $this->getLayoutBasedOnRole();

        $fasilitas = Fasilitas::all(); // Ambil semua data fasilitas
        return view('web.fasilitas.daftar_fasilitas', compact('fasilitas','layout'));
    }

    public function create()
    {
        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        return view('web.fasilitas.tambah_fasilitas', compact('layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|max:45',
        ]);
    
        try {
            Fasilitas::create($request->all());
            return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('fasilitas.index')->with('error', 'Gagal menambahkan fasilitas');
        }
    }

    public function edit($id)
    {
        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();
        
        $fasilitas = Fasilitas::find($id);
        return view('web.fasilitas.edit_fasilitas', compact('fasilitas','layout'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_fasilitas' => 'required|max:45',
        ]);
    
        try {
            $fasilitas = Fasilitas::find($id);
            $fasilitas->update($request->all());
            return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('fasilitas.index')->with('error', 'Gagal memperbarui fasilitas');
        }
    }

    public function destroy($id)
    {
        try {
            Fasilitas::find($id)->delete();
            return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('fasilitas.index')->with('error', 'Gagal menghapus fasilitas');
        }
    }
}
