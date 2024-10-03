@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Super Admin Dashboard</h1>
    
    <!-- Tabel Pengguna -->
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">List of Users</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    @foreach ($user->roles as $role)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b">{{ $role->name }}</td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="3" class="py-2 px-4 text-center text-gray-600">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
