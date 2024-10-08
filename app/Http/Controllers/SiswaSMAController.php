<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;

class SiswaSMAController extends Controller
{
    public function index(Request $request)
{
    $perPage = $request->input('per_page', 5); // Default 5 item per halaman
    $search = $request->input('search'); // Menerima input pencarian

    $status = $request->input('status');

    $siswa = Siswa::with(['user', 'divisi'])
    ->whereHas('user.roles', function ($query) {
        $query->where('name', 'Siswa SMA');
    })
    ->whereHas('divisi', function ($query) {
        $query->where('nama', 'SMA');
    })
    ->when($search, function ($query, $search) {
        return $query->whereHas('user', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        });
    })
    ->when($status && $status != 'All', function ($query) use ($status) {
        if ($status == 'Active') {
            return $query->whereHas('user', function ($query) {
                $query->where('isactive', 1);
            });
        } elseif ($status == 'Not Active') {
            return $query->whereHas('user', function ($query) {
                $query->where('isactive', 0);
            });
        }
    })
    ->paginate($perPage);


    return view('siswa.sma.index', compact('siswa'));
}

    public function create()
    {
        $roles = Role::where('name', 'Siswa SMA')->pluck('name', 'id');
        $divisi = Divisi::where('nama', 'SMA')->pluck('nama', 'id');
        return view('siswa.sma.create', compact('roles', 'divisi'));
    }

    public function store(StoreSiswaRequest $request)
    {
        // dd($request->all());

        DB::transaction(function () use ($request) {
            try {
                // Simpan ke tabel users
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
        
                // Simpan role_user
                $user->roles()->attach($request->role_id);
        
                // Simpan divisi
                $user->divisi()->attach($request->divisi_id);
        
                // Simpan ke tabel siswa
                Siswa::create([
                    'nis' => $request->nis,
                    'kelas' => $request->kelas,
                    'alamat' => $request->alamat,
                    'user_id' => $user->id,
                    'divisi_id' => $request->divisi_id,
                ]);
            } catch (\Exception $e) {
                // Debugging
                dd($e->getMessage());
            }
        });
        
        return redirect()->route('siswasma.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function show($id)
{
    $siswa = Siswa::with(['user', 'divisi'])->findOrFail($id); // Mengambil siswa beserta relasi user dan divisi
    return view('siswa.sma.show', compact('siswa'));
}

    
    


    public function edit($id)
{
    $siswa = Siswa::findOrFail($id);  // Cari siswa berdasarkan id
    $roles = Role::where('name', 'Siswa SMA')->pluck('name', 'id');
    $divisi = Divisi::where('nama', 'SMA')->pluck('nama', 'id');
    return view('siswa.sma.edit', compact('siswa', 'roles', 'divisi'));
}





public function update(UpdateSiswaRequest $request, Siswa $siswa)
{
    // Logika update data
    DB::transaction(function () use ($request, $siswa) {
        $siswa->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $siswa->user->password,
        ]);

        $siswa->user->roles()->sync($request->role_id);
        $siswa->user->divisi()->sync($request->divisi_id);

        $siswa->update([
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'divisi_id' => $request->divisi_id,
        ]);
    });

    return redirect()->route('siswasma.index')->with('success', 'Siswa berhasil diperbarui');
}



    public function destroy(Siswa $siswa)
    {
        DB::transaction(function () use ($siswa) {
            $siswa->user->roles()->detach();
            $siswa->user->divisi()->detach();
            $siswa->user->delete();
            $siswa->delete();
        });

        return redirect()->route('siswasma.index')->with('success', 'Siswa berhasil dihapus');
    }
}
