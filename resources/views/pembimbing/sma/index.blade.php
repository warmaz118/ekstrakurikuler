@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-4">Daftar Pengguna</h1>

    @if(session('error'))
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif


    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Roles</th>
                <th class="py-2 px-4 border-b">Divisi</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">
                        @foreach($user->roles as $role)
                            <span class="inline-block bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="py-2 px-4 border-b">
                        @foreach($user->divisi as $d)
                            <span class="inline-block bg-green-200 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $d->nama }}</span>
                        @endforeach
                    </td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('pembimbingsma.edit', $user->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                        <form action="{{ route('pembimbingsma.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <a href="{{ route('pembimbingsma.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add User</a>
    </div>
</div>
@endsection
