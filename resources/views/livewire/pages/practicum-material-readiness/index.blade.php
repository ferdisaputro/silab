<x-container x-data="Object.assign({createPracMatReadyState: false}, detailPracMatReady(), editPracMatReady())">

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
            <x-tables.datatable id="tabel-pracMatReady" :data="$this->PracticumReads" eventTarget="PracticumReads">
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
                    @foreach ($this->practicumReads as $index => $practicumRead)
                        <tr wire:key='{{ $loop->iteration + ($this->practicumReads->perPage() * ($this->practicumReads->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->practicumReads->perPage() * ($this->practicumReads->currentPage() - 1)) }}</td>
                            <td>{{ $practicumRead->SemesterCourse->course->course }}</td>
                            {{-- <td></td> --}}
                            <td>{{ $practicumRead->SemesterCourse->semester->semester }}</td>
                            <td>{{ $practicumRead->academicWeek->week_number }}</td>
                            <td>{{ $practicumRead->recomendation }}</td>
                            <td class="text-center">
                                <x-badges.outline title="Hapus" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-print fa-lg"></i></x-badges.outline>
                                <a href="{{ route('prac-mat-ready.edit', ['id' => Crypt::encrypt($practicumRead->id)]) }}" wire:navigate>
                                    <x-badges.outline title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                </a>
                                <x-badges.outline x-on:click="deleteItem('{{ Crypt::encrypt($practicumRead->id) }}', '{{ $practicumRead->id }}')" class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            deleteItem(key,item_name) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus Data Practicum ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Data Practicum Berhasil Dihapus', 'success')
                                    $wire.$refresh() //refresh component from the parent of this component wich is index
                                } else
                                    swal.fire('Gagal', 'Data Practicum Gagal Dihapus: ' + result.original.message, 'error')
                            }
                        })
                    }
        </script>
    @endscript
@endpushOnce



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
