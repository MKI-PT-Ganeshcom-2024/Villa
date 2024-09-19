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

        // Mengambil user dengan role Staff atau Super Admin
        $users = User::whereIn('role', ['Staff', 'Resepsionis'])->get();

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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'jabatan' => $request->jabatan,
            ]);

            return redirect()->route('users.index')->with('success', 'User berhasil ditambahakan.');
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
        ]);

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'jabatan' => $request->jabatan,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
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
