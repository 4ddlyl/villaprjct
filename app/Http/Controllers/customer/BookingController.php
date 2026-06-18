<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Villa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    

    public function store(Request $request)
    {
        $request->validate([
            'villa_id' => 'required|exists:villas,id',
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'total_harga' => 'required|integer|min:0',
        ]);

        $villa = Villa::findOrFail($request->villa_id);

        $reservasi = Reservasi::create([
            'user_id' => Auth::id(),
            'villa_id' => $request->villa_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'total_harga' => $request->total_harga,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.reservasi.show', $reservasi->id)
            ->with('success', 'Reservasi berhasil dibuat! Silakan upload bukti pembayaran.');
    }
}