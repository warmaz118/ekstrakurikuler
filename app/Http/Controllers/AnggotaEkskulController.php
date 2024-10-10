<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Divisi;
use App\Models\Ekskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaEkskulController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $perPage = $request->get('per_page', 5); // Ambil jumlah per halaman dari query string atau default 5
    $user = Auth::user(); // Ambil user yang sedang login

    // Hanya ekskul yang sesuai dengan pembimbing yang sedang login
    $ekskuls = Ekskul::with('pembimbing')
        ->whereHas('pembimbing', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })
        ->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->paginate($perPage);

    return view('ekskul.anggota.index', compact('ekskuls')); // Pastikan variabelnya adalah $ekskuls
}
public function getEkskulByDivisi($divisiId)
{
    $user = Auth::user(); // Ambil user yang sedang login

    // Ambil ekskul berdasarkan divisi_id dan juga pembimbing yang sesuai
    $ekskuls = Ekskul::where('divisi_id', $divisiId)
        ->whereHas('pembimbing', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })
        ->get();

    return response()->json($ekskuls);
}


public function getSiswaByDivisi($divisiId)
{
    // Ambil siswa berdasarkan divisi_id dan join dengan tabel users untuk mengambil nama siswa
    $siswas = Siswa::where('divisi_id', $divisiId)
        ->with('user:id,name') // Eager load relasi ke tabel users untuk ambil id dan name
        ->get();

    // Map data untuk mengembalikan data yang sesuai untuk JSON response
    $data = $siswas->map(function($siswa) {
        return [
            'id' => $siswa->id,
            'name' => $siswa->user->name . ' - ' . ' Kelas ' . $siswa->kelas, // Gabungkan nama siswa dengan kelas
        ];
    });

    return response()->json($data);
}







    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user(); // Ambil user yang sedang login
    
        // Ambil divisi yang terkait dengan ekskul yang diajar oleh pembimbing
        $divisis = Divisi::whereHas('ekskuls.pembimbing', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->get();
    
        // Ambil ekskul yang terkait dengan pembimbing yang sedang login
        $ekskuls = Ekskul::whereHas('pembimbing', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->get();
    
        return view('ekskul.anggota.create', compact('divisis', 'ekskuls'));
    }
    



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
