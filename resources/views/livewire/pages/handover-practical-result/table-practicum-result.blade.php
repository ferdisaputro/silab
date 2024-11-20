<div>
    <x-tables.datatable id="tabel-equipmentLoan">
        <thead>
            <tr>
                <th># <i class="fa-solid fa-sort ms-2"></i></th>
                <th>Hasil Praktikum <i class="fa-solid fa-sort ms-2"></i></th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 50; $i++)
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                    <td>Hasil Praktikum - {{ $i }}</td>
                    <td class="flex flex-wrap gap-2 text-center">
                        <x-badges.outline title="Hapus" class="px-2.5 py-1.5">Pilih</x-badges.outline>
                    </td>
                </tr>
            @endfor
        </tbody>
    </x-tables.datatable>
</div>
