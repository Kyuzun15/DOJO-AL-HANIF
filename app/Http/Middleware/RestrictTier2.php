<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictTier2
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'tier_2') {
            $allowedPrefixes = ['dashboard', 'admin/absensi', 'admin/profile'];
            $path = $request->path();
            
            $isAllowed = false;
            foreach ($allowedPrefixes as $prefix) {
                if ($path === $prefix || str_starts_with($path, $prefix . '/')) {
                    $isAllowed = true;
                    break;
                }
            }

            if (!$isAllowed) {
                return redirect('/dashboard')->with('error', 'Akses Ditolak: Tier 2 hanya bisa mengakses Absensi dan Profil Admin.');
            }
        }

        return $next($request);
    }
}
