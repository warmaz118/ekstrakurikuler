@extends('layouts.app')

@section('content')


<!-- component -->
<body class="bg-gray-100">
    <div class="max-w-lg mx-auto my-10 bg-white rounded-lg shadow-md p-5">
      <img class="w-32 h-32 rounded-full mx-auto" src="https://picsum.photos/200" alt="Profile picture">
      <h2 class="text-center text-2xl font-semibold mt-3">{{ $user->name }}</h2>
      <p class="text-center text-gray-600 mt-1">{{ $user->email }}</p>
      <p class="text-center text-gray-600 mt-1">Divisi
        @foreach($user->divisi as $divisi)
            {{ $divisi->nama }}@if(!$loop->last), @endif
         @endforeach
        </p>
        <p class="text-center text-gray-600 mt-1">Roles
            @foreach($user->roles as $role)
                {{ $role->name }}@if(!$loop->last), @endif
            @endforeach
            </p>
      <div class="flex justify-center mt-5">
        <a href="#" class="text-blue-500 hover:text-blue-700 mx-3">Twitter</a>
        <a href="#" class="text-blue-500 hover:text-blue-700 mx-3">Instagram</a>
        <a href="#" class="text-blue-500 hover:text-blue-700 mx-3">WhatsApp</a>
      </div>
      <div class="mt-5">
        <h3 class="text-xl font-semibold text-center">Bio</h3>
        <p class="text-gray-600 mt-2 text-center">"Mendidik bukan hanya tentang memberi pengetahuan, tetapi tentang menumbuhkan karakter dan kepercayaan diri."</p>
      </div>
      <div class="flex justify-center mt-5 space-x-5">
        <a href="{{ route('superadmin.users.edit', $user->id) }}" class="bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-500 text-white font-semibold px-6 py-3 cursor-pointer rounded-md">
            Edit
        </a>
            
            <a href="{{ route('superadmin.users.index') }}" class="bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-500 text-white font-semibold px-6 py-3 cursor-pointer rounded-md">
                Back
            </a>
        </div>
    </div>
  </body>
@endsection
