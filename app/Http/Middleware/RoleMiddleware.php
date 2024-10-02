<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Periksa apakah pengguna terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        Log::info('User role:', ['role' => Auth::user()->role->name]);
        // Periksa apakah pengguna memiliki role yang sesuai
        if (!in_array(Auth::user()->role->name, $roles)) {
            return redirect()->route('home')->with('error', 'You do not have access to this page.');
        }

        $response = $next($request);
        return $response->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                       ->header('Pragma', 'no-cache')
                       ->header('Expires', '0');
        // return $next($request);
    }
}
