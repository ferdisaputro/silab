<x-container x-data="Object.assign({createDamagedLostReportState: false}, confirmationDamagedLostReport(), editDamagedLostReport())">
    <div>
        <x-modals.modal style="display: none" identifier="confirmationDamagedLostReportState" max_width="max-w-6xl">
            <livewire:pages.damaged-lost-report.confirmation />
        </x-modals.modal>

        <x-modals.modal style="display: none" identifier="createDamagedLostReportState" max_width="max-w-6xl">
            <livewire:pages.damaged-lost-report.create />
        </x-modals.modal>

        <x-modals.modal style="display: none" identifier="editDamagedLostReportState" max_width="max-w-6xl">
            <livewire:pages.damaged-lost-report.edit />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Kerusakan/Kehilangan Alat Praktikum
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="createDamagedLostReportState = true" title="Tambah Kesiapan Bahan Praktikum" color="purple">Buat Berita Acara Kerusakan/Kehilangan</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable id="tabel-equipmentLoan">
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Nama <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Tanggal Kesanggupan <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Status <i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 50; $i++)
                        @php
                            $status = mt_rand(0, 1);
                        @endphp
                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>Nama - {{ $i }}</td>
                            <td>{{ $i }}/Nov/2024</td>
                            <td>{{ $status == 0? "Selesai" : "Belum" }}</td>
                            <td class="flex flex-wrap gap-2 text-center">
                                <x-badges.outline title="Print" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-print fa-lg"></i></x-badges.outline>
                                <x-badges.outline x-on:click="showConfirmationDamagedLostReport('{{ Crypt::encrypt($i) }}')" title="Konfirmasi Penerimaan Penggantian Kerusakan/Kehilangan" class="px-2.5 py-1.5" color="blue"><i class="fa-solid fa-square-check fa-lg"></i></x-badges.outline>
                                @if (!$status)
                                    <x-badges.outline x-on:click="showEditDamagedLostReport('{{ Crypt::encrypt($i) }}')" title="Ubah" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                    <x-badges.outline title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                                @endif
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </x-tables.datatable>
        </div>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('confirmationDamagedLostReport', () => {
                return {
                    confirmationDamagedLostReportState: false,
                    showConfirmationDamagedLostReport (id) {
                        $wire.dispatch('initConfirmationDamagedLostReport', {id: id});
                        this.confirmationDamagedLostReportState = true;
                    }
                }
            })

            Alpine.data('editDamagedLostReport', () => {
                return {
                    editDamagedLostReportState: false,
                    showEditDamagedLostReport (id) {
                        $wire.dispatch('initEditDamagedLostReport', {id: id});
                        this.editDamagedLostReportState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce
