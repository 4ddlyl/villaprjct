<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',  // ← ubah dari email ke username
            'password' => 'required',
        ]);

        // Coba login dengan username
        if (Auth::attempt($credentials)) {
            // Cek apakah role-nya admin
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->withErrors(['username' => 'Akses ditolak. Bukan akun admin.']);
            }

            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login')->with('success', 'Anda telah keluar');
    }
}