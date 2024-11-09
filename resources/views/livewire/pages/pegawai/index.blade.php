<x-container>
    <div class="p-5 space-y-6 bg-white rounded-xl">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-semibold">Tabel Data Pegawai</h3>
            {{-- <a href="{{ route('pegawai.tambah') }}" wire:navigate> --}}
            <div x-data="{showModal: false}">        
                <x-buttons.fill x-on:click="showModal = true" color="purple">Tambah Pegawai</x-buttons.fill>
                <div x-show="showModal" x-transition.opacity x-on:click="showModal = false" class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full max-h-full p-4 overflow-x-hidden md:p-7 bg-black/40 md:inset-0">
                    <div class="relative w-full max-w-6xl max-h-full p-5 overflow-hidden overflow-y-auto bg-white shadow rounded-xl dark:bg-gray-700">
                        <div>
                            <livewire:pages.pegawai.tambah />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div>
            <table id="tabel-pegawai">
                <thead>
                    <tr>
                        <th>
                            <span class="flex items-center">
                                #
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Foto
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Nama
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Action
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple Inc.</td>
                        <td>AAPL</td>
                        <td>$192.58</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Microsoft Corporation</td>
                        <td>MSFT</td>
                        <td>$340.54</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Alphabet Inc.</td>
                        <td>GOOGL</td>
                        <td>$134.12</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Amazon.com Inc.</td>
                        <td>AMZN</td>
                        <td>$138.01</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">NVIDIA Corporation</td>
                        <td>NVDA</td>
                        <td>$466.19</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Tesla Inc.</td>
                        <td>TSLA</td>
                        <td>$255.98</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Meta Platforms Inc.</td>
                        <td>META</td>
                        <td>$311.71</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Berkshire Hathaway Inc.</td>
                        <td>BRK.B</td>
                        <td>$354.08</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">TSMC</td>
                        <td>TSM</td>
                        <td>$103.51</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">UnitedHealth Group Incorporated</td>
                        <td>UNH</td>
                        <td>$501.96</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Johnson & Johnson</td>
                        <td>JNJ</td>
                        <td>$172.85</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">JPMorgan Chase & Co.</td>
                        <td>JPM</td>
                        <td>$150.23</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Visa Inc.</td>
                        <td>V</td>
                        <td>$246.39</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Eli Lilly and Company</td>
                        <td>LLY</td>
                        <td>$582.97</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Walmart Inc.</td>
                        <td>WMT</td>
                        <td>$159.67</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Samsung Electronics Co., Ltd.</td>
                        <td>005930.KS</td>
                        <td>$70.22</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Procter & Gamble Co.</td>
                        <td>PG</td>
                        <td>$156.47</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Nestlé S.A.</td>
                        <td>NESN.SW</td>
                        <td>$120.51</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Roche Holding AG</td>
                        <td>ROG.SW</td>
                        <td>$296.00</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Chevron Corporation</td>
                        <td>CVX</td>
                        <td>$160.92</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">LVMH Moët Hennessy Louis Vuitton</td>
                        <td>MC.PA</td>
                        <td>$956.60</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Pfizer Inc.</td>
                        <td>PFE</td>
                        <td>$35.95</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Novo Nordisk A/S</td>
                        <td>NVO</td>
                        <td>$189.15</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">PepsiCo, Inc.</td>
                        <td>PEP</td>
                        <td>$182.56</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">ASML Holding N.V.</td>
                        <td>ASML</td>
                        <td>$665.72</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">The Coca-Cola Company</td>
                        <td>KO</td>
                        <td>$61.37</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Oracle Corporation</td>
                        <td>ORCL</td>
                        <td>$118.36</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Merck & Co., Inc.</td>
                        <td>MRK</td>
                        <td>$109.12</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Broadcom Inc.</td>
                        <td>AVGO</td>
                        <td>$861.80</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Mastercard Incorporated</td>
                        <td>MA</td>
                        <td>$421.44</td>
                        <td>
                            <x-buttons.outline color="teal">Ubah</x-buttons.outline>
                            <x-buttons.outline color="red">Hapus</x-buttons.outline>
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
            if (document.getElementById("tabel-pegawai") && typeof DataTable !== 'undefined') {
                const dataTable = new DataTable("#tabel-pegawai", {
                    searchable: true,
                    sortable: true,
                });
            }
        </script>
    @endscript
@endPushOnce