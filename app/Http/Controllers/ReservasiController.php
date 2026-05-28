<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Villa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function create()
    {
        $villas = Villa::all();
        return view('customer.reservasi', compact('villas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'villa_id'  => 'required|exists:villas,id',
            'checkin'   => 'required|date|after_or_equal:today',   // ← ganti check_in jadi checkin
            'checkout'  => 'required|date|after:checkin',          // ← ganti check_out jadi checkout
        ]);

        $villa = Villa::findOrFail($validated['villa_id']);
        $days = (strtotime($validated['checkout']) - strtotime($validated['checkin'])) / 86400;
        $total = $days * $villa->harga_per_malam;

        $reservasi = Reservasi::create([
            'user_id'     => Auth::id(),
            'villa_id'    => $villa->id,
            'checkin'     => $validated['checkin'],
            'checkout'    => $validated['checkout'],
            'total_harga' => $total,
            'status'      => 'pending', 
        ]);

        return redirect()->route('pembayaran.form', $reservasi->id)
                         ->with('success', 'Reservasi berhasil, silakan upload bukti pembayaran');
    }
}