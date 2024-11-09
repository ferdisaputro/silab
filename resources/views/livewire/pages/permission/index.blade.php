<x-container>
    <div class="p-5 space-y-6 bg-white rounded-xl" x-data="{showTambahModal: false, showUbahModal: false}">
        <x-modals.modal identifier="showUbahModal">
            <livewire:pages.permission.ubah />
        </x-modals.modal>
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Permission
            </x-text.page-title>
            {{-- <a href="{{ route('pegawai.tambah') }}" wire:navigate> --}}
            <div>
                <x-buttons.fill x-on:click="showTambahModal = true" color="purple">Tambah Permission</x-buttons.fill>
                <x-modals.modal identifier="showTambahModal">
                    <livewire:pages.permission.tambah />
                </x-modals.modal>
            </div>
        </div>
        <div>
            <table id="tabel-permission">
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
                        <td>AAPL</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(1) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Microsoft Corporation</td>
                        <td>MSFT</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(2) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Alphabet Inc.</td>
                        <td>GOOGL</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Amazon.com Inc.</td>
                        <td>AMZN</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">NVIDIA Corporation</td>
                        <td>NVDA</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Tesla Inc.</td>
                        <td>TSLA</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Meta Platforms Inc.</td>
                        <td>META</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Berkshire Hathaway Inc.</td>
                        <td>BRK.B</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">TSMC</td>
                        <td>TSM</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">UnitedHealth Group Incorporated</td>
                        <td>UNH</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Johnson & Johnson</td>
                        <td>JNJ</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">JPMorgan Chase & Co.</td>
                        <td>JPM</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Visa Inc.</td>
                        <td>V</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Eli Lilly and Company</td>
                        <td>LLY</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Walmart Inc.</td>
                        <td>WMT</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Samsung Electronics Co., Ltd.</td>
                        <td>005930.KS</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Procter & Gamble Co.</td>
                        <td>PG</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Nestlé S.A.</td>
                        <td>NESN.SW</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Roche Holding AG</td>
                        <td>ROG.SW</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Chevron Corporation</td>
                        <td>CVX</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">LVMH Moët Hennessy Louis Vuitton</td>
                        <td>MC.PA</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Pfizer Inc.</td>
                        <td>PFE</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Novo Nordisk A/S</td>
                        <td>NVO</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">PepsiCo, Inc.</td>
                        <td>PEP</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">ASML Holding N.V.</td>
                        <td>ASML</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">The Coca-Cola Company</td>
                        <td>KO</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Oracle Corporation</td>
                        <td>ORCL</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Merck & Co., Inc.</td>
                        <td>MRK</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Broadcom Inc.</td>
                        <td>AVGO</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Mastercard Incorporated</td>
                        <td>MA</td>
                        <td class="text-center">
                            <a x-on:click='
                                $wire.dispatch("initUpdate", {id: "{{ Crypt::encrypt(3) }}"});
                                showUbahModal = true;
                                '>
                                <x-buttons.outline title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-buttons.outline>
                            </a>
                            <x-buttons.outline title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-buttons.outline>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            if (document.getElementById("tabel-permission") && typeof DataTable !== 'undefined') {
                const dataTable = new DataTable("#tabel-permission", {
                    searchable: true,
                    sortable: true,
                });
            }
        </script>
    @endscript
@endPushOnce
