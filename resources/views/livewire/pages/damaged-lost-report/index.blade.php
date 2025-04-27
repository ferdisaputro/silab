{{-- <x-container x-data="Object.assign({createDamagedLostReportState: false}, confirmationDamagedLostReport(), editDamagedLostReport())"> --}}
    <x-container x-data="damagedLostReport()">
    <div>
        <x-modals.modal identifier="confirmationDamagedLostReportState" max_width="max-w-6xl">
            <livewire:pages.damaged-lost-report.confirmation/>
        </x-modals.modal>

        <x-modals.modal identifier="createDamagedLostReportState" max_width="max-w-6xl">
            <livewire:pages.damaged-lost-report.create/>
        </x-modals.modal>

        <x-modals.modal identifier="editDamagedLostReportState" max_width="max-w-6xl">
            <livewire:pages.damaged-lost-report.edit/>
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        {{-- @dump($this->selectedLab) --}}
        <div class="flex items-center justify-between">
            <div>
                <x-text.page-title class="mb-2">
                    Tabel Kerusakan/Kehilangan Alat Praktikum
                </x-text.page-title>
                <x-forms.select
                    class="flex-1"
                    name="lab_id"
                    label="Pilih Labolatorium"
                    key="lab_id"
                    wire:model.live.debounce="selectedLab"
                    wire:init="set('selectedLab', '{{ $this->laboratories->first()->id }}')">
                    @foreach ($this->laboratories as $lab)
                    <option value="{{ $lab->id }}" {{ $lab->id == $selectedLab? "selected" : "" }}>{{ $lab->code }} - {{ $lab->name }}</option>
                    @endforeach
                </x-forms.select>
            </div>
            <div>
                {{-- <x-buttons.fill x-on:click="openCreateModal(selectedLab)" title="Tambah Kesiapan Bahan Praktikum" color="purple">Buat Berita Acara Kerusakan/Kehilangan</x-buttons.fill> --}}
                <x-buttons.fill  x-on:click="createDamagedLostReportState = true" title="Tambah Kesiapan Bahan Praktikum" color="purple">Buat Berita Acara Kerusakan/Kehilangan</x-buttons.fill>
            </div>
        </div>
{{-- x-on:click="createDamagedLostReportState = true" --}}
        <div>
            <x-tables.datatable :data="$this->lossOrDamage" id="tabel-equipmentLoan">
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
                    @foreach ($this->lossOrDamage as $lossDam)
                        <tr wire:key='{{ $loop->iteration + ($this->lossOrDamage->perPage() * ($this->lossOrDamage->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration + ($this->lossOrDamage->perPage() *($this->lossOrDamage->currentPage() - 1)) }}</td>
                            <td>{{ $lossDam->nim }} - {{ $lossDam->name }}</td>
                            <td>{{ $lossDam->date_replace_agreement }}</td>
                            <td>
                                @php
                                    $Status = [
                                        1 => ["label" => "waiting", "color" => "bg-yellow-300 text-white"],
                                        2 => ["label" => "approved", "color" => "bg-green-500 text-white"],
                                        3 => ["label" => "rejected", "color" => "bg-red-500 text-white"],
                                    ];
                                @endphp
                                <span class="px-3 py-2 rounded-lg text-base font-semibold {{ $Status[$lossDam->status]['color'] }}">
                                    {{ $Status[$lossDam->status]['label'] }}
                                </span>
                            </td>

                            <td class="flex flex-wrap gap-2 text-center">
                                <x-badges.outline title="Print" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-print fa-lg"></i></x-badges.outline>
                                <x-badges.outline x-on:click="showConfirmationDamagedLostReport('{{ Crypt::encrypt($lossDam->id) }}')" title="Konfirmasi Penerimaan Penggantian Kerusakan/Kehilangan" class="px-2.5 py-1.5" color="blue"><i class="fa-solid fa-square-check fa-lg"></i></x-badges.outline>
                                @if ($lossDam->status == 1)
                                <x-badges.outline x-on:click="showEditDamagedLostReport('{{ Crypt::encrypt($lossDam->id)}}')" title="Ubah" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline x-on:click="deleteItem('{{ Crypt::encrypt($lossDam->id)}}')" title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-tables.datatable>
        </div>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('damagedLostReport', () => {
                return {
                    // Modal states
                    confirmationDamagedLostReportState: false,
                    editDamagedLostReportState: false,
                    createDamagedLostReportState: false,

                    // Functions
                    showConfirmationDamagedLostReport(id) {
                        $wire.dispatch('initConfirmationDamagedLostReport', { id: id });
                        this.confirmationDamagedLostReportState = true;
                    },
                    showEditDamagedLostReport(id) {
                        $wire.dispatch('initEditDamagedLostReport', { id: id });
                        this.editDamagedLostReportState = true;
                    },
                    openCreateModal(selectedLab) {
                        console.log("Opening create modal with lab:", selectedLab);
                        $wire.dispatch('initCreateDamagedLostReport', { selectedLab: selectedLab });
                        this.createDamagedLostReportState = true;
                    },
                    deleteItem(key) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus Item ?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data item Berhasil Dihapus', 'success')
                                    $wire.$refresh() //refresh component from the parent of this component wich is index
                                } else
                                    swal.fire('Gagal', 'Data Gagal Dihapus: ' + result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endpushOnce

