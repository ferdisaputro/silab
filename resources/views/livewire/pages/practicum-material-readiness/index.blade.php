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
            <x-tables.datatable id="tabel-pracMatReady">
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
                    @for ($i = 0; $i < 50; $i++)
                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>mata kuliah - {{ $i }}</td>
                            <td>{{ $i }}(2024-2025)</td>
                            <td>{{ $i }}(24/2/2024)</td>
                            <td>Siap dan Lanjutkan</td>
                            <td class="text-center">
                                <a href="{{ route('prac-mat-ready.edit', ['id' => Crypt::encrypt($i)]) }}" wire:navigate>
                                    <x-badges.outline title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                </a>
                                <x-badges.outline title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </x-tables.datatable>
        </div>
    </div>
</x-container>

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
