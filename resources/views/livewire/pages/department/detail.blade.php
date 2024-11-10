<div x-data="Object.assign(listStudyProgram(), {createStudyProgramState: false})">

    <div>
        <x-modals.modal identifier="listStudyState" max_width="max-w-4xl">
            <div class="flex items-center justify-between mb-7">
                <x-text.page-title wire:loading.remove>
                    Tabel Program Studi
                </x-text.page-title>
                <x-text.page-title wire:loading>
                    Loading...
                </x-text.page-title>

                <div>
                    <x-buttons.fill x-on:click="createStudyProgramState = true" title="" color="purple">Tambah Program Studi</x-buttons.fill>
                </div>
            </div>
            <livewire:pages.study-program.table-study isSelectable="true" identifier="listStudyState"/>
        </x-modals.modal>

        <div>
            <x-modals.modal identifier="createStudyProgramState" max_width="max-w-xl">
                <livewire:pages.study-program.create />
            </x-modals.modal>
        </div>
    </div>

    <div class="flex items-center justify-between mb-7">
        <x-text.page-title>
            Detail Jurusan {{ $id }}
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
            <div wire:transition>
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
                                <td>{{ $newStudy['kode'] }}</td>
                                <td>{{ $newStudy['nama'] }}</td>
                                <td>{{ $newStudy['kaprodi'] }}</td>
                                <td class="text-center text-nowrap">
                                    <x-badges.outline wire:click="removeNewStudy({{ $index }})" title="Hapus dari daftar penambahan prodi" class="px-2.5 py-1.5" color="green"><i class="fa-regular fa-minus fa-lg"></i></x-badges.outline>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-tables.datatable>

                <div class="text-center">
                    <x-buttons.outline color="teal" class="w-full max-w-xs">Simpan Perubahan</x-buttons.outline>
                </div>
            </div>
        @endif

        <div>
            @if (count($newStudies) > 0)
                <x-alerts.outline wire:transition class="mb-4" color="green" title="OLD!" message="Data lama yang akan tetap tersimpan." />
            @endif
            <x-tables.datatable id="detail-prodi-department" wire:key="detail-prodi-department">
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
                    @for ($i = 0; $i < 5; $i++)
                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>KODE-{{ $i }}</td>
                            <td>Nama Program Studi {{ $i }}</td>
                            <td>Ketua Program Studi {{ $i }}</td>
                            <td class="text-center text-nowrap">
                                <x-badges.outline title="Hapus prodi dari jurusan" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                            </td>
                        </tr>
                    @endfor
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
                        $wire.dispatch('initTableStudy', {isSelectable: true, identifier: "listStudyState"})
                        this.listStudyState = true
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
