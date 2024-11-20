<x-container>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Serah Terima Hasil & Sisa Praktikum
            </x-text.page-title>
            <div>
                <a href="{{ route('handover-practical-result.create') }}" wire:navigate>
                    <x-buttons.fill title="Tambah Kesiapan Bahan Praktikum" color="purple">Buat Serah Terima Hasil & Sisa Praktikum</x-buttons.fill>
                </a>
            </div>
        </div>

        <div>
            <x-tables.datatable id="tabel-equipmentLoan">
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Mata Kuliah <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Dosen Pengampu <i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 50; $i++)
                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>Matkul - {{ $i }}</td>
                            <td>Pengampu - {{ $i }}</td>
                            <td class="flex flex-wrap gap-2 text-center">
                                <x-badges.outline title="Print" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-print fa-lg"></i></x-badges.outline>
                                <a href="{{ route('handover-practical-result.edit', ['id' => Crypt::encrypt($i)]) }}" wire:navigate>
                                    <x-badges.outline title="Ubah" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                </a>
                                <x-badges.outline title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </x-tables.datatable>
        </div>
    </div>
</x-container>