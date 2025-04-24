<x-container x-data="Object.assign({createAcademicWeekState: false}, showEditAcademicWeek())">
    <div>
        {{-- // $this->authorize('hasPermissionTo', 'minggu-list|minggu-create|minggu-edit|minggu-delete'); --}}
        @can('minggu-create')
            <x-modals.modal identifier="createAcademicWeekState" max_width="max-w-xl">
                <livewire:pages.academic-week.create />
            </x-modals.modal>
        @endcan

        @can('minggu-edit')
            <x-modals.modal identifier="editAcademicWeekState" max_width="max-w-xl">
                <livewire:pages.academic-week.edit />
            </x-modals.modal>
        @endcan
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Minggu Akademik
            </x-text.page-title>
            @can('minggu-create')
                <div>
                    <x-buttons.fill x-on:click="createAcademicWeekState = true" title="" color="purple">Tambah Minggu Akademik</x-buttons.fill>
                </div>
            @endcan
        </div>

        <div>
            <x-tables.datatable :data="$this->academicWeeks" eventTarget="academicWeek">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Minggu Ke</th>
                        <th>Tahun Ajaran</th>
                        <th>Awal Minggu</th>
                        <th>Akhir Minggu</th>
                        <th>Keterangan</th>
                        @can(['minggu-edit', 'minggu-delete'])
                            <th class="text-center">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->academicWeeks as $week)
                        <tr wire:key='{{ $loop->iteration + ($this->academicWeeks->perPage() * ($this->academicWeeks->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->academicWeeks->perPage() * ($this->academicWeeks->currentPage() - 1)) }}</td>
                            <td>{{ $week->week_number }}</td>
                            <td>{{ $week->academicYear->start_year }} / {{ $week->academicYear->end_year }} ({{ $week->academicYear->is_even? "Genap" : "Ganjil" }})</td>
                            <td>{{ date('d/m/Y', strtotime($week->start_date)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($week->end_date)) }}</td>
                            <td>{{ $week->description }}</td>
                            @can(['minggu-edit', 'minggu-delete'])
                                <td class="text-center flex flex-wrap gap-1.5">
                                    @can('minggu-edit')
                                        <x-badges.outline x-on:click="showEditAcademicWeek('{{ Crypt::encrypt($week->id) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                    @endcan
                                    @can('minggu-delete')
                                        <x-badges.outline x-on:click="deleteAcademicWeek('{{ Crypt::encrypt($week->id) }}', '{{ $week->week_number.' tahun ajaran '. $week->academicYear->start_year.' / '.$week->academicYear->end_year.' '.($week->academicYear->is_even? 'Genap' : 'Ganjil') }}')" title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                                    @endcan
                                </td>
                            @endcan
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
            Alpine.data('showEditAcademicWeek', () => {
                return {
                    editAcademicWeekState: false,
                    showEditAcademicWeek (key) {
                        $wire.dispatch('initEditAcademicWeek', {key: key});
                        this.editAcademicWeekState = true;
                    },
                    deleteAcademicWeek(key, name) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus minggu ke ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Minggu Ajaran Berhasil Dihapus', 'success')
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
