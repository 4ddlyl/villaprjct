<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    // FR-01: Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',  // ← pakai username, bukan email
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect sesuai role (FR-01)
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('//');
        }

        return back()->withErrors(['username' => 'Username atau password salah'])->onlyInput('username');
    }

    // FR-02: Tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // FR-02: Proses registrasi
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|min:3|max:50|unique:users', // ← unique
            'email'    => 'required|email|unique:users',
            'phone'    => 'nullable|string|max:15',  // ← FR-02 minta data diri termasuk no HP
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role'     => 'user',  // ← default user, bukan customer
        ]);

        Auth::login($user);
        return redirect()->route('user.dashboard');
    }

    // FR-12: Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Anda telah keluar');
    }
}