<x-container x-data="showDetailRole">
    {{-- modal untuk menampilkan detail role --}}
    <x-modals.modal identifier="showRoleModal" max_width="max-w-3xl">
        <x-text.page-title class="mb-3">Detail Permission Role</x-text.page-title>
        <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 md:grid-cols-3">
            {{-- @foreach ($selectedPermissions as $permission) --}}
                <div class="px-3 py-2 border border-gray-200 rounded-lg dark:border-gray-700">
                    test
                    {{-- {{ $permission->name }} --}}
                </div>
                <div class="px-3 py-2 border border-gray-200 rounded-lg dark:border-gray-700">
                    test
                    {{-- {{ $permission->name }} --}}
                </div>
                <div class="px-3 py-2 border border-gray-200 rounded-lg dark:border-gray-700">
                    test
                    {{-- {{ $permission->name }} --}}
                </div>
                <div class="px-3 py-2 border border-gray-200 rounded-lg dark:border-gray-700">
                    test
                    {{-- {{ $permission->name }} --}}
                </div>
                <div class="px-3 py-2 border border-gray-200 rounded-lg dark:border-gray-700">
                    test
                    {{-- {{ $permission->name }} --}}
                </div>
                <div class="px-3 py-2 border border-gray-200 rounded-lg dark:border-gray-700">
                    test
                    {{-- {{ $permission->name }} --}}
                </div>
                <div class="px-3 py-2 border border-gray-200 rounded-lg dark:border-gray-700">
                    test
                    {{-- {{ $permission->name }} --}}
                </div>
            {{-- @endforeach --}}
        </div>
    </x-modals.modal>

    <div class="p-5 space-y-6 bg-white rounded-xl">

        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Role
            </x-text.page-title>
            <div x-data="{showModal: false}">
                <a href="{{ route('role.tambah') }}" wire:navigate>
                    <x-buttons.fill x-on:click="showModal = true" title="" color="purple">Tambah Role</x-buttons.fill>
                </a>
                {{-- <x-modals.modal identifier="showModal" max_width="max-w-xl">
                    <livewire:pages.pegawai.tambah />
                </x-modals.modal> --}}
            </div>
        </div>

        <table id="tabel-role">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple Inc.</td>
                    <td>$192.58</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Microsoft Corporation</td>
                    <td>$340.54</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Alphabet Inc.</td>
                    <td>$134.12</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Amazon.com Inc.</td>
                    <td>$138.01</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">NVIDIA Corporation</td>
                    <td>$466.19</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Tesla Inc.</td>
                    <td>$255.98</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Meta Platforms Inc.</td>
                    <td>$311.71</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Berkshire Hathaway Inc.</td>
                    <td>$354.08</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">TSMC</td>
                    <td>$103.51</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">UnitedHealth Group Incorporated</td>
                    <td>$501.96</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Johnson & Johnson</td>
                    <td>$172.85</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">JPMorgan Chase & Co.</td>
                    <td>$150.23</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Visa Inc.</td>
                    <td>$246.39</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Eli Lilly and Company</td>
                    <td>$582.97</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Walmart Inc.</td>
                    <td>$159.67</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Samsung Electronics Co., Ltd.</td>
                    <td>$70.22</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Procter & Gamble Co.</td>
                    <td>$156.47</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Nestlé S.A.</td>
                    <td>$120.51</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Roche Holding AG</td>
                    <td>$296.00</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Chevron Corporation</td>
                    <td>$160.92</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">LVMH Moët Hennessy Louis Vuitton</td>
                    <td>$956.60</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Pfizer Inc.</td>
                    <td>$35.95</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Novo Nordisk A/S</td>
                    <td>$189.15</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">PepsiCo, Inc.</td>
                    <td>$182.56</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">ASML Holding N.V.</td>
                    <td>$665.72</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">The Coca-Cola Company</td>
                    <td>$61.37</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Oracle Corporation</td>
                    <td>$118.36</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Merck & Co., Inc.</td>
                    <td>$109.12</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Broadcom Inc.</td>
                    <td>$861.80</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Mastercard Incorporated</td>
                    <td>$421.44</td>
                    <td class="text-center">
                        <x-buttons.outline x-on:click="showModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-buttons.outline>
                        <a class="h-12" href="{{ route('role.ubah', ['id' => Crypt::encrypt(3)]) }}" wire:navigate>
                            <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                        </a>
                        <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            if (document.getElementById("tabel-role") && typeof DataTable !== 'undefined') {
                const dataTable = new DataTable("#tabel-role", {
                    searchable: true,
                    sortable: true,
                });
            }
            Alpine.data('showDetailRole', () => {
                return {
                    showRoleModal: false,
                    showModal($id) {
                        this.showRoleModal = true;
                        // show Modal and get the data
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
