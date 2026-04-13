<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
{
    // Jika user sudah login DAN pangkatnya sesuai dengan yang diminta...
    if (Auth::check() && Auth::user()->role == $role) {
        return $next($request); // Silakan lewat
    }

    // Jika tidak sesuai, lempar balik ke dashboard dengan pesan error
    return redirect('/dashboard')->with('error', 'Maaf, Anda tidak punya akses ke fitur Tier 1!');
}
}
