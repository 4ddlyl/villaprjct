<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Memeriksa apakah user belum login ATAU user bukan admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/admin/login')->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}
