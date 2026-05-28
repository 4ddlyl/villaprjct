<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ----- CUSTOMER -----
    public function showUploadForm($reservasiId)
    {
        $reservasi = Reservasi::with('villa')
            ->where('id', $reservasiId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $pembayaran = Pembayaran::where('booking_id', $reservasiId)->first();

        return view('customer.pembayaran', compact('reservasi', 'pembayaran'));
    }

    public function uploadBukti(Request $request, $reservasiId)
    {
        $request->validate([
            'bukti'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'metode' => 'required|string|max:50',
        ]);

        $reservasi = Reservasi::where('id', $reservasiId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($reservasi->status !== 'pending') {
            return back()->with('error', 'Reservasi sudah tidak bisa diubah.');
        }

        $path = $request->file('bukti')->store('bukti_pembayaran', 'public');

        $pembayaran = Pembayaran::firstOrNew(['booking_id' => $reservasiId]);
        if ($pembayaran->bukti_pembayaran && Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        $pembayaran->metode           = $request->metode;
        $pembayaran->bukti_pembayaran = $path;
        $pembayaran->status           = 'menunggu';
        $pembayaran->save();

        return redirect()->route('booking.index')
        ->with('success', 'Bukti pembayaran berhasil diupload. Admin akan menghubungi Anda via email untuk konfirmasi.');
    }

    public function history()
    {
        $reservasiList = Reservasi::with(['villa', 'pembayaran'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.history_transaksi', compact('reservasiList'));
    }

    // ----- ADMIN -----
    public function daftarVerifikasi()
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $pembayarans = Pembayaran::with(['reservasi.user', 'reservasi.villa'])
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.verifikasi_pembayaran', compact('pembayarans'));
    }

    public function verifikasiSetuju($pembayaranId)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $pembayaran = Pembayaran::findOrFail($pembayaranId);
        $pembayaran->update(['status' => 'diterima']);
        $pembayaran->reservasi->update(['status' => 'dibayar']);

        return back()->with('success', 'Pembayaran diterima.');
    }

    public function verifikasiTolak(Request $request, $pembayaranId)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate(['catatan' => 'required|string|max:255']);

        $pembayaran = Pembayaran::findOrFail($pembayaranId);
        $pembayaran->update([
            'status'            => 'ditolak',
            'catatan_penolakan' => $request->catatan,
        ]);

        return back()->with('error', 'Pembayaran ditolak: ' . $request->catatan);
    }
}