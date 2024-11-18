<x-container x-data="detailPracticumEquipmentLoan()">
    <div>
        <x-modals.modal identifier="detailPracticumEquipmentLoanState" max_width="max-w-6xl">
            <livewire:pages.practicum-equipment-loan.detail />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Peminjaman Alat Praktikum
            </x-text.page-title>
            <div>
                <a href="{{ route('prac-equipment-loan.create') }}" wire:navigate>
                    <x-buttons.fill title="Tambah Kesiapan Bahan Praktikum" color="purple">Tambah Peminjaman</x-buttons.fill>
                </a>
            </div>
        </div>

        <div>
            <x-tables.datatable id="tabel-equipmentLoan">
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Peminjam <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Tanggal Pinjam <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Tanggal Kembali <i class="fa-solid fa-sort ms-2"></i></th>
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
                            <td>{{ $i + mt_rand(1, 8) }}/Nov/2024</td>
                            <td>{{ $status == 0? "Sedang dipinjam" : "Telah Kembali" }}</td>
                            <td class="flex flex-wrap justify-center gap-2 text-center">
                                @if ($status)                                    
                                    <x-badges.outline x-on:click="showDetailPracticumEquipmentLoan('{{ Crypt::encrypt($i) }}')" title="Detail Peminjaman" class="px-2.5 py-1.5" color="blue"><i class="fa-solid fa-rectangle-list fa-lg"></i></i></x-badges.outline>
                                @else
                                    <a href="{{ route('prac-equipment-loan.edit', ['id' => Crypt::encrypt($i), 'type' => 'return']) }}" wire:navigate>
                                        <x-badges.outline title="Pengembalian Pinjaman" class="px-2.5 py-1.5" color="green"><i class="fa-solid fa-check-to-slot fa-lg"></i></x-badges.outline>
                                    </a>
                                    <a href="{{ route('prac-equipment-loan.edit', ['id' => Crypt::encrypt($i), 'type' => 'edit']) }}" wire:navigate>
                                        <x-badges.outline title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                    </a>
                                    <x-badges.outline title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                                @endif
                                <x-badges.outline title="Print" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-print fa-lg"></i></x-badges.outline>
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
            Alpine.data('detailPracticumEquipmentLoan', () => {
                return {
                    detailPracticumEquipmentLoanState: false,
                    showDetailPracticumEquipmentLoan (id) {
                        $wire.dispatch('initDetailPracticumEquipmentLoan', {id: id});
                        this.detailPracticumEquipmentLoanState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce
