<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $roles = $user->roles; // Dapatkan semua role user
        
        if ($roles->isNotEmpty()) {
            // Asumsikan user memiliki satu role (misalnya yang pertama)
            $role = $roles->first()->name;
            
            // Redirect berdasarkan role
            switch($role) {
                case 'Super Admin':
                    return redirect()->route('superadmin.index');
                case 'Admin SMP':
                    return redirect()->route('admin.smp.index');
                case 'Admin SMA':
                    return redirect()->route('admin.sma.index');
                case 'Pembimbing SMP':
                    return redirect()->route('pembimbing.smp.index');
                case 'Pembimbing SMA':
                    return redirect()->route('pembimbing.sma.index');
                case 'Siswa SMP':
                    return redirect()->route('siswa.smp.index');
                case 'Siswa SMA':
                    return redirect()->route('siswa.sma.index');
                default:
                    return redirect()->route('home');
            }
        } else {
            return redirect()->route('home')->withErrors(['error' => 'Role tidak ditemukan']);
        }
    } else {
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
