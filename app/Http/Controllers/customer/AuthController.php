<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman register
    public function showRegister()
    {
        return view('customer.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'terms' => 'accepted',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'status' => 'active',
        ]);

        return redirect()->route('customer.login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // Tampilkan halaman login
    public function showLogin()
    {
        return view('customer.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek apakah user login dengan username atau email
        $field = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Cari user berdasarkan username/email
        $user = User::where($field, $request->username)->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return back()->withErrors([
                'username' => 'Username atau email tidak ditemukan'
            ])->onlyInput('username');
        }

        // Jika user statusnya banned, tolak login
        if ($user->status === 'banned') {
            return back()->withErrors([
                'username' => 'Akun Anda telah dibanned, karena ' . ($user->alasan_ban ?? '')
            ])->onlyInput('username');
        }

        // Coba login
        $credentials = [
            $field => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika admin, redirect ke dashboard admin
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Jika customer, redirect ke halaman utama
            return redirect()->intended('/');
        }

        // Jika password salah
        return back()->withErrors([
            'username' => 'Password salah'
        ])->onlyInput('username');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout');
    }
}