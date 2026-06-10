<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;       
use App\Http\Controllers\Admin\DashboardController; 

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/booking', function () {
    $villas = \App\Models\Villa::where('status', 'tersedia')->get();
    return view('booking', compact('villas'));
})->name('booking.page');

Route::view('/about', 'about')->name('about.page');

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Login Admin (tanpa middleware)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Villa routes
    Route::get('/villa', [App\Http\Controllers\VillaController::class, 'index'])->name('villa');
    Route::post('/villa', [App\Http\Controllers\VillaController::class, 'store'])->name('villa.store');
    Route::put('/villa/{id}', [App\Http\Controllers\VillaController::class, 'update'])->name('villa.update');
    Route::delete('/villa/{id}', [App\Http\Controllers\VillaController::class, 'destroy'])->name('villa.destroy');
    Route::get('/villa/{id}', [App\Http\Controllers\VillaController::class, 'show'])->name('villa.detail');

});