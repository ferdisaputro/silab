<div>
    <x-tables.datatable :data="$this->studyPrograms" eventTarget="studyProgram">
        <thead>
            <tr>
                <th data-sortby="id">#</th>
                <th data-sortby="code">Kode Program Studi</th>
                <th data-sortby="study-program">Program Studi</th>
                <th>Jurusan</th>
                <th>Ka.program Studi</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->studyPrograms as $studyProgram)
                <tr wire:key='{{ $loop->iteration + ($this->studyPrograms->perPage() * ($this->studyPrograms->currentPage() - 1)) }}'>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->studyPrograms->perPage() * ($this->studyPrograms->currentPage() - 1)) }}</td>
                    <td>{{ $studyProgram->code }}</td>
                    <td>{{ $studyProgram->study_program }}</td>
                    <td>{{ Str::limit($studyProgram->department->department?? "N/A", 30) }}</td>
                    {{-- <td>@dump($studyProgram->headOfStudyPrograms)</td> --}}
                    <td>{{ $studyProgram->headOfStudyPrograms->firstWhere('is_active', 1)->staff->user->name?? 'N/A' }}</td>
                    <td class="text-center text-nowrap">
                        @if (!$isSelectable)
                            <x-badges.outline x-on:click="showEditStudyProgram('{{ Crypt::encrypt($studyProgram->id) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                            {{-- <x-badges.outline x-on:click="$dispatch('dispatchShowEditStudyProgram', '{{ Crypt::encrypt($studyProgram->id) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline> --}}
                            <x-badges.outline x-data="deleteStudyProgram()" x-on:click="deleteStudyProgram('{{ Crypt::encrypt($studyProgram->id) }}', '{{ $studyProgram->study_program }}')" title="Hapus" x class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                        @else
                            @if ($studyProgram->department_id)
                            <x-badges.outline title="Tambah" class="px-2.5 py-1.5" color="red"
                                x-on:click="
                                    swal.fire({
                                        title: 'Konfirmasi',
                                        text: 'Prodi sudah memiliki jurusan. Memilih prodi ini akan mengganti jurusan yang telah ditetapkan',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Ya',
                                        cancelButtonText: 'Batal',
                                    }).then(async res => {
                                        if (res.isConfirmed) {
                                            $wire.dispatch('addNewStudy', {key: '{{ Crypt::encrypt($studyProgram->id) }}'});
                                            ({{ $identifier }})? {{ $identifier }} = false : ''
                                        }
                                    })
                                "><i class="fa-regular fa-plus fa-lg"></i></x-badges.outline>
                            @else
                                <x-badges.outline title="Tambah" class="px-2.5 py-1.5" color="blue"
                                x-on:click="
                                    $wire.dispatch('addNewStudy', {key: '{{ Crypt::encrypt($studyProgram->id) }}'}); {{-- this is triggering a function from livewire/pages/department/detail --}}
                                    ({{ $identifier }})? {{ $identifier }} = false : ''
                                "><i class="fa-regular fa-plus fa-lg"></i></x-badges.outline>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-tables.datatable>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('deleteStudyProgram', () => {
                return {
                    deleteStudyProgram(key, name) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus program studi ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Program Studi Berhasil Dihapus', 'success')
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
@endPushOnce
