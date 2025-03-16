<x-container>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            {{-- $this->authorize("hasPermissionTo", 'penggantian-praktek-list|penggantian-praktek-create|penggantian-praktek-edit|penggantian-praktek-delete'); --}}

            <div>
                <x-text.page-title>
                    Tabel Pergantian Jadwal
                </x-text.page-title>
            </div>
            @can('penggantian-praktek-create')
                <div>
                    <a href="{{ route('schedule-replacement.create') }}" wire:navigate>
                        <x-buttons.fill title="Tambah Kesiapan Bahan Praktikum" color="purple">Buat Penggantian Jadwal</x-buttons.fill>
                    </a>
                </div>
            @endcan
        </div>

        <div>
            <x-tables.datatable id="schedule-table" :data="$this->Schedules" eventTarget="schedule">
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th data-sortby="real_schedule">Jadwal Asli <i class="fa-solid fa-sort ms-2"></i></th>
                        <th data-sortby="replacement_schedule">Jadwal Ganti <i class="fa-solid fa-sort ms-2"></i></th>
                        <th data-sortby="">Mata Kuliah <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Dosen <i class="fa-solid fa-sort ms-2"></i></th>
                        @can(['penggantian-praktek-edit', 'penggantian-praktek-delete'])
                            <th class="text-center">Action</th>
                        @endcan
                    </tr>
                </thead>
                {{-- ('{{ $this->Schedules->course->course }}') --}}
                <tbody>
                    @foreach ($this->Schedules as $index => $schedule )
                    {{-- @dump($schedule->lecturer) --}}
                        <tr wire:key='{{ $loop->iteration + ($this->schedules->perPage() * ($this->schedules->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->schedules->perPage() * ($this->schedules->currentPage() - 1)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($schedule->real_schedule)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($schedule->replacement_schedule)) }}</td>
                            <td>{{ $schedule->course->course }}</td>
                            <td>{{ $schedule->lecturer->user->name }}</td>
                            @can(['penggantian-praktek-edit', 'penggantian-praktek-delete'])
                                <td class="flex flex-wrap justify-center gap-2 text-center">
                                    <x-badges.outline title="Print" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-print fa-lg"></i></x-badges.outline>
                                    @can('penggantian-praktek-edit')
                                        <a href="{{ route('schedule-replacement.edit', ['id' => Crypt::encrypt($schedule->id)]) }}" wire:navigate>
                                            <x-badges.outline title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                        </a>
                                    @endcan
                                    @can('penggantian-praktek-delete')
                                        <x-badges.outline x-data="schedule()" x-on:click="deleteScheduleReplacement('{{ Crypt::encrypt($schedule->id) }}')" title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('schedule', () => {
                return {
                    deleteScheduleReplacement(key) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus penggantian jadwal?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Penggantian Jadwal Berhasil Dihapus', 'success')
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
