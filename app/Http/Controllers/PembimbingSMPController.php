<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PembimbingSMPController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'divisi'])
            ->whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['Super Admin', 'Siswa SMP', 'Siswa SMA', 'Pembimbing SMA', 'Admin SMP', 'Admin SMA']);
            })
            ->get();
    
        return view('pembimbing.smp.index', compact('users'));
    }
    
public function show(User $user)
{
    return view('pembimbing.smp.show', compact('user'));
}



    // Menampilkan form untuk menambahkan pengguna
    public function create()
{
    // Mengambil role Pembimbing SMA
    $roles = Role::where('name', 'Pembimbing SMP')->get();

    // Mengambil divisi SMA
    $divisi = Divisi::where('nama', 'SMP')->get(); // Sesuaikan dengan kolom nama pada tabel divisi

    return view('pembimbing.smp.create', compact('roles', 'divisi'));
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

    return redirect()->route('pembimbingsmp.index')->with('success', 'User created successfully.');
}

    // Menampilkan form untuk mengedit pengguna
    public function edit(User $user)
{
    $roles = Role::whereIn('name', ['Pembimbing SMP', 'Admin SMP'])->get();

    // Mengambil divisi SMA
    $divisi = Divisi::where('nama', 'SMP')->get(); // Sesuaikan dengan kolom nama pada tabel divisi
    return view('pembimbing.smp.edit', compact('user', 'roles', 'divisi'));
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

    return redirect()->route('pembimbingsmp.index')->with('success', 'User updated successfully.');
}


    // Menghapus pengguna
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('pembimbingsmp.index')->with('success', 'User deleted successfully.');
    }
}
