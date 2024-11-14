<x-container x-data="Object.assign({createAcademicYearState: false}, editAcademicYear())">
    <div>
        <x-modals.modal identifier="createAcademicYearState" max_width="max-w-3xl">
            <livewire:pages.academic-year.create />
        </x-modals.modal>

        <x-modals.modal identifier="editAcademicYearState" max_width="max-w-3xl">
            <livewire:pages.academic-year.edit />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Data Tahun Ajaran
            </x-text.page-title>
            {{-- <a href="{{ route('academicYear.create') }}" wire:navigate> --}}
            <div>
                <x-buttons.fill x-on:click="createAcademicYearState = true" color="purple">Tambah Tahun Ajaran</x-buttons.fill>
            </div>
        </div>

        <div x-data="changeDataStatus">
            <x-tables.datatable id="tabel-role">
                <thead>
                    <tr>
                        <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Tahun Ajaran<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Semester<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Status<i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($year = 2021; $year < 2026; $year+=2)
                        <tr wire:key='{{ $year }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $year - 2020 }}</td>
                            <td>{{ $year." / ".$year + 1 }}</td>
                            <td>Ganjil</td>
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
                                <x-badges.outline x-on:click="showEditAcademicYear('{{ Crypt::encrypt($year - 2020) }}')" class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                            </td>
                        </tr>
                        <tr wire:key='{{ $year + 1 }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ ($year + 1) - 2020 }}</td>
                            <td>{{ $year." / ".$year + 1 }}</td>
                            <td>Genap</td>
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
                                <x-badges.outline x-on:click="showEditAcademicYear('{{ Crypt::encrypt(($year + 1) - 2020) }}')" class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
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
            Alpine.data('editAcademicYear', () => {
                return {
                    editAcademicYearState: false,
                    showEditAcademicYear(id) {
                        $wire.dispatch('initEditAcademicYear', {id: id});
                        this.editAcademicYearState = true;
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
