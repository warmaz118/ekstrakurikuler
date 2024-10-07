@extends('layouts.app')

@section('content')
<div class=" mx-auto bg-white max-w-2xl shadow overflow-hidden sm:rounded-lg">
  <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
          {{ $siswa->user->name }}
      </h3>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">
          {{ $siswa->user->email }}
      </p>
  </div>
  <div class="border-t border-gray-200">
      <dl>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                  NIS
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  {{ $siswa->nis }}
              </dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                  Kelas
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  {{ $siswa->kelas }}
              </dd>
          </div>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                  Alamat
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  {{ $siswa->alamat }}
              </dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                  Divisi
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                @foreach($siswa->user->divisi as $divisi)
                {{ $divisi->nama }}@if(!$loop->last), @endif
            @endforeach
              </dd>
          </div>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                  Role
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                @foreach($siswa->user->roles as $role)
                {{ $role->name }}@if(!$loop->last), @endif
            @endforeach
              </dd>
          </div>
          <div class="flex ml-5 mt-3 mb-3 space-x-5">
            <a href="{{ route('siswasma.edit', $siswa->id) }}" class="bg-gradient-to-r from-lime-500 to-from-lime-500 hover:from-lime-500 hover:to-from-lime-500 text-black font-semibold px-6 py-3 cursor-pointer rounded-md">
                Edit
            </a>
            <a href="{{ route('siswasma.index', $siswa->id) }}" class="bg-gradient-to-r from-lime-500 to-from-lime-500 hover:from-lime-500 hover:to-from-lime-500 text-black font-semibold px-6 py-3 cursor-pointer rounded-md">
                Back
            </a>
            
          </div>
          
      </dl>
  </div>
</div>
<!-- component -->

@endsection
