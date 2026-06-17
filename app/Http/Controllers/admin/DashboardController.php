<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;  // ini model yang mapping ke tabel bookings
use App\Models\Villa;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Reservasi (dari tabel bookings)
        $totalReservasi = Reservasi::count();
        
        // Total Pendapatan (hanya yang status dibayar)
        $totalPendapatan = Reservasi::where('status', 'dibayar')->sum('total_harga');
        
        // Reservasi yang pending
        $reservasiMenunggu = Reservasi::where('status', 'pending')->count();
        
        // Verifikasi menunggu (sudah upload bukti tapi belum dicek admin)
        $verifikasiMenunggu = 0;
        
        // Total Villa
        $totalVilla = Villa::count();
        
        // Customer Aktif (yang pernah booking)
        $customerAktif = User::where('role', 'customer')
                     ->where('status', 'active')
                     ->count();
        
        // Reservasi Terbaru (5 data)
        $reservasiTerbaru = Reservasi::with(['user', 'villa'])
                                     ->orderBy('created_at', 'desc')
                                     ->take(5)
                                     ->get();
        
        // Data untuk chart 7 hari terakhir
        $reservasiPerHari = [];
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = now()->subDays($i);
            $jumlah = Reservasi::whereDate('created_at', $tanggal)->count();
            $reservasiPerHari[] = [
                'tanggal' => $tanggal->format('d M'),
                'jumlah' => $jumlah
            ];
        }
        
        return view('admin.dashboard', compact(
    'totalReservasi',
    'totalPendapatan', 
    'reservasiMenunggu',
    'verifikasiMenunggu',
    'totalVilla',
    'customerAktif',
    'reservasiTerbaru',
    'reservasiPerHari'
));
    }
}