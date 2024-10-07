@extends('layouts.app')

@section('title', 'Edit User')

@section('content')


<!-- component -->
<!-- Code on GiHub: https://github.com/vitalikda/form-floating-labels-tailwindcss -->
<style>
    .-z-1 {
      z-index: -1;
    }
  
    .origin-0 {
      transform-origin: 0%;
    }
  
    input:focus ~ label,
    input:not(:placeholder-shown) ~ label,
    textarea:focus ~ label,
    textarea:not(:placeholder-shown) ~ label,
    select:focus ~ label,
    select:not([value='']):valid ~ label {
      /* @apply transform; scale-75; -translate-y-6; */
      --tw-translate-x: 0;
      --tw-translate-y: 0;
      --tw-rotate: 0;
      --tw-skew-x: 0;
      --tw-skew-y: 0;
      transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate))
        skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
      --tw-scale-x: 0.75;
      --tw-scale-y: 0.75;
      --tw-translate-y: -1.5rem;
    }
  
    input:focus ~ label,
    select:focus ~ label {
      /* @apply text-black; left-0; */
      --tw-text-opacity: 1;
      color: rgba(0, 0, 0, var(--tw-text-opacity));
      left: 0px;
    }
  </style>
  
  <div class=" bg-gray-100 p-0 sm:p-12">
    <div class="mx-auto max-w-2xl px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl">
      <h1 class="text-2xl font-bold mb-8">Edit Pengguna</h1>
      @if ($errors->any())
        <div  id="error-message" class="bg-red-500 text-white p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('superadmin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="relative z-0 w-full mb-5">
          <input
            type="text"
            name="name"
            placeholder=" "
            value="{{ $user->name }}"
            required
            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
          />
          <label for="name" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Enter name</label>
          <span class="text-sm text-red-600 hidden" id="name">Name is required</span>
        </div>
  
        <div class="relative z-0 w-full mb-5">
          <input
            type="email"
            name="email"
            placeholder=" "
            value="{{ $user->email }}"
            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
          />
          <label for="email" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Enter email address</label>
          <span class="text-sm text-red-600 hidden" id="error">Email address is required</span>
        </div>
  
        <div class="relative z-0 w-full mb-5">
          <input
            type="password"
            name="password"
            placeholder=" "
            autocomplete="new-password"
            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
          />
          <label for="password" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Enter password (leave blank to keep current password)</label>
          <span class="text-sm text-red-600 hidden" id="error">Password is required</span>
        </div>

        <div class="relative z-0 w-full mb-5">
          <input
            type="password"
            name="password_confirmation"
            placeholder=" "
            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
          />
          <label for="password" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Confirm password</label>
          <span class="text-sm text-red-600 hidden" id="error">Password is required</span>
        </div>
  
        <fieldset class="relative z-0 w-full p-px mb-5">
          <legend class="absolute text-gray-500 transform scale-75 -top-3 origin-0">Pilih Role</legend>
          <div class="block pt-3 pb-2 space-x-5">
          @foreach ($roles as $role)
            <label>
              <input
                type="checkbox"
                name="roles[]"
                value="{{ $role->id }}"
                class="mr-2 text-black border-2 border-gray-300 focus:border-gray-300 focus:ring-black"
                @if ($user->roles->contains($role->id)) checked @endif
              />
              {{ $role->name }}
            </label>
            @endforeach
        </div>
          <span class="text-sm text-red-600 hidden" id="error">Option has to be selected</span>
        </fieldset>

        <fieldset class="relative z-0 w-full p-px mb-5">
          <legend class="absolute text-gray-500 transform scale-75 -top-3 origin-0">Pilih Role</legend>
          <div class="block pt-3 pb-2 space-x-5">
          @foreach ($divisi as $d)
            <label>
              <input
                type="checkbox"
                name="divisi[]"
                value="{{ $d->id }}"
                class="mr-2 text-black border-2 border-gray-300 focus:border-gray-300 focus:ring-black"
                @if ($user->divisi->contains($d->id)) checked @endif
              />
              {{ $d->nama }}
            </label>
            @endforeach
        </div>
          <span class="text-sm text-red-600 hidden" id="error">Option has to be selected</span>
        </fieldset>
<div class="flex justify-center w-full space-x-9">
    <div class="w-1/2">
        <button
        type="submit"
        class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-blue-500 hover:bg-blue-600 hover:shadow-lg focus:outline-none"
        >
        Simpan
    </button>
</div>
    <div class="w-1/2">
        <a href="{{ route('superadmin.users.index') }}" 
        class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-blue-500 hover:bg-blue-600 hover:shadow-lg focus:outline-none block text-center">
        Back
     </a>
     
</div>
</div>
      </form>
    </div>
  </div>
  
  <script>
    'use strict'
  
    document.getElementById('button').addEventListener('click', toggleError)
    const errMessages = document.querySelectorAll('#error')
  
    function toggleError() {
      // Show error message
      errMessages.forEach((el) => {
        el.classList.toggle('hidden')
      })
  
      // Highlight input and label with red
      const allBorders = document.querySelectorAll('.border-gray-200')
      const allTexts = document.querySelectorAll('.text-gray-500')
      allBorders.forEach((el) => {
        el.classList.toggle('border-red-600')
      })
      allTexts.forEach((el) => {
        el.classList.toggle('text-red-600')
      })
    }

    setTimeout(function() {
        var errorMessage = document.getElementById('error-message');
        var successMessage = document.getElementById('success-message');

        if (errorMessage) {
            errorMessage.style.display = 'none';
        }

        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 10000); // 10000 ms = 10 detik
  </script>





@endsection
