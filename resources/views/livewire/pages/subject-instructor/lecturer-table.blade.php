<div>
    <x-tables.datatable id="tabel-department">
        <thead>
            <tr>
                <th># <i class="fa-solid fa-sort ms-2"></i></th>
                <th>Kode Jurusan <i class="fa-solid fa-sort ms-2"></i></th>
                <th>Jurusan <i class="fa-solid fa-sort ms-2"></i></th>
                <th>Ketua Jurusan <i class="fa-solid fa-sort ms-2"></i></th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 50; $i++)
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                    <td>KODE-{{ $i }}</td>
                    <td>Nama jurusan {{ $i }}</td>
                    <td>Ketua jurusan {{ $i }}</td>
                    <td class="text-center">
                        {{-- this button is dispatching a function from pages/SubjectInstructor/Index --}}
                        <x-badges.outline wire:click="dispatch('setLecturer', {lecturer: {{ $i }}}); selectLecturerState = false" title="Pilih" class="px-2.5 py-1.5" color="blue">Pilih Dosen</x-badges.outline>
                    </td>
                </tr>
            @endfor
        </tbody>
    </x-tables.datatable>
</div>
