<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('superadmin.index');
    }
    public function users()
    {
        // Ambil semua pengguna dengan relasi role
        $users = User::with('roles')->get();

        // Kirim data ke view
        return view('superadmin.users', compact('users'));
    }

}
