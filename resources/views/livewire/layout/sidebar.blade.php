<div id="sidebar-multi-level-sidebar" class="bg-white shadow-xl w-fit dark:bg-gray-800" x-data="{isMinimize: window.innerWidth < 1024, minimizeState: window.innerWidth < 1024}" x-on:mouseover="minimizeState? isMinimize = false : ''" x-on:mouseleave="minimizeState? isMinimize = true : ''">
   <aside class="sticky top-0 flex flex-col h-screen border max-w-fit" aria-label="Sidebar">
      {{-- fixed top-0 left-0 z-40 -translate-x-full sm:translate-x-0 transition-transform  --}}
      <div class="flex-1 px-3 py-4 overflow-y-auto">
         <ul class="space-y-2 font-medium">
            <li>
               <div class="flex items-center mb-8 shrink-0">
                  <a href="{{ route('homepage') }}" wire:navigate>
                     <x-application-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" />
                  </a>
               </div>
            </li>
            <li>
               <a href="{{ route('homepage') }}" wire:navigate
                    class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group
                        {{
                           request()->routeIs('homepage*')? "text-primaryTeal" : ""
                        }}
                    "
                >
                  <span class="text-center w-7"><i class="fas fa-home"></i></span>
                  <span :class="!isMinimize? 'max-w-40 ms-3 text-wrap' : 'max-w-0 text-nowrap'" class="flex-1 overflow-hidden transition-all">Beranda</span>
               </a>
            </li>

            @php
               $master_route = request()->routeIs(
                        'employee*',
                        'role*',
                        'permission*',
                        'department*',
                        'study-program*',
                        'unit*',
                        'item*',
                        'laboratory*',
                     );
            @endphp
            <li x-data="{
                  dropdownState:
                  {{
                     $master_route? 'true' : 'false'
                  }}
				}">
               <button x-on:click="dropdownState = !dropdownState" type="button" aria-controls="dropdown-example"
						class="{{
                           $master_route? "text-primaryTeal" : ""
						}} flex items-center w-full p-2 text-base transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
					>
                  <span class="text-center w-7"><i class="fa-solid fa-cubes"></i></span>
                  <div :class="!isMinimize? 'max-w-40 ms-3 text-wrap' : 'max-w-0 text-nowrap'" class="flex items-center justify-between flex-1 overflow-hidden transition-all">
                     <span class="text-left transition-all rtl:text-right">Master</span>
                     <i class=" fa-solid fa-chevron-down fa-sm"></i>
                  </div>
               </button>
               <div x-show="!isMinimize" x-transition :class="dropdownState? 'max-h-screen' : 'max-h-0'" class="overflow-hidden transition-all duration-500">
                  <ul class="py-2 space-y-2">
                     <li>
                        <a href="{{ route('employee') }}" wire:navigate class="{{ request()->routeIs('employee*')? "text-primaryTeal" : "" }} flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Pegawai</a>
                     </li>
                     <li>
                        <a href="{{ route('role') }}" wire:navigate class="{{ request()->routeIs('role*')? "text-primaryTeal" : "" }} flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Role</a>
                     </li>
                     <li>
                        <a href="{{ route('permission') }}" wire:navigate class="{{ request()->routeIs('permission*')? "text-primaryTeal" : "" }} flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Permission</a>
                     </li>
                     <li>
                        <a href="{{ route('department') }}" wire:navigate class="{{ request()->routeIs('department*')? "text-primaryTeal" : "" }} flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Jurusan</a>
                     </li>
                     <li>
                        <a href="{{ route('study-program') }}" wire:navigate class="{{ request()->routeIs('study-program*')? "text-primaryTeal" : "" }} flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Program Studi</a>
                     </li>
                     <li>
                        <a href="{{ route('unit') }}" wire:navigate class="{{ request()->routeIs('unit*')? "text-primaryTeal" : "" }} flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Satuan</a>
                     </li>
                     <li>
                        <a href="{{ route('item') }}" wire:navigate class="{{ request()->routeIs('item*')? "text-primaryTeal" : "" }} flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Barang</a>
                     </li>
                     <li>
                        <a href="{{ route('laboratory') }}" wire:navigate class="{{ request()->routeIs('laboratory*')? "text-primaryTeal" : "" }} flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Laboratorium</a>
                     </li>
                  </ul>
               </div>
            </li>
            <li x-data="{dropdownState: false}">
               <button x-on:click="dropdownState = !dropdownState" type="button" class="{{ request()->routeIs('')? "text-primaryTeal" : "" }} flex items-center w-full p-2 text-base transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example">
                  <span class="text-center w-7"><i class="fa-solid fa-graduation-cap"></i></span>
                  <div :class="!isMinimize? 'max-w-40 ms-3 text-wrap' : 'max-w-0 text-nowrap'" class="flex items-center justify-between flex-1 overflow-hidden transition-all">
                     <span class="text-left transition-all rtl:text-right">Akademik</span>
                     <i class=" fa-solid fa-chevron-down fa-sm"></i>
                  </div>
               </button>
               <div x-show="!isMinimize" x-transition :class="dropdownState? 'max-h-screen' : 'max-h-0'" class="overflow-hidden transition-all duration-500">
                  <ul class="py-2 space-y-2">
                     <li>
                        <a href="#" wire:navigate class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tahun Ajaran</a>
                     </li>
                     <li>
                        <a href="#" wire:navigate class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Minggu Akademik</a>
                     </li>
                     <li>
                        <a href="#" wire:navigate class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Semester</a>
                     </li>
                     <li>
                        <a href="#" wire:navigate class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Matakuliah</a>
                     </li>
                     <li>
                        <a href="#" wire:navigate class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Matakuliah Semester</a>
                     </li>
                     <li>
                        <a href="#" wire:navigate class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Pengampu Matakuliah</a>
                     </li>
                  </ul>
               </div>
            </li>
            <li x-data="{dropdownState: false}">
               <button x-on:click="dropdownState = !dropdownState" type="button" class="{{ request()->routeIs('')? "text-primaryTeal" : "" }} flex items-center w-full p-2 text-base transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example">
                  <span class="text-center w-7"><i class="fas fa-boxes"></i></span>
                  <div :class="!isMinimize? 'max-w-40 ms-3 text-wrap' : 'max-w-0 text-nowrap'" class="flex items-center justify-between flex-1 overflow-hidden transition-all">
                     <span class="text-left transition-all rtl:text-right">Inventory Management</span>
                     <i class=" fa-solid fa-chevron-down fa-sm"></i>
                  </div>
               </button>
               <div x-show="!isMinimize" x-transition :class="dropdownState? 'max-h-screen' : 'max-h-0'" class="overflow-hidden transition-all duration-500">
                  <ul class="py-2 space-y-2">
                     <li>
                        <a href="#" wire:navigate class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Stok-in Pengadaan</a>
                     </li>
                     <li>
                        <a href="#" wire:navigate class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Inventaris Bahan</a>
                     </li>
                     <li>
                        <a href="#" wire:navigate class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Inventaris Alat</a>
                     </li>
                  </ul>
               </div>
            </li>
            <li>
               <a href="#" wire:navigate class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <span class="text-center w-7"><i class="fa-solid fa-square-check"></i></span>
                  <span :class="!isMinimize? 'max-w-40 ms-3 text-wrap' : 'max-w-0 text-nowrap'" class="flex-1 overflow-hidden transition-all">Deliver Pengajuan Alat ACC</span>
               </a>
            </li>
            <li>
               <a href="#" wire:navigate class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <span class="text-center w-7"><i class="fa-solid fa-list-check"></i></span>
                  <span :class="!isMinimize? 'max-w-40 ms-3 text-wrap' : 'max-w-0 text-nowrap'" class="flex-1 overflow-hidden transition-all">Kesiapan Bahan Praktikum</span>
               </a>
            </li>
            <li>
               <a href="#" wire:navigate class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <span class="text-center w-7"><i class="fa-solid fa-clock-rotate-left"></i></span>
                  <span :class="!isMinimize? 'max-w-40 ms-3 text-wrap' : 'max-w-0 text-nowrap'" class="flex-1 overflow-hidden transition-all">Bon Alat Praktikum</span>
               </a>
            </li>
            <li>
               <a href="#" wire:navigate class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <span class="text-center w-7"><i class="fa-solid fa-calendar-days"></i></span>
                  <span :class="!isMinimize? 'max-w-40 ms-3 text-wrap' : 'max-w-0 text-nowrap'" class="flex-1 overflow-hidden transition-all">Penggantian Jadwal</span>
               </a>
            </li>
            <li>
               <a href="#" wire:navigate class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <span class="text-center w-7"><i class="fa-solid fa-newspaper"></i></span>
                  <span :class="!isMinimize? 'max-w-40 ms-3 text-wrap' : 'max-w-0 text-nowrap'" class="flex-1 overflow-hidden transition-all">Berita Acara Kerusakan / Hilang</span>
               </a>
            </li>
            <li>
               <a href="#" wire:navigate class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <span class="text-center w-7"><i class="fa-solid fa-envelope-circle-check"></i></span>
                  <span :class="!isMinimize? 'max-w-40 ms-3 text-wrap' : 'max-w-0 text-nowrap'" class="flex-1 overflow-hidden transition-all">Serah Terima Hasil & <br> Sisa Praktik</span>
               </a>
            </li>
            <li>
               <a href="#" wire:navigate class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <span class="text-center w-7"><i class="fas fa-pen-square"></i></span>
                  <span :class="!isMinimize? 'max-w-40 ms-3 text-wrap' : 'max-w-0 text-nowrap'" class="flex-1 overflow-hidden transition-all">Ijin Penggunaan LBS</span>
               </a>
            </li>
         </ul>
      </div>

      <div :class="!minimizeState? 'text-end me-3' : 'text-center'">
         <button class="p-4 pointer-events-none lg:pointer-events-auto" type="button" x-on:click="minimizeState = !minimizeState">
            <i :class="minimizeState? '' : 'rotate-180'" class="fa-solid fa-arrow-right"></i>
         </button>
      </div>
   </aside>
</div>
