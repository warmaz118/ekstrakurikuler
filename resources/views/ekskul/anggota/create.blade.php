@extends('layouts.app')

@section('content')
<!-- component -->
<body class="antialiased font-sans bg-gray-200">
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight mb-5">Tambah Siswa</h2>
            </div>
            <div class="flex w-1/2 space-x-5">
                <div class="relative z-0 w-36 mb-5">
                    <select id="divisi_id" name="divisi_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih Divisi</option>
                        @foreach($divisis as $divisi)
                            <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option> <!-- Ganti 'nama' dengan field yang sesuai -->
                        @endforeach
                    </select>
                </div>
                
                <div class="relative z-0 w-36 mb-5">
                    <select id="ekskul_id" name="pembimbing_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" disabled>
                        <option value="">Pilih Ekskul</option>
                    </select>
                </div>
                

                <div class="relative z-0 w-96 mb-5">
                    <select id="countries" name="pembimbing_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih Siswa</option>
                            <option value="">Siswa SMP </option>
                            <option value="">Siswa SMP 1</option>
                            <option value="">Siswa SMP 2</option>
                    </select>
                </div>
            </div>
            <div class="my-2 flex sm:flex-row flex-col">
                <div class="flex flex-row mb-1 sm:mb-0">
                    <div class="relative">
                        <form method="GET" action="{{ route('ekskul.index') }}">
                            <!-- Hidden input untuk status -->
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        
                            <select name="per_page"
                                class="appearance-none h-full rounded-l border block w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                onchange="this.form.submit()">
                                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                            </select>
                        </form>
                        
                        
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    
                </div>
                <form method="GET" action="{{ route('ekskul.index') }}" class="block relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search"
                        class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                </form>
                
            </div> 
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                @if(session('error'))
                <div id="error-message" class="bg-red-500 text-white p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
                @endif
                
                @if(session('success'))
                    <div id="success-message" class="bg-green-500 text-white p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kelas
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Divisi
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Ekskul
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Pembimbing
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                Siswa SMP
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                8
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                SMP
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                Futsal
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                Pembimbing
                            </td>
                           
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <button type="submit">Hapus</button>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
                <!-- Paginasi -->
                <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    <span class="text-xs xs:text-sm text-gray-900">
                        {{-- Showing {{ $ekskuls->firstItem() }} to {{ $ekskuls->lastItem() }} of {{ $ekskuls->total() }} Entries --}}
                    </span>
                    <div class="inline-flex mt-2 xs:mt-0">
                        {{-- {{ $ekskuls->appends(['per_page' => request('per_page'), 'status' => request('status'), 'search' => request('search')])->links() }} --}}
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</body>
<script>
    // Fungsi untuk menyembunyikan pesan flash setelah 10 detik (10000 ms)
    setTimeout(function() {
        var errorMessage = document.getElementById('error-message');
        var successMessage = document.getElementById('success-message');

        if (errorMessage) {
            errorMessage.style.display = 'none';
        }

        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000); // 10000 ms = 10 detik

    
    document.getElementById('divisi_id').addEventListener('change', function() {
        var divisiId = this.value;
        var ekskulSelect = document.getElementById('ekskul_id');
        
        // Reset dropdown ekskul
        ekskulSelect.innerHTML = '<option value="">Pilih Ekskul</option>';
        ekskulSelect.disabled = true; // Disable dropdown ekskul sampai data diambil

        if (divisiId) {
            fetch(`/ekskul/divisi/${divisiId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(ekskul => {
                        var option = document.createElement('option');
                        option.value = ekskul.id;
                        option.textContent = ekskul.name; // Ganti 'name' dengan field yang sesuai
                        ekskulSelect.appendChild(option);
                    });
                    ekskulSelect.disabled = false; // Enable dropdown ekskul setelah data diisi
                })
                .catch(error => {
                    console.error('Error fetching ekskul:', error);
                });
        }
    });


</script>
@endsection




