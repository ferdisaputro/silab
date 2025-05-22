<x-container x-data="detailPracticumEquipmentLoan()">
    <div>
        {{-- $this->authorize('hasPermissionTo', 'bonalat-list|bonalat-create|bonalat-edit|bonalat-delete'); --}}
        @can('bonalat-list')
            <x-modals.modal identifier="detailPracticumEquipmentLoanState" max_width="max-w-6xl">
                <livewire:pages.practicum-equipment-loan.detail lazy/>
            </x-modals.modal>
        @endcan
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <div>
                <x-text.page-title>
                    Tabel Peminjaman Alat Praktikum
                </x-text.page-title>
                <x-forms.select
                    class="mt-3 ml-2"
                    name="selectedLab"
                    label="Pilih Lab"
                    wire:model.live='selectedLab'
                >
                    @foreach ($this->laboratories as $lab)
                        <option value="{{ $lab->id }}" {{ $lab->id == $selectedLab? "selected" : "" }}>{{ $lab->code }} - {{ $lab->name }}</option>
                    @endforeach
                </x-forms.select>
            </div>
            @can('bonalat-create')
                <div>
                    <a href="{{ route('prac-equipment-loan.create', ['id' => Crypt::encrypt($selectedLab)]) }}" wire:navigate>
                        <x-buttons.fill title="Tambah Kesiapan Bahan Praktikum" color="purple">Tambah Peminjaman</x-buttons.fill>
                    </a>
                </div>
            @endcan
        </div>

        <div>
            <x-tables.datatable :data="$this->equipmentLoans" eventTarget="equipmentLoan">
                <thead>
                    <tr>
                        <th data-sortby="id">#</th>
                        <th>Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        @can(['bonalat-edit', 'bonalat-delete'])
                            <th class="text-center">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->equipmentLoans as $eqLoan)
                    <tr wire:key='{{ $loop->iteration + ($this->equipmentLoans->perPage() * ($this->equipmentLoans->currentPage() - 1)) }}'>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->equipmentLoans->perPage() * ($this->equipmentLoans->currentPage() - 1)) }}</td>
                            <td>
                                @if ($eqLoan->is_staff)
                                    {{ $eqLoan->staffBorrower->user->name }}
                                @else
                                    {{ $eqLoan->nim }} - {{ $eqLoan->name }}
                                @endif
                            </td>
                            <td>{{ date('d/m/Y (H:i)', strtotime($eqLoan->borrowing_date)) }}<d>
                            <td>{{ $eqLoan->return_date? date('d/m/Y (H:i)', strtotime($eqLoan->return_date)) : "N/A" }}</td>
                            <td>{{ $eqLoan->status == 1? "Sedang dipinjam" : "Telah Kembali" }}</td>
                            @can(['bonalat-list', 'bonalat-edit', 'bonalat-delete'])
                                <td>
                                    <div class="flex flex-wrap justify-center gap-2 text-center">
                                        @if ($eqLoan->status == 2)
                                            @can('bonalat-list')
                                                <x-badges.outline x-on:click="showDetailPracticumEquipmentLoan('{{ Crypt::encrypt($eqLoan->id) }}')" title="Detail Peminjaman" class="px-2.5 py-1.5" color="blue"><i class="fa-solid fa-rectangle-list fa-lg"></i></i></x-badges.outline>
                                            @endcan
                                        @else
                                            @can('bonalat-edit')
                                                <a href="{{ route('prac-equipment-loan.return', ['id' => Crypt::encrypt($eqLoan->id)]) }}" wire:navigate>
                                                    <x-badges.outline title="Pengembalian Pinjaman" class="px-2.5 py-1.5" color="green"><i class="fa-solid fa-check-to-slot fa-lg"></i></x-badges.outline>
                                                </a>
                                                <a href="{{ route('prac-equipment-loan.edit', ['id' => Crypt::encrypt($eqLoan->id)]) }}" wire:navigate>
                                                    <x-badges.outline title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                                </a>
                                            @endcan
                                            @can('bonalat-delete')
                                                <x-badges.outline x-on:click="deleteLaboratory('{{ Crypt::encrypt($eqLoan->id) }}')" title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                                            @endcan
                                        @endif
                                        <a href="{{ route('print.equipment-loan', Crypt::encrypt($eqLoan->id)) }}">
                                            <x-badges.outline title="Print" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-print fa-lg"></i></x-badges.outline>
                                        </a>
                                    </div>
                                </td>
                            @endcan
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
            Alpine.data('detailPracticumEquipmentLoan', () => {
                return {
                    detailPracticumEquipmentLoanState: false,
                    showDetailPracticumEquipmentLoan (id) {
                        $wire.dispatch('initDetailPracticumEquipmentLoan', {id: id});
                        this.detailPracticumEquipmentLoanState = true;
                    },
                    deleteLaboratory(key) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus laporan peminjaman?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Peminjaman Berhasil Dihapus', 'success')
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
