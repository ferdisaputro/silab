<x-container x-data="Object.assign({createPracMatReadyState: false}, detailPracMatReady(), editPracMatReady())">
    {{-- <div>
        <x-modals.modal identifier="createPracMatReadyState" max_width="max-w-xl">
            <livewire:pages.practicum-material-readiness.create />
        </x-modals.modal>

        <x-modals.modal identifier="editPracMatReadyState" max_width="max-w-xl">
            <livewire:pages.practicum-material-readiness.edit />
        </x-modals.modal>

        <x-modals.modal identifier="detailPracMatReadyState" max_width="max-w-4xl">
            <livewire:pages.practicum-material-readiness.detail />
        </x-modals.modal>
    </div> --}}

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Kesiapan Bahan Praktikum
            </x-text.page-title>
            <div>
                <a href="{{ route('prac-mat-ready.create') }}" wire:navigate>
                    <x-buttons.fill title="Tambah Kesiapan Bahan Praktikum" color="purple">Tambah</x-buttons.fill>
                </a>
            </div>
        </div>

        <div>
            <x-tables.datatable :data="$this->practicumMaterialReadiness" id="tabel-pracMatReady">
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Mata kuliah <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Semester <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Minggu Ke <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Rekomendasi <i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->practicumMaterialReadiness as $index => $PMR)
                        <tr wire:key='{{ $loop->iteration + ($this->practicumMaterialReadiness->perPage() * ($this->practicumMaterialReadiness->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                            <td>{{ $PMR->semesterCourse->studyProgram->study_program}}</td>
                            <td>{{ $PMR->semesterCourse->semester->semester }}</td>
                            <td>{{ $PMR->academic_week_id }}</td>
                            <td>{{ $PMR->recomendation }}</td>
                            <td class="text-center">
                            <x-badges.outline title="Hapus" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-print fa-lg"></i></x-badges.outline>
                                {{-- <a href="{{ route('prac-mat-ready.edit', ['id' => Crypt::encrypt($i)]) }}" wire:navigate> --}}
                                    <x-badges.outline title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                </a>
                                <x-badges.outline title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('initEditLabItem', () => {
                return {
                    editMaterialInventoryState: false,
                    showEditMaterialInventory (key) {
                        $wire.dispatch('initEditLabItem', {key: key}); // this is function is dispatching a function from pages/MaterialInventory/Edit
                        this.editMaterialInventoryState = true;
                    },

                    deleteItem(key, code) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus Tool ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Tool Berhasil Dihapus', 'success')
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


{{-- @pushOnce('scripts')
    @script
        <script>
            Alpine.data('detailPracMatReady', () => {
                return {
                    detailPracMatReadyState: false,
                    showDetailPracMatReady (id) {
                        $wire.dispatch('initDetailPracMatReady', {id: id});
                        this.detailPracMatReadyState = true;
                    }
                }
            })

            Alpine.data('editPracMatReady', () => {
                return {
                    editPracMatReadyState: false,
                    showEditPracMatReady (id) {
                        $wire.dispatch('initEditPracMatReady', {id: id});
                        this.editPracMatReadyState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce --}}
