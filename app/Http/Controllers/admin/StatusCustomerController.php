<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusCustomerController extends Controller
{
    public function index()
    {
        // Ambil semua customer (role = customer)
        $customers = User::where('role', 'customer')
                         ->withCount('reservasis')
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);
        
        // Statistik
        $totalCustomers = User::where('role', 'customer')->count();
        $activeCustomers = User::where('role', 'customer')
                               ->where('status', 'active')  // ← PERBAIKI: is_banned → status
                               ->count();
        $bannedCustomers = User::where('role', 'customer')
                               ->where('status', 'banned')  // ← PERBAIKI: is_banned → status
                               ->count();
        $haventReserved = User::where('role', 'customer')
                              ->whereDoesntHave('reservasis')
                              ->count();
        
        return view('admin.status_customer', compact(
            'customers',
            'totalCustomers',
            'activeCustomers',
            'bannedCustomers',
            'haventReserved'
        ));
    }
    
    public function detail($id)
{
    $customer = User::with(['reservasis' => function($query) {
        $query->with('villa')->orderBy('created_at', 'desc')->take(5);
    }])->findOrFail($id);
    
    $totalReservasi = $customer->reservasis()->count();
    $totalBelanja = $customer->reservasis()->where('status', 'dibayar')->sum('total_harga');
    
    // Return JSON untuk JavaScript
    return response()->json([
        'id' => $customer->id,
        'name' => $customer->name,
        'email' => $customer->email,
        'status' => $customer->status,
        'created_at' => $customer->created_at,
        'total_reservasi' => $totalReservasi,
        'total_belanja' => $totalBelanja,
        'reservasis' => $customer->reservasis->map(function($item) {
            return [
                'checkin' => $item->checkin,
                'villa' => $item->villa ? ['nama_villa' => $item->villa->nama_villa] : null,
                'total_harga' => $item->total_harga,
                'status' => $item->status,
            ];
        }),
    ]);
}
    
    public function toggleBan(Request $request, $id)
{
    $customer = User::findOrFail($id);
    
    // Toggle status
    $customer->status = $customer->status === 'active' ? 'banned' : 'active';
    
    // Jika di-ban, simpan alasan
    if ($customer->status === 'banned') {
        $customer->alasan_ban = $request->input('alasan_ban');  // ← TANGKAP ALASAN
    }
    
    // Jika di-unban, hapus alasan
    if ($customer->status === 'active') {
        $customer->alasan_ban = null;
    }
    
    $customer->save();
    
    
    $status = $customer->status === 'banned' ? 'diblokir' : 'diaktifkan';
    return redirect()->back()->with('success', "Customer berhasil {$status}");
}
}