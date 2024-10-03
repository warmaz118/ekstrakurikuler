@extends('layouts.app')

@section('title', 'Admin SMA Dashboard')

@section('content')
@if (session('error'))
    <div class="bg-red-500 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-4">Welcome, Admin SMP</h1>
    <p class="text-center text-gray-600">Manage SMP students, mentors, and activities here.</p>
</div>
@endsection
