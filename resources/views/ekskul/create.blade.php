@extends('layouts.app')

@section('title', 'Tambah Ekskul')

@section('content')
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
        --tw-text-opacity: 1;
        color: rgba(0, 0, 0, var(--tw-text-opacity));
        left: 0px;
    }
</style>

<div class="bg-gray-100 p-0 sm:p-12">
    <div class="mx-auto max-w-2xl px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl">
        <h1 class="text-2xl font-bold mb-8">Tambah Ekskul</h1>

        @if ($errors->any())
            <div id="error-message" class="bg-red-500 text-white p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ekskul.store') }}" method="POST">
            @csrf

            <div class="relative z-0 w-full mb-5">
                <input
                    type="text"
                    name="name"
                    placeholder=" "
                    required
                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                />
                <label for="name" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Nama Ekskul</label>
            </div>

            <div class="relative z-0 w-full mb-5">
                <input
                    type="text"
                    name="lokasi"
                    placeholder=" "
                    required
                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                />
                <label for="lokasi" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Lokasi</label>
            </div>

            <div class="relative z-0 w-full mb-5">
                <input
                    type="number"
                    name="kapasitas"
                    placeholder=" "
                    required
                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                />
                <label for="kapasitas" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Kapasitas</label>
            </div>

            <div class="relative z-0 w-full mb-5">
                <input
                    type="number"
                    name="jumlah_peserta"
                    placeholder=" "
                    {{-- required --}}
                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                />
                <label for="jumlah_peserta" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Jumlah Peserta</label>
            </div>

            <div class="relative z-0 w-full mb-5">
                <textarea
                    name="deskripsi"
                    placeholder=" "
                    required
                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                ></textarea>
                <label for="deskripsi" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Deskripsi</label>
            </div>

<div class="flex w-full space-x-5">
    <div class="relative z-0 w-1/2 mb-5">
        <select id="countries" name="divisi_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="">Pilih Divisi</option>
            @foreach ($divisis as $divisi)
                <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="relative z-0 w-1/2 mb-5">
        <select id="countries" name="pembimbing_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="">Pilih Pembimbing</option>
            @foreach ($pembimbings as $pembimbing)
                <option value="{{ $pembimbing->id }}">{{ $pembimbing->name }}</option>
            @endforeach
        </select>
    </div>
</div>

            <div class="flex justify-center w-full space-x-9">
                <div class="w-full">
                    <button
                        type="submit"
                        class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-blue-500 hover:bg-blue-600 hover:shadow-lg focus:outline-none"
                    >
                        Simpan
                    </button>
                </div>
                <div class="w-full">
                    <a href="{{ route('ekskul.index') }}" 
                       class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-blue-500 hover:bg-blue-600 hover:shadow-lg focus:outline-none block text-center">
                        Kembali
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
