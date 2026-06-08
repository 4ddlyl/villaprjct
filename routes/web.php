<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/booking', function () {
    $villas = \App\Models\Villa::where('status', 'tersedia')->get();
    return view('booking', compact('villas'));
})->name('booking.page');

Route::view('/about', 'about')->name('about.page');

// ROUTE ADMIN //
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Login Admin tanpa middleware, biar bisa diakses sebelum login //
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    
    // Dashboard Admin pakai middleware admin //
    Route::middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

});