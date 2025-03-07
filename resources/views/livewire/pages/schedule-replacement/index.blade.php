<x-container>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <div>
                <x-text.page-title>
                    Tabel Peminjaman Alat Praktikum
                </x-text.page-title>
                {{-- <x-forms.select
                    class="mt-3 ml-2"
                    name="selectedLab"
                    label="Pilih Lab"
                    wire:model.live='selectedLab'
                    wire:key='{{ $selectedLab }}'
                >
                    @foreach ($this->laboratories as $lab)
                        <option value="{{ $lab->id }}" {{ $lab->id == $selectedLab? "selected" : "" }}>{{ $lab->code }} - {{ $lab->name }} (Jurusan : {{ $lab->department->department }})</option>
                    @endforeach
                </x-forms.select> --}}
            </div>
            <div>
                <a href="{{ route('schedule-replacement.create') }}" wire:navigate>
                    <x-buttons.fill title="Tambah Kesiapan Bahan Praktikum" color="purple">Buat Penggantian Jadwal</x-buttons.fill>
                </a>
            </div>
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
                        <th class="text-center">Action</th>
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
                            <td class="flex flex-wrap justify-center gap-2 text-center">
                                <x-badges.outline title="Print" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-print fa-lg"></i></x-badges.outline>
                                <a href="{{ route('schedule-replacement.edit', ['id' => Crypt::encrypt($schedule->id)]) }}" wire:navigate>
                                    <x-badges.outline title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                </a>
                                <x-badges.outline x-data="schedule()" x-on:click="deleteScheduleReplacement('{{ Crypt::encrypt($schedule->id) }}')" title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
