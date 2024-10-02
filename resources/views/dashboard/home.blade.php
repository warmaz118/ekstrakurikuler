@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

 <!-- Main Content -->
 <div class="flex-1 p-10">
    <h1 class="text-3xl font-bold text-gray-700">Selamat Datang, {{ Auth::user()->name }}!</h1>
    <p class="mt-2 text-gray-600">Ini adalah halaman dashboard aplikasi ekstrakurikuler.</p>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-xl font-semibold">Total Ekstrakurikuler</h2>
            <p class="text-3xl font-bold">10</p>
        </div>
        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-xl font-semibold">Total Siswa</h2>
            <p class="text-3xl font-bold">200</p>
        </div>
        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-xl font-semibold">Total Pembimbing</h2>
            <p class="text-3xl font-bold">5</p>
        </div>
    </div>
</div>
</div>

@endsection