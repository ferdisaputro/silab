<x-container x-data="Object.assign({createSubjectState: false}, editSubject())">
    <div>
        <x-modals.modal identifier="createSubjectState" max_width="max-w-3xl">
            <livewire:pages.subject.create />
        </x-modals.modal>

        <x-modals.modal identifier="editSubjectState" max_width="max-w-3xl">
            <livewire:pages.subject.edit />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Data Mata Kuliah
            </x-text.page-title>
            {{-- <a href="{{ route('subject.create') }}" wire:navigate> --}}
            <div>
                <x-buttons.fill x-on:click="createSubjectState = true" color="purple">Tambah Mata Kuliah</x-buttons.fill>
            </div>
        </div>

        <div x-data="changeDataStatus">
            <x-tables.datatable id="tabel-role">
                <thead>
                    <tr>
                        <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Kode Matkul<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Nama Matkul<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Status<i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 30; $i++)
                        <tr wire:key='{{ $i }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>{{ Str::random(5) }}</td>
                            <td>{{ Str::random(5) }}</td>
                            <td>
                                @if (mt_rand(0, 1))
                                    <x-badges.fill color="blue" class="px-2.5 py-1.5"
                                        x-on:click="changeToNonActive">Aktif</x-badges.fill>
                                @else
                                    <x-badges.fill color="yellow" class="px-2.5 py-1.5"
                                        x-on:click="changeToActive">Non Aktif</x-badges.fill>
                                @endif
                            </td>
                            <td class="text-center">
                                <x-badges.outline x-on:click="showEditSubject('{{ Crypt::encrypt($i) }}')" class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
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
            Alpine.data('editSubject', () => {
                return {
                    editSubjectState: false,
                    showEditSubject(id) {
                        $wire.dispatch('initEditSubject', {id: id});
                        this.editSubjectState = true;
                    }
                }
            })

            Alpine.data('changeDataStatus', () => {
				return {
					changeToNonActive() {
						swal.fire({
							title: 'Ubah Status',
							text: 'Ubah status ke non aktif',
							icon: 'warning',
							confirmButtonText: 'Ya',
							cancelButtonText: 'Tidak',
							showCloseButton: true,
							showCancelButton: true
						})
					},
					changeToActive() {
						swal.fire({
							title: 'Ubah Status',
							text: 'Ubah status ke aktif',
							icon: 'warning',
							confirmButtonText: 'Ya',
							cancelButtonText: 'Tidak',
							showCloseButton: true,
							showCancelButton: true
						})
					}
				}
            })
        </script>
    @endscript
@endPushOnce
