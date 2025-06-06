<x-container x-data="Object.assign({createCourseState: false}, showEditCourse())">
    <div>
        {{-- $this->authorize('hasPermissionTo', 'matakuliah-list|matakuliah-create|matakuliah-edit|matakuliah-delete'); --}}
        @can('matakuliah-create')
            <x-modals.modal identifier="createCourseState" max_width="max-w-3xl">
                <livewire:pages.course.create />
            </x-modals.modal>
        @endcan
        @can('matakuliah-edit')
            <x-modals.modal identifier="editCourseState" max_width="max-w-3xl">
                <livewire:pages.course.edit />
            </x-modals.modal>
        @endcan
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Data Mata Kuliah
            </x-text.page-title>
            @can('matakuliah-create')
                <div>
                    <x-buttons.fill x-on:click="createCourseState = true" color="purple">Tambah Mata Kuliah</x-buttons.fill>
                </div>
            @endcan
        </div>

        <div x-data="changeDataStatus">
            <x-tables.datatable :data="$this->courses" eventTarget="course">
                <thead>
                    <tr>
                        <th data-sortby="id">#</th>
                        <th data-sortby="code">Kode Matkul</th>
                        <th data-sortby="course">Nama Matkul</th>
                        <th>Status</th>
                        @can(['matakuliah-edit', 'matakuliah-delete'])
                            <th class="text-center">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->courses as $course)
                        <tr wire:key='{{ $loop->iteration + ($this->courses->perPage() * ($this->courses->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->courses->perPage() * ($this->courses->currentPage() - 1)) }}</td>
                            <td>{{ $course->code }}</td>
                            <td>{{ $course->course }}</td>
                            <td>
                                <x-badges.fill :color="$course->is_active? 'blue' : 'yellow'" class="px-2.5 py-1.5"
                                    x-on:click="changeStatus('{{ Crypt::encrypt($course->id) }}', {{ $course->is_active }})">{{ $course->is_active? "Aktif" : "Non Aktif" }}</x-badges.fill>
                            </td>
                            @can(['matakuliah-edit', 'matakuliah-delete'])
                                <td class="text-center">
                                    @can('matakuliah-edit')
                                        <x-badges.outline x-on:click="showEditCourse('{{ Crypt::encrypt($course->id) }}')" class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                    @endcan
                                    @can('matakuliah-delete')
                                        <x-badges.outline x-on:click="deleteCourse('{{ Crypt::encrypt($course->id) }}', '{{ $course->course }}')" class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                                    @endcan
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
            Alpine.data('showEditCourse', () => {
                return {
                    editCourseState: false,
                    showEditCourse(key) {
                        $wire.dispatch('initEditCourse', {key: key});
                        this.editCourseState = true;
                    },
                    deleteCourse(key, name) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus Mata kuliah ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Mata Kuliah Berhasil Dihapus', 'success')
                                    $wire.$refresh() //refresh component from the parent of this component wich is index
                                } else
                                    swal.fire('Gagal', 'Data Gagal Dihapus: ' + result.original.message, 'error')
                            }
                        })
                    }
                }
            })

            Alpine.data('changeDataStatus', () => {
				return {
                    @can('matakuliah-edit')
                        changeStatus(key, status) {
                            let title = status || status == 1 ? 'Ubah Status ke Non Aktif' : 'Ubah Status ke Aktif';
                            let text = status || status == 1 ? 'Ubah status ke non aktif' : 'Ubah status ke aktif';
                            let confirmButtonText = status ? 'Non Aktif' : 'Aktif';
                            let cancelButtonText = status ? 'Aktif' : 'Non Aktif';

                            swal.fire({
                                title: title,
                                text: text,
                                icon: 'warning',
                                confirmButtonText: "Ya",
                                cancelButtonText: "Tidak",
                                showCloseButton: true,
                                showCancelButton: true
                            }).then(response => {
                                if (response.isConfirmed) {
                                    $wire.updateStatus(key, !status)
                                }
                            })
                        }
                    @endcan
				}
            })
        </script>
    @endscript
@endPushOnce
