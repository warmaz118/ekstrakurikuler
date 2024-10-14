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
                            <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="relative z-0 w-36 mb-5">
                    <select id="ekskul_id" name="ekskul_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" disabled>
                        <option value="">Pilih Ekskul</option>
                    </select>
                </div>
                
                <div class="relative z-0 w-96 mb-5">
                    <select id="siswa_id" name="siswa_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" disabled>
                        <option value="">Pilih Siswa</option>
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
                
                
                <table id="siswaTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nis</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama - Kelas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Divisi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="siswaTableBody" class="bg-white divide-y divide-gray-200">
                        <!-- Baris siswa yang dipilih akan muncul di sini -->
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
    var siswaSelect = document.getElementById('siswa_id');

    // Reset dropdown ekskul dan siswa
    ekskulSelect.innerHTML = '<option value="">Pilih Ekskul</option>';
    ekskulSelect.disabled = true; // Disable dropdown ekskul
    siswaSelect.innerHTML = '<option value="">Pilih Siswa</option>';
    siswaSelect.disabled = true; // Disable dropdown siswa

    if (divisiId) {
        // Ambil ekskul berdasarkan divisi
        fetch(`/ekskul/divisi/${divisiId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(ekskul => {
                    var option = document.createElement('option');
                    option.value = ekskul.id;
                    option.textContent = ekskul.name; // Ganti dengan field yang sesuai
                    ekskulSelect.appendChild(option);
                });
                ekskulSelect.disabled = false; // Enable dropdown ekskul setelah data diisi
            })
            .catch(error => {
                console.error('Error fetching ekskul:', error);
            });
        
        // Ambil siswa berdasarkan divisi
        fetch(`/siswa/divisi/${divisiId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(siswa => {
                    var option = document.createElement('option');
                    option.value = siswa.id; // Ganti dengan field yang sesuai
                    option.textContent = siswa.name; // Ganti dengan field yang sesuai
                    option.setAttribute('data-email', siswa.email);
                    option.setAttribute('data-nis', siswa.nis);
                    option.setAttribute('data-divisi', siswa.divisi);
                    siswaSelect.appendChild(option);
                });
                siswaSelect.disabled = false; // Enable dropdown siswa setelah data diisi
            })
            .catch(error => {
                console.error('Error fetching siswa:', error);
            });
    }
});

let siswaCounter = 1; // Inisialisasi penghitung siswa

document.getElementById('siswa_id').addEventListener('change', function() {
    var siswaId = this.value;
    var siswaName = this.options[this.selectedIndex].text;
    var siswaEmail = this.options[this.selectedIndex].getAttribute('data-email');
    var siswaNis = this.options[this.selectedIndex].getAttribute('data-nis');
    var siswaDivisi = this.options[this.selectedIndex].getAttribute('data-divisi');
    
    // Pastikan siswa tidak sudah ada di tabel sebelum menambahkannya
    if (siswaId) {
        var existingRow = document.querySelector(`#siswaTableBody tr[data-siswa-id="${siswaId}"]`);
        if (existingRow) {
            alert('Siswa sudah ada di dalam tabel!');
            return;
        }

        // Mengambil email siswa dari data yang diambil di server sebelumnya (asumsinya data sudah dimuat)

        // Menambahkan baris baru ke tabel
        var tableBody = document.getElementById('siswaTableBody');
        var row = document.createElement('tr');
        row.setAttribute('data-siswa-id', siswaId);

        // Menambahkan kolom NIS, Nama, Email, dan aksi hapus
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${siswaCounter}</td> <!-- Tampilkan Nomor -->
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${siswaNis}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${siswaName}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${siswaDivisi}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${siswaEmail}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button 
    class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-700 transition duration-300 ease-in-out remove-siswa" 
    data-siswa-id="${siswaId}">
    Hapus
</button>

            </td>
        `;

        // Tambahkan baris ke dalam tabel
        tableBody.appendChild(row);

        siswaCounter++;

        // Reset dropdown siswa setelah menambahkan siswa ke tabel
        this.value = '';
    }
});



document.getElementById('siswaTableBody').addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-siswa')) {
        var row = event.target.closest('tr');
        row.remove(); // Hapus baris

        // Perbarui nomor urut setelah penghapusan
        updateSiswaCounter(); // Panggil fungsi untuk memperbarui nomor urut
    }
});

// Fungsi untuk memperbarui nomor urut
function updateSiswaCounter() {
    let rows = document.querySelectorAll('#siswaTableBody tr');
    let newCounter = 1; // Reset penghitung

    rows.forEach(function(row) {
        row.cells[0].textContent = newCounter; // Update nomor urut
        newCounter++; // Increment penghitung
    });

    // Reset penghitung total siswa
    siswaCounter = newCounter; 
}




// Ambil data siswa saat form dikirim
document.querySelector('form').addEventListener('submit', function(event) {
    var tableBody = document.getElementById('siswaTableBody');
    var siswaIds = [];

    // Loop melalui setiap baris di tabel untuk mengambil siswa_id
    tableBody.querySelectorAll('tr').forEach(function(row) {
        var siswaId = row.getAttribute('data-siswa-id');
        siswaIds.push(siswaId);
    });

    // Buat input hidden dan tambahkan ke dalam form untuk setiap siswa_id
    siswaIds.forEach(function(siswaId) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'siswa_ids[]'; // Name sesuai dengan array siswa di backend
        input.value = siswaId;
        document.querySelector('form').appendChild(input);
    });
});


</script>
@endsection




