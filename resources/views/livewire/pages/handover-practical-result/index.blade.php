<x-container>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <div>
                <x-text.page-title>
                    Tabel Serah Terima Hasil & Sisa Praktikum
                </x-text.page-title>

                {{-- Pilihan Lab di bawah judul --}}
                <div class="mt-3">
                    <x-forms.select
                        class="mt-3 ml-2"
                        name="selectedLab"
                        label="Pilih Lab"
                        wire:model.live='selectedLab'>
                        @foreach($this->laboratories as $lab)
                            <option value="{{ $lab->id }}" {{ $lab->id == $selectedLab ? "selected" : "" }}>
                                {{ $lab->code }} - {{ $lab->name }}
                            </option>
                        @endforeach
                    </x-forms.select>
                </div>
            </div>

            <div>
                <a href="{{ route('handover-practical-result.create', ['id' => Crypt::encrypt($selectedLab)])}}" wire:navigate>
                    <x-buttons.fill title="Tambah Kesiapan Bahan Praktikum" color="purple">
                        Buat Serah Terima Hasil & Sisa Praktikum
                    </x-buttons.fill>
                </a>
            </div>
        </div>

        <div>
            <x-tables.datatable :data="$this->handOvers" eventTarget="handOver" id="tabel-practicumHandOver">
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Mata Kuliah <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Dosen Pengampu <i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dump($this->handOvers) --}}
                    @foreach ($this->handOvers as $handOver)
                    <tr wire:key='{{ $loop->iteration + ($this->handOvers->perPage() * ($this->handOvers->currentPage() - 1)) }}'>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->handOvers->perPage() * ($this->handOvers->currentPage() - 1)) }}</td>
                        <td>{{ $handOver->courseInstructor->semesterCourse->course->course }}</td>
                        <td>{{ $handOver->courseInstructor->staff->user->name?? "N/A" }}</td>
                        <td class="flex flex-wrap gap-2 text-center" x-data="handOver">
                            <x-badges.outline title="Print" class="px-2.5 py-1.5" color="yellow">
                                <i class="fa-regular fa-print fa-lg"></i>
                            </x-badges.outline>

                            <a href="{{ route('handover-practical-result.edit', ['id' => Crypt::encrypt($handOver->id)])}}" wire:navigate>
                            <x-badges.outline title="Ubah" class="px-2.5 py-1.5" color="teal">
                                <i class="fa-regular fa-pen-to-square fa-lg"></i>
                            </x-badges.outline>
                            </a>

                            <x-badges.outline
                                title="Hapus"
                                class="px-2.5 py-1.5"
                                color="red"
                                x-on:click="deleteHandOver('{{ Crypt::encrypt($handOver->id) }}')">
                                <i class="fa-regular fa-trash-can fa-lg"></i>
                            </x-badges.outline>
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
            Alpine.data('handOver', () => {
                return {
                    deleteHandOver(key) {
                        // console.log("Key yang diterima:", key);
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus Data Serah Terima?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Serah Terima Berhasil Dihapus', 'success')
                                    $wire.$refresh() //refresh component from the parent of this component wich is index
                                } else
                                    swal.fire('Gagal', 'Data Serah Terima Gagal Dihapus: ' + result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endpushOnce

