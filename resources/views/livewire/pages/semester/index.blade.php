<x-container x-data="Object.assign({createSemesterState: false}, showEditSemester())">
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
            <x-tables.datatable :data="$this->semesters" eventTarget="semester">
                <thead>
                    <tr>
                        <th data-sortby="id">#</th>
                        <th>Tahun Ajaran</th>
                        <th data-sortby="semester">Semester</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->semesters as $semester)
                        <tr wire:key='{{ $loop->iteration + ($this->semesters->perPage() * ($this->semesters->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->semesters->perPage() * ($this->semesters->currentPage() - 1)) }}</td>
                            <td>{{ $semester->academicYear->start_year }}/{{ $semester->academicYear->end_year }} ({{ $semester->academicYear->is_even? "Genap" : "Ganjil" }})</td>
                            <td>{{ $semester->semester }}</td>
                            <td class="text-center flex flex-wrap gap-1.5">
                                <x-badges.outline x-on:click="showEditSemester('{{ Crypt::encrypt($semester->id) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline x-on:click="deleteSemester('{{ Crypt::encrypt($semester->id) }}', '{{ $semester->semester }} tahun ajaran {{ $semester->academicYear->start_year }}/{{ $semester->academicYear->end_year }} ({{ $semester->academicYear->is_even? 'Genap' : 'Ganjil' }})')" title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('showEditSemester', () => {
                return {
                    editSemesterState: false,
                    showEditSemester (key) {
                        $wire.dispatch('initEditSemester', {key: key});
                        this.editSemesterState = true;
                    },
                    deleteSemester(key, name) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus Semester ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Semester Berhasil Dihapus', 'success')
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
