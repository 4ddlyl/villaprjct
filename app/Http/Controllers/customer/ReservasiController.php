<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Villa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReservasiController extends Controller
{
    // Daftar reservasi customer
    public function index()
    {
        $reservasis = Reservasi::with('villa')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('customer.reservasi.index', compact('reservasis'));
    }

    // Detail reservasi + form upload bukti
    public function show($id)
    {
        $reservasi = Reservasi::with('villa')
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        
        // Generate nomor booking
        $nomorBooking = '#RES-' . str_pad($reservasi->id, 3, '0', STR_PAD_LEFT);
        
        // Data bank
        $banks = [
            'BCA' => '172-456-987 a/n Luxury Villa Experience',
            'Mandiri' => '123-456-789 a/n Luxury Villa Experience',
            'BRI' => '987-654-321 a/n Luxury Villa Experience',
        ];
        
        return view('customer.reservasi.detail', compact('reservasi', 'nomorBooking', 'banks'));
    }

    // Upload bukti pembayaran
    public function uploadBukti(Request $request, $id)
    {
        $reservasi = Reservasi::where('user_id', Auth::id())->findOrFail($id);
        
        $request->validate([
            'bank' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $reservasi->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('bukti_pembayaran', $filename, 'public');
            
            $reservasi->update([
                'bukti_pembayaran' => $path,
                'status' => 'pending', // tetap pending sampai admin verifikasi
            ]);
        }
        
        return redirect()->route('customer.reservasi.show', $reservasi->id)
            ->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');
    }
}