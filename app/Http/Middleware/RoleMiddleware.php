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

        $user = Auth::user();

        // Dapatkan semua role user yang login (relasi many-to-many)
        $userRoles = $user->roles->pluck('name')->toArray();

        Log::info('User roles:', ['roles' => $userRoles]);

        // Periksa apakah user memiliki salah satu role yang diizinkan
        if (!array_intersect($userRoles, $roles)) {

            if (in_array('Super Admin', $userRoles)) {
                return redirect()->route('superadmin.index');
            } elseif (in_array('Admin SMA', $userRoles)) {
                return redirect()->route('adminsma.index')->with('error', 'You do not have access to this page.');
            } elseif (in_array('Admin SMP', $userRoles)) {
                return redirect()->route('adminsmp.index');
            } elseif (in_array('Pembimbing SMA', $userRoles)) {
                return redirect()->route('pembimbingsma.index');
            } elseif (in_array('Pembimbing SMP', $userRoles)) {
                return redirect()->route('pembimbingsmp.index');
            } elseif (in_array('Siswa SMA', $userRoles)) {
                return redirect()->route('siswasma.index');
            } elseif (in_array('Siswa SMP', $userRoles)) {
                return redirect()->route('siswasmp.index');
            }

            return redirect()->route('home')->with('error', 'You do not have access to this page.');
        }

        $response = $next($request);

        return $response->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                       ->header('Pragma', 'no-cache')
                       ->header('Expires', '0');
    }
}
