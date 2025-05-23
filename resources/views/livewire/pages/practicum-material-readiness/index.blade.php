<x-container >
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            {{-- @dump($this->laboratories) --}}
            <div>
                <x-text.page-title>
                    Tabel Kesiapan Bahan Praktikum
                </x-text.page-title>
                <x-forms.select
                    class="mt-3 ml-2"
                    name="selectedLab"
                    label="Pilih Lab"
                    wire:model.live='selectedLab'
                >
                    @foreach ($this->laboratories as $lab)
                        <option value="{{ $lab->id }}" {{ $lab->id == $selectedLab? "selected" : "" }}>
                            {{ $lab->code }} - {{ $lab->name }}</option>
                    @endforeach
                </x-forms.select>
            </div>
            <div>
                <a href="{{ route('prac-mat-ready.create', ['id' => Crypt::encrypt($selectedLab)]) }}" wire:navigate>
                    <x-buttons.fill title="Tambah Kesiapan Bahan Praktikum" color="purple">
                        Tambah Peminjaman</x-buttons.fill>
                </a>
            </div>
        </div>

        <div>
            <x-tables.datatable :data="$this->practicumMaterialReadiness" id="tabel-pracMatReady" eventTarget="PracMat">
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
                    @foreach ($this->practicumMaterialReadiness as $index => $PracMat)
                        <tr wire:key='{{ $loop->iteration + ($this->practicumMaterialReadiness->perPage() * ($this->practicumMaterialReadiness->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->practicumMaterialReadiness->perPage() * ($this->practicumMaterialReadiness->currentPage() - 1)) }}</td>
                            <td>{{ $PracMat->semesterCourse->course->course}}</td>
                            <td>{{ $PracMat->semesterCourse->semester->semester }}</td>
                            <td>{{ $PracMat->academicWeek->week_number }}</td>
                            <td>
                                @if ($PracMat->recomendation == 1)
                                    Siapkan dan Lanjutkan
                                @elseif ($PracMat->recomendation == 2)
                                    Dimodifikasi
                                @elseif ($PracMat->recomendation == 3)
                                    Diganti Acara Praktek yang Lain
                                @elseif ($PracMat->recomendation == 4)
                                    Ditunda
                                @else
                                    Tidak Diketahui
                                @endif
                            </td>
                            <td class="text-center">
                                {{-- <x-badges.outline
                                    title="cetak"
                                    class="px-2.5 py-1.5"
                                    color="yellow"><i class="fa-regular fa-print fa-lg"></i></x-badges.outline> --}}
                                <a href="{{ route('prac-mat-ready.edit', ['id' => Crypt::encrypt($PracMat->id)]) }}" wire:navigate>
                                    <x-badges.outline
                                        title="Edit"
                                        class="px-2.5 py-1.5"
                                        color="teal"><i
                                        class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                </a>
                                <x-badges.outline
                                    x-data="PracMat()"
                                    x-on:click="deleteKesiapan('{{ Crypt::encrypt($PracMat->id) }}')"
                                    title="Hapus" class="px-2.5 py-1.5"
                                    color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('PracMat', () => {
                return {
                    deleteKesiapan(key) {
                        // console.log("Key yang diterima:", key);
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus Kesiapan bahan?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Kesipan Bahan Berhasil Dihapus', 'success')
                                    $wire.$refresh() //refresh component from the parent of this component wich is index
                                } else
                                    swal.fire('Gagal', 'Data Kesiapan Bahan Gagal Dihapus: ' + result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endpushOnce

