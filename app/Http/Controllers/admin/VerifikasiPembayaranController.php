<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class VerifikasiPembayaranController extends Controller
{
    public function index()
    {
        // Data untuk statistik
        $menungguVerifikasi = Reservasi::where('status', 'pending')
                                       ->whereNotNull('bukti_pembayaran')
                                       ->count();
        
        $terverifikasi = Reservasi::where('status', 'dibayar')->count();
        
        $ditolak = Reservasi::where('status', 'ditolak')->count();
        
        $totalTransaksi = Reservasi::where('status', 'dibayar')->sum('total_harga');
        
        // Data reservasi yang butuh verifikasi (pending dan sudah upload bukti)
        $reservasi = Reservasi::with(['user', 'villa'])
                              ->where('status', 'pending')
                              ->whereNotNull('bukti_pembayaran')
                              ->orderBy('created_at', 'desc')
                              ->get();
        
        return view('admin.verifikasi_pembayaran', compact(
            'menungguVerifikasi',
            'terverifikasi',
            'ditolak',
            'totalTransaksi',
            'reservasi'
        ));
    }
    
    public function verifikasi($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status' => 'dibayar']);
        
        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi');
    }
    
    public function tolak($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status' => 'ditolak']);
        
        return redirect()->back()->with('success', 'Pembayaran ditolak');
    }
    
    public function showBukti($id)
    {
        $reservasi = Reservasi::with(['user', 'villa'])->findOrFail($id);
        
        // Modal preview bukti pembayaran
        return view('admin.modal_bukti', compact('reservasi'));
    }
}