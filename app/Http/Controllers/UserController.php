<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        // Mengambil user dengan role Staff, Resepsionis, Owner, dan Admin, dan urutkan berdasarkan nama
        $users = User::whereIn('role', ['Staff', 'Resepsionis', 'Owner', 'Admin'])->orderBy('name', 'asc')->get();

        return view('web.users.daftar_user', compact('users', 'layout'));
    }

    public function create()
    {
        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        return view('web.users.tambah_user', compact('layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Validasi email harus unik
            'password' => 'required|min:8|confirmed', // Validasi password dan konfirmasi password
            'role' => 'required',
        ],[
            'email.unique' => 'Email sudah ada. Silakan masukkan email yang berbeda.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai dengan password.'
        ]);
    
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'jabatan' => $request->jabatan,
            ]);
    
            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Gagal menambahkan user.');
        }
    }
    

    public function edit(User $user)
    {
        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        return view('web.users.edit_user', compact('user', 'layout'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'status_user' => 'required|in:Aktif,Nonaktif',
        ]);
    
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'jabatan' => $request->jabatan,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'status_user' => $request->status_user, // Tambahkan ini untuk mengupdate status_user
            ]);
    
            return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Gagal memperbarui user.');
        }
    }
    

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Gagal menghapus user.');
        }
    }
}
