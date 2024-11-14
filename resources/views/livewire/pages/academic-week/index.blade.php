<x-container x-data="Object.assign({createAcademicWeekState: false}, editAcademicWeek())">
    <div>
        <x-modals.modal identifier="createAcademicWeekState" max_width="max-w-xl">
            <livewire:pages.academic-week.create />
        </x-modals.modal>

        <x-modals.modal identifier="editAcademicWeekState" max_width="max-w-xl">
            <livewire:pages.academic-week.edit />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Minggu Akademik
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="createAcademicWeekState = true" title="" color="purple">Tambah Minggu Akademik</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable id="tabel-academicWeek">
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Minggu Ke - (Tahun Ajaran) <i class="fa-solid fa-sort ms-2"></i></th>
                        {{-- <th>Tahun Ajaran <i class="fa-solid fa-sort ms-2"></i></th> --}}
                        <th>Awal Minggu <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Awal Minggu <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Keterangan <i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 50; $i++)
                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>{{ rand(1, 52)." ".rand(date('Y') - 5, date('Y') + 5) . '/' . (rand(date('Y') - 5, date('Y') + 5) + 1) }}</td>
                            {{-- <td>{{ rand(date('Y') - 5, date('Y') + 5) . '/' . (rand(date('Y') - 5, date('Y') + 5) + 1) }}</td> --}}
                            <td>{{ date('Y-m-d', strtotime('+' . rand(1, 365) . ' days')) }}</td>
                            <td>{{ date('Y-m-d', strtotime('+' . rand(1, 365) . ' days')) }}</td>
                            <td>{{ implode(' ', array_map(function($i) { return Str::random(rand(3, 10)); }, range(1, rand(1, 10)))) }}</td>
                            <td class="text-center flex flex-wrap gap-1.5">
                                <x-badges.outline x-on:click="showEditAcademicWeek('{{ Crypt::encrypt($i) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('editAcademicWeek', () => {
                return {
                    editAcademicWeekState: false,
                    showEditAcademicWeek (id) {
                        $wire.dispatch('initEditAcademicWeek', {id: id});
                        this.editAcademicWeekState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce
