@extends('layouts.app')

@section('content')

<style>
    .toggle {
        width: 50px;
        height: 24px;
        background-color: red; /* Default color when inactive */
        border-radius: 50px;
        position: relative;
        transition: background-color 0.3s;
        border: none; /* Remove border for button */
        outline: none; /* Remove outline on focus */
        cursor: pointer; /* Pointer cursor on hover */
    }

    .toggle:before {
        content: '';
        width: 20px;
        height: 20px;
        background-color: white;
        border-radius: 50%;
        position: absolute;
        top: 2px;
        left: 2px;
        transition: transform 0.3s;
    }

    .toggle.active {
        background-color: green; /* Color when active */
    }

    .toggle.active:before {
        transform: translateX(26px); /* Move to the right */
    }
</style>
<!-- component -->
<body class="antialiased font-sans bg-gray-200">
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Daftar Pengguna</h2>
            </div>
            <div class="my-2 flex sm:flex-row flex-col">
                <div class="flex flex-row mb-1 sm:mb-0">
                    <div class="relative">
                        <form method="GET" action="{{ route('superadmin.users.index') }}">
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
                    <form method="GET" action="{{ route('superadmin.users.index') }}">
                        <!-- Hidden input untuk per_page -->
                        <input type="hidden" name="per_page" value="{{ request('per_page', 5) }}">
                    
                        <div class="relative">
                            <select name="status" onchange="this.form.submit()"
                                class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                                <option value="All" {{ request('status') == 'All' ? 'selected' : '' }}>All</option>
                                <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Not Active" {{ request('status') == 'Not Active' ? 'selected' : '' }}>Not Active</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </form>
                    
                </div>
                <form method="GET" action="{{ route('superadmin.users.index') }}" class="block relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search"
                        class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                </form>
                <div class="ml-auto">
                    <a href="{{ route('superadmin.users.create') }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 100 20A10 10 0 0010 0zm1 10h3a1 1 0 010 2h-3v3a1 1 0 01-2 0v-3H6a1 1 0 010-2h3V7a1 1 0 012 0v3z"/>
                        </svg>
                        <span>Add User</span>
                    </a>
                </div>
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
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Name
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Email
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Roles
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Divisi
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Opsi Status
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        {{-- <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full"
                                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                alt="" />
                                        </div> --}}
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $user->email }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    @foreach($user->roles as $role)
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                        <span class="relative">{{ $role->name }}</span>
                                    </span>
                                    @endforeach
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    @foreach($user->divisi as $d)
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative">{{ $d->nama }}</span>
                                    </span>
                                    @endforeach
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 {{ $user->isactive ? 'bg-green-200' : 'bg-red-200' }} opacity-50 rounded-full"></span>
                                        <span class="relative {{ $user->isactive ? 'text-green-900' : 'text-red-900' }}">
                                            {{ $user->isactive ? 'Active' : 'Not Active' }}
                                        </span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <form action="{{ route('users.toggleActive', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="button" class="toggle {{ $user->isactive ? 'active' : '' }}" onclick="toggleActive(this, {{ $user->isactive ? 'true' : 'false' }})"></button>
        <input type="hidden" name="isactive" value="{{ $user->isactive ? '0' : '1' }}">
                                    </form>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="relative inline-block text-left">
                                        <div>
                                            <button type="button" class="menu-button inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                                                <i class="material-icons-outlined">more_vert</i> <!-- Ikon tiga titik -->
                                            </button>
                                        </div>
                                
                                        <div class="menu-dropdown absolute right-0 z-10 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" role="menu" aria-orientation="vertical" tabindex="-1">
                                            <div class="py-1" role="none">
                                                <a href="{{ route('superadmin.users.show', $user->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Lihat</a>
                                                <a href="{{ route('superadmin.users.edit', $user->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Edit</a>
                                                <form action="{{ route('superadmin.users.destroy', $user->id) }}" method="POST" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full text-left">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                    <div
                        class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                        <span class="text-xs xs:text-sm text-gray-900">
                            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} Entries
                        </span>
                        <div class="inline-flex mt-2 xs:mt-0">
                            {{ $users->appends(['per_page' => request('per_page'), 'status' => request('status'), 'search' => request('search')])->links() }}
                        </div>
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
    }, 5000); // 10000 ms = 10 detik

    function toggleActive(button, currentStatus) {
    const isActive = !currentStatus; // Toggle status

    button.classList.toggle('active', isActive);
    button.style.backgroundColor = isActive ? 'green' : 'red'; // Change color directly

    // Update hidden input value
    const form = button.closest('form');
    form.querySelector('input[name="isactive"]').value = isActive ? '1' : '0';

    // Submit the form to update the status
    form.submit();
}
document.addEventListener('DOMContentLoaded', function () {
    const menuButtons = document.querySelectorAll('.menu-button');
    const menuDropdowns = document.querySelectorAll('.menu-dropdown');

    menuButtons.forEach((button, index) => {
        button.addEventListener('click', function (event) {
            // Mencegah klik pada tombol dari menutup dropdown
            event.stopPropagation();

            // Tutup semua dropdown lainnya
            menuDropdowns.forEach((dropdown, idx) => {
                if (index !== idx) {
                    dropdown.classList.add('hidden');
                }
            });

            // Toggle dropdown yang sesuai
            menuDropdowns[index].classList.toggle('hidden');
        });
    });

    // Menutup dropdown jika klik di luar menu
    window.addEventListener('click', function () {
        menuDropdowns.forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    });
});
</script>


@endsection
