<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role; // Import model Role

class SuperAdminUserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
{
    $users = User::with(['roles', 'divisi'])->get(); // Ambil semua pengguna dengan relasi roles dan divisi
    return view('superadmin.users.index', compact('users'));
}


    // Menampilkan form untuk menambahkan pengguna
    public function create()
{
    $roles = Role::all();
    $divisi = Divisi::all(); // Ambil semua divisi
    return view('superadmin.users.create', compact('roles', 'divisi'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'roles' => 'required|array',
        'roles.*' => 'exists:roles,id',
        'divisi' => 'required|array', // Validasi divisi
        'divisi.*' => 'exists:divisi,id', // Pastikan setiap divisi ada di tabel divisi
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Mengaitkan roles dan divisi dengan pengguna
    $user->roles()->attach($request->roles);
    $user->divisi()->attach($request->divisi);

    return redirect()->route('superadmin.users.index')->with('success', 'User created successfully.');
}

    // Menampilkan form untuk mengedit pengguna
    public function edit(User $user)
{
    $roles = Role::all();
    $divisi = Divisi::all(); // Ambil semua divisi
    return view('superadmin.users.edit', compact('user', 'roles', 'divisi'));
}

public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6|confirmed',
        'roles' => 'required|array',
        'roles.*' => 'exists:roles,id',
        'divisi' => 'required|array', // Validasi divisi
        'divisi.*' => 'exists:divisi,id', // Pastikan setiap divisi ada di tabel divisi
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    // Mengaitkan roles dan divisi dengan pengguna
    $user->roles()->sync($request->roles);
    $user->divisi()->sync($request->divisi); // Sync divisi

    return redirect()->route('superadmin.users.index')->with('success', 'User updated successfully.');
}


    // Menghapus pengguna
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('superadmin.users.index')->with('success', 'User deleted successfully.');
    }
}
