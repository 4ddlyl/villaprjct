<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class HistoryTransaksiController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $query = Reservasi::with(['user', 'villa']);

        // Filter status
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Filter tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($user) use ($search) {
                        $user->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('villa', function ($villa) use ($search) {
                        $villa->where('nama_villa', 'like', "%{$search}%");
                    });
            });
        }

        // Pagination
        $reservasis = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik
        $totalReservasi = Reservasi::count();
        $totalPending = Reservasi::where('status', 'pending')->count();
        $totalDibayar = Reservasi::where('status', 'dibayar')->count();
        $totalDitolak = Reservasi::where('status', 'ditolak')->count();
        $totalSelesai = Reservasi::where('status', 'selesai')->count();

        return view('admin.history_transaksi', compact(
            'reservasis',
            'totalReservasi',
            'totalPending',
            'totalDibayar',
            'totalDitolak',
            'totalSelesai'
        ));
    }

    public function detail($id)
    {
        $reservasi = Reservasi::with(['user', 'villa'])->findOrFail($id);
        return response()->json($reservasi);
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        // Optional: cek status reservasi (jangan hapus yang sudah dibayar)
        if ($reservasi->status === 'dibayar') {
            return redirect()->back()->with('error', 'Reservasi sudah dibayar, tidak bisa dihapus.');
        }

        // Hapus bukti pembayaran jika ada
        if ($reservasi->bukti_pembayaran) {
            Storage::disk('public')->delete($reservasi->bukti_pembayaran);
        }

        $reservasi->delete();

        return redirect()->back()->with('success', 'Reservasi berhasil dihapus.');
    }
}
