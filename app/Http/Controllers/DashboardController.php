<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Villa;
use App\Models\Pembayaran;  
use App\Models\User;      
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Dashboard untuk customer
    public function customerDashboard()
    {
        // Ambil 5 reservasi terbaru milik customer ini
        $reservasiTerbaru = Reservasi::with('villa', 'pembayaran')
                                     ->where('user_id', Auth::id())
                                     ->orderBy('created_at', 'desc')
                                     ->take(5)
                                     ->get();

        // Hitung statistik sederhana
        $totalReservasi = Reservasi::where('user_id', Auth::id())->count();
        $totalDibayar = Reservasi::where('user_id', Auth::id())
                                 ->where('status', 'dibayar')
                                 ->count();
        $totalSelesai = Reservasi::where('user_id', Auth::id())
                                 ->where('status', 'selesai')
                                 ->count();

        return view('customer.dashboard', compact(
            'reservasiTerbaru',
            'totalReservasi',
            'totalDibayar',
            'totalSelesai'
        ));
    }

    // Dashboard untuk admin
    public function adminDashboard()
    {
        $totalReservasi = Reservasi::count();
        $totalPendapatan = Reservasi::where('status', 'dibayar')->sum('total_harga');
        $reservasiMenunggu = Reservasi::where('status', 'pending')->count();
        $verifikasiMenunggu = Pembayaran::where('status', 'menunggu')->count();
        $totalVilla = Villa::count();
        $customerAktif = User::where('role', 'customer')->where('status', 'active')->count();
        $reservasiTerbaru = Reservasi::with('user', 'villa')
                                     ->orderBy('created_at', 'desc')
                                     ->take(5)
                                     ->get();

        return view('admin.dashboard', compact(
            'totalReservasi',
            'totalPendapatan',
            'reservasiMenunggu',
            'verifikasiMenunggu',
            'totalVilla',
            'customerAktif',
            'reservasiTerbaru'
        ));
    }
}