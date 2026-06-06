<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/booking', function () {
    $villas = \App\Models\Villa::where('status', 'tersedia')->get();
    return view('booking', compact('villas'));
})->name('booking.page');