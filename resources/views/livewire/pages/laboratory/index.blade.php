<x-container x-data="Object.assign({createLaboratoryState: false}, editLaboratoryModal(), detailLaboratoryModal())">
    <div>
        <x-modals.modal identifier="detailLaboratoryState" max_width="max-w-4xl">
            <livewire:pages.laboratory.detail lazy/>
        </x-modals.modal>
        <x-modals.modal identifier="createLaboratoryState" max_width="max-w-4xl">
            <livewire:pages.laboratory.create />
        </x-modals.modal>
        <x-modals.modal identifier="editLaboratoryState" max_width="max-w-4xl">
            <livewire:pages.laboratory.edit lazy/>
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Data Laboratorium
            </x-text.page-title>
            {{-- <a href="{{ route('employee.create') }}" wire:navigate> --}}
            <div>
                <x-buttons.fill x-on:click="createLaboratoryState = true" color="purple">Tambah Laboratorium</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable id="laboratory-table">
                <thead>
                    <tr>
                        <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Kode Lab<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Laboratorium<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Ka. Laboratorium<i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < 10; $i++)
                        <tr wire:key='{{ $i }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>kode-{{ $i }}</td>
                            <td>Lab - {{ $i }}</td>
                            <td>Ka.Lab - {{ $i }}</td>
                            <td class="text-center text-nowrap">
                                <x-badges.outline x-on:click="showDetailLaboratory('{{ Crypt::encrypt($i) }}')" title="List Prodi" class="px-2.5 py-1.5" color="blue"><i class="fa-solid fa-rectangle-list fa-lg"></i></i></x-badges.outline>
                                <x-badges.outline x-on:click="showEditLaboratory('{{ Crypt::encrypt($i) }}')" class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('editLaboratoryModal', () => {
                return {
                    editLaboratoryState: false,
                    showEditLaboratory(id) {
                        $wire.dispatch("initEditLaboratory", {id: id});
                        this.editLaboratoryState = true;
                    }
                }
            })

            Alpine.data('detailLaboratoryModal', () => {
                return {
                    detailLaboratoryState: false,
                    showDetailLaboratory(id) {
                        $wire.dispatch("initDetailLaboratory", {id: id});
                        this.detailLaboratoryState = true;
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
