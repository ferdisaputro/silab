<x-container x-data="Object.assign({createAcademicYearState: false}, academicYear())">
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
            <div>
                <x-buttons.fill x-on:click="createAcademicYearState = true" color="purple">Tambah Tahun Ajaran</x-buttons.fill>
            </div>
        </div>

        <div x-data="changeDataStatus">
            <x-tables.datatable>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($academicYears as $academicYear)                        
                        <tr wire:key='{{ $loop->iteration }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</td>
                            <td>{{ $academicYear->start_year." / ".$academicYear->end_year }}</td>
                            <td>{{ $academicYear->is_even? "Genap" : "Ganjil" }}</td>
                            <td>
                                <x-badges.fill :color="$academicYear->is_active? 'blue' : 'yellow'" class="px-2.5 py-1.5"
                                    x-on:click="changeStatus('{{ Crypt::encrypt($academicYear->id) }}', {{ $academicYear->is_active }})">{{ $academicYear->is_active? "Aktif" : "Non Aktif" }}</x-badges.fill>
                            </td>
                            <td class="text-center">
                                <x-badges.outline x-on:click="showEditAcademicYear('{{ Crypt::encrypt($academicYear->id) }}')" class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline x-on:click="deleteAcademicYear('{{ Crypt::encrypt($academicYear->id) }}', '{{ $academicYear->start_year.' / '.$academicYear->end_year.' '.($academicYear->is_even? 'Genap' : 'Ganjil') }}')" class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('academicYear', () => {
                return {
                    editAcademicYearState: false,
                    showEditAcademicYear(key) {
                        $wire.dispatch('initEditAcademicYear', {key: key});
                        this.editAcademicYearState = true;
                    },
                    deleteAcademicYear(key, name) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus tahun ajaran ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Tahun ajaran Berhasil Dihapus', 'success')
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
					changeStatus(key, status) {
                        console.log(status || status == "1");
                        
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
				}
            })
        </script>
    @endscript
@endPushOnce
