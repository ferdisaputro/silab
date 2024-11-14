<x-container x-data="Object.assign({createSemesterState: false}, editSemester())">
    <div>
        <x-modals.modal identifier="createSemesterState" max_width="max-w-xl">
            <livewire:pages.semester.create />
        </x-modals.modal>

        <x-modals.modal identifier="editSemesterState" max_width="max-w-xl">
            <livewire:pages.semester.edit />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Semester
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="createSemesterState = true" title="" color="purple">Tambah Semester</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable>
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Tahun Ajaran <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Semester <i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 50; $i++)
                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>{{ mt_rand(2020, 2025) }}/{{ mt_rand(2021, 2026) }} {{ mt_rand(0, 1) == 0 ? '(Ganjil)' : '(Genap)' }}</td>
                            <td>{{ mt_rand(1, 10) }}</td>
                            <td class="text-center flex flex-wrap gap-1.5">
                                <x-badges.outline x-on:click="showEditSemester('{{ Crypt::encrypt($i) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
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
            Alpine.data('editSemester', () => {
                return {
                    editSemesterState: false,
                    showEditSemester (id) {
                        $wire.dispatch('initEditSemester', {id: id});
                        this.editSemesterState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce
