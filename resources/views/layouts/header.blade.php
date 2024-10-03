<ul class="mt-4">
    <span class="text-gray-400 font-bold">ADMIN</span>
    <li class="mb-1 group">
        <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
            <i class="ri-home-2-line mr-3 text-lg"></i>
            <span class="text-sm">Dashboard</span>
        </a>
    </li>
   
    <li class="mb-1 group">
        <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
            <i class='bx bx-user mr-3 text-lg'></i>                
            <span class="text-sm">Master</span>
            <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
        </a>
        <ul class="pl-7 mt-2 hidden group-[.selected]:block">
            
            <li class="mb-4">
                <a href="{{ route('superadmin.users') }}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Users</a>
            </li> 
           
            <li class="mb-4">
                <a href="" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Siswa</a>
            </li> 
        </ul>
    </li>
 
    
    <span class="text-gray-400 font-bold">JADWAL</span>
    <li class="mb-1 group">
        <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
            <i class='bx bxl-blogger mr-3 text-lg' ></i>                 
            <span class="text-sm">Ekstrakurikuler</span>
            <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
        </a>
        <ul class="pl-7 mt-2 hidden group-[.selected]:block">
            <li class="mb-4">
                <a href="" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">All</a>
            </li> 
            <li class="mb-4">
                <a href="" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Categories</a>
            </li> 
        </ul>
    </li>
    <li class="mb-1 group">
        <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
            <i class='bx bx-archive mr-3 text-lg'></i>                
            <span class="text-sm">Ekskul</span>
        </a>
    </li>
    
</ul>