@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold">Detail Pengguna: {{ $user->name }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6 mt-4">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Divisi:</strong> 
            @foreach($user->divisi as $divisi)
                {{ $divisi->nama }}@if(!$loop->last), @endif
            @endforeach
        </p>
        <p><strong>Roles:</strong> 
            @foreach($user->roles as $role)
                {{ $role->name }}@if(!$loop->last), @endif
            @endforeach
        </p>
    </div>

    <div class="mt-4 mr-16">
        <a href="{{ route('adminsma.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Edit Pengguna
        </a>
        {{-- <form action="{{ route('superadmin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Hapus Pengguna
            </button>
        </form> --}}
        <a href="{{ route('adminsma.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</div>
@endsection
