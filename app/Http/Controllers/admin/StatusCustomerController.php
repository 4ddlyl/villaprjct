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
                               ->where('is_banned', false)
                               ->count();
        $bannedCustomers = User::where('role', 'customer')
                               ->where('is_banned', true)
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
        
        return view('admin.modal_customer_detail', compact('customer', 'totalReservasi', 'totalBelanja'));
    }
    
    public function toggleBan($id)
    {
        $customer = User::findOrFail($id);
        $customer->is_banned = !$customer->is_banned;
        $customer->save();
        
        $status = $customer->is_banned ? 'diblokir' : 'diaktifkan';
        return redirect()->back()->with('success', "Customer berhasil {$status}");
    }
}