<div x-data="Object.assign(listStudyProgram(), {createStudyProgramState: false})">
    <div>
        <x-modals.modal identifier="listStudyState" max_width="max-w-4xl">
            <div class="flex items-center justify-between mb-7">
                <x-text.page-title>
                    Tabel Program Studi
                </x-text.page-title>

                <div>
                    <x-buttons.fill x-on:click="createStudyProgramState = true" title="" color="purple">Tambah Program Studi</x-buttons.fill>
                </div>
            </div>
            <livewire:pages.study-program.table-study isSelectable="true" identifier="listStudyState" wire:key='{{ now() }}' lazy/>
        </x-modals.modal>

        <div>
            <x-modals.modal identifier="createStudyProgramState" max_width="max-w-xl">
                <livewire:pages.study-program.create lazy/>
            </x-modals.modal>
        </div>
    </div>

    <div class="flex items-center justify-between mb-7">
        <x-text.page-title class="mb-5 flex items-center gap-4 capitalize">
            Detail Jurusan ({{ $this->department->department?? "" }})
        </x-text.page-title> 
        <div>
            <x-buttons.fill x-on:click="showListStudy" title="" color="purple">
                Tambah List Prodi
            </x-buttons.fill>
        </div>
    </div>

    <div class="space-y-12">
        {{-- {{ count($newStudy) > 0? "true" : "false" }} --}}
        @if (count($newStudies) > 0)
            <div>
                <x-alerts.outline class="mb-4" color="blue" title="NEW!" message="Tambahan data baru yang akan tersimpan." />
                <x-tables.datatable id="new-study" wire:key="new-study">
                    <thead>
                        <tr>
                            <th># <i class="fa-solid fa-sort ms-2"></i></th>
                            <th>Kode Program Study <i class="fa-solid fa-sort ms-2"></i></th>
                            <th>Program Study <i class="fa-solid fa-sort ms-2"></i></th>
                            <th>Ka. program Study <i class="fa-solid fa-sort ms-2"></i></th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($newStudies as $index => $newStudy)
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</td>
                                <td>{{ $newStudy->code }}</td>
                                <td>{{ $newStudy->study_program }}</td>
                                <td>{{ $newStudy->headOfStudyPrograms->firstWhere('is_active', 1)->staff->user->name?? 'N/A' }}</td>
                                <td class="text-center text-nowrap">
                                    <x-badges.outline wire:click="removeNewStudy({{ $index }})" title="Hapus dari daftar penambahan prodi" class="px-2.5 py-1.5" color="green"><i class="fa-regular fa-minus fa-lg"></i></x-badges.outline>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-tables.datatable>

                <div class="text-center">
                    <x-buttons.outline color="teal" class="w-full max-w-xs" x-on:click="submitHandler">Tambah Prodi Baru</x-buttons.outline>
                </div>
            </div>
        @endif

        <div>
            @if (count($newStudies) > 0)
                <x-alerts.outline class="mb-4" color="green" title="OLD!" message="Data lama yang akan tetap tersimpan." />
            @endif
            <x-tables.datatable>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Program Study</th>
                        <th>Program Study</th>
                        <th>Ka. program Study</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($this->department && count($this->department->studyPrograms) > 0)
                        @foreach ($this->department->studyPrograms()->with('headOfStudyPrograms.staff.user')->orderBy('updated_at', 'asc')->get() as $index => $studyProgram)
                            <tr wire:key='{{ $loop->iteration }}'>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</td>
                                <td>{{ $studyProgram->code }}</td>
                                <td>{{ $studyProgram->study_program }}</td>
                                <td>{{ $studyProgram->headOfStudyPrograms->firstWhere('is_active', 1)->staff->user->name?? 'N/A' }}</td>
                                <td class="text-center">
                                    {{-- <x-badges.outline x-on:click="showEditstudyProgram('{{ Crypt::encrypt($studyProgram->id) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline> --}}
                                    <x-badges.outline x-on:click="removeStudyProgram('{{ Crypt::encrypt($studyProgram->id) }}', '{{ $studyProgram->study_program }}', '{{ $this->department->department }}')" title="Hapus" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada data ditemukan</td>
                        </tr>
                    @endIf
                </tbody>
            </x-tables.datatable>
        </div>
    </div>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('listStudyProgram', () => {
                return {
                    listStudyState: false,
                    showListStudy() {
                        // $wire.dispatch('initTableStudy', {isSelectable: true, identifier: "listStudyState"})
                        this.listStudyState = true
                    },
                    submitHandler() {
                        swal.fire({
                            title: 'Tambahkan Prodi Baru?',
                            text: 'Pastikan Data Prodi Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.edit()
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', result.original.message, result.original.status)
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Prodi Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    },
                    removeStudyProgram(key, studyProgram, department) {
                        swal.fire({
                            title: 'Hapus Prodi?',
                            text: `Hapus Prodi (${studyProgram}) Dari Jurusan (${department})`,
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.removeStudyProgram(key)
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', result.original.message, result.original.status)
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Prodi Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
