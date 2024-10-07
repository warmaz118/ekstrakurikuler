@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Add User</h1>
    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pembimbingsmp.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Roles</label>
            @foreach ($roles as $role)
                <div class="flex items-center">
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="mr-2">
                    <span>{{ $role->name }}</span>
                </div>
            @endforeach
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Divisi</label>
            @foreach ($divisi as $d)
                <div class="flex items-center">
                    <input type="checkbox" name="divisi[]" value="{{ $d->id }}" class="mr-2">
                    <span>{{ $d->nama }}</span>
                </div>
            @endforeach
        </div>
        
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create User</button>
    </form>
</div>
@endsection
