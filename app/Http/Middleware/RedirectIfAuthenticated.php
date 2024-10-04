<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        // Jika user sudah login, alihkan berdasarkan role mereka
        if (Auth::check()) {
            $user = Auth::user();
            $userRoles = $user->roles->pluck('name')->toArray();

            if (in_array('Super Admin', $userRoles)) {
                return redirect()->route('superadmin.index');
            } elseif (in_array('Admin SMA', $userRoles)) {
                return redirect()->route('admin.sma.index');
            } elseif (in_array('Admin SMP', $userRoles)) {
                return redirect()->route('admin.smp.index');
            } elseif (in_array('Pembimbing SMA', $userRoles)) {
                return redirect()->route('pembimbing.sma.index');
            } elseif (in_array('Pembimbing SMP', $userRoles)) {
                return redirect()->route('pembimbing.smp.index');
            } elseif (in_array('Siswa SMA', $userRoles)) {
                return redirect()->route('siswa.sma.index');
            } elseif (in_array('Siswa SMP', $userRoles)) {
                return redirect()->route('siswa.smp.index');
            }

            return redirect()->route('home'); // Default redirect jika tidak ada role yang sesuai
        }

        return $next($request);
    }
}
