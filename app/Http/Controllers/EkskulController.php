<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Divisi;
use App\Models\Ekskul;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    public function index(Request $request)
{
    $perPage = $request->get('per_page', 10); // Ambil jumlah per halaman dari query string atau default 10

    $ekskuls = Ekskul::with('pembimbing')
        ->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->paginate($perPage);

    return view('ekskul.index', compact('ekskuls')); // Pastikan variabelnya adalah $ekskuls
}


    public function create()
    {
        $divisis = Divisi::all();
        $pembimbings = User::whereHas('roles', function($query) {
            $query->whereIn('role_id', [4, 5]); // role_id untuk pembimbing
        })->get();
        
        return view('ekskul.create', compact('divisis', 'pembimbings'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:ekskul|string|max:255',
        'deskripsi' => 'required|string',
        'lokasi' => 'required|string|max:255',
        'kapasitas' => 'required|integer|min:1',
        'pembimbing_id' => 'required|exists:users,id', // tambahkan validasi untuk pembimbing
    ]);

    // Set default jumlah_peserta ke 0
    $data = $request->all();
    $data['jumlah_peserta'] = 0;

    Ekskul::create($data);

    return redirect()->route('ekskul.index')->with('success', 'Ekskul berhasil ditambahkan.');
}



    public function edit($id)
    {
        $ekskul = Ekskul::findOrFail($id);
        $divisis = Divisi::all();
        $pembimbings = User::whereHas('roles', function($query) {
            $query->whereIn('role_id', [4, 5]); // role_id untuk pembimbing
        })->get();

        return view('ekskul.edit', compact('ekskul', 'divisis', 'pembimbings'));
    }

    public function update(Request $request, Ekskul $ekskul)
{
    $request->validate([
        'divisi_id' => 'required|exists:divisi,id',
        'name' => 'required|unique:ekskul,name,' . $ekskul->id . '|max:255', // Pastikan nama ekskul unik kecuali untuk ekskul yang sedang diupdate
        'deskripsi' => 'nullable|string',
        'lokasi' => 'required|string|max:255',
        'kapasitas' => 'nullable|integer',
            'jumlah_peserta' => 'nullable|integer',
        'pembimbing_id' => 'required|exists:users,id', // validasi untuk pembimbing
    ]);

    // Update data ekskul kecuali pembimbing_id
    $ekskul->update($request->except('pembimbing_id'));

    // Update pembimbing ekskul, menggunakan sync untuk memperbarui data
    $ekskul->pembimbing()->sync($request->pembimbing_id);

    return redirect()->route('ekskul.index')->with('success', 'Ekskul berhasil diperbarui');
}



    public function show($id)
    {
        $ekskul = Ekskul::findOrFail($id);
        return view('ekskul.show', compact('ekskul'));
    }


    public function destroy($id)
    {
        $ekskul = Ekskul::findOrFail($id);
        $ekskul->delete();
        return redirect()->route('ekskul.index')->with('success', 'Ekskul berhasil dihapus');
    }

    
}

