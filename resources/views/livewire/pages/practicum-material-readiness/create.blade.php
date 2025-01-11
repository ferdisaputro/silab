<x-container x-data="Object.assign({createPracMatReadyState: false}, detailPracMatReady(), editPracMatReady())">
    {{-- <div>
        <x-modals.modal identifier="createPracMatReadyState" max_width="max-w-xl">
            <livewire:pages.practicum-material-readiness.create />
        </x-modals.modal>

        <x-modals.modal identifier="editPracMatReadyState" max_width="max-w-xl">
            <livewire:pages.practicum-material-readiness.edit />
        </x-modals.modal>

        <x-modals.modal identifier="detailPracMatReadyState" max_width="max-w-4xl">
            <livewire:pages.practicum-material-readiness.detail />
        </x-modals.modal>
    </div> --}}

    <div class="p-5 space-y-7 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Laporan Kesiapan Bahan Praktikum
            </x-text.page-title>
        </div>

        <div class="space-y-5">
            <x-alerts.outline class="mb-5" message="Informasi Praktek" />
            <div class="space-y-4">
                <div class="flex gap-4">
                    <x-forms.select class="flex-1" name="prodi" label="Pilih Program Studi">
                        @foreach ($Prodis as $prodi )
                            <option value="{{ $prodi->id }}">{{ $prodi->department }}</option>
                        @endforeach
                    </x-forms.select>

                    <div class="flex flex-1 gap-4">
                        <x-forms.select class="flex-1" name="tahun_ajaran" label="Pilih Tahun Ajaran">
                            @foreach ($Years as $year)
                                <option value="{{ $year->id }}">{{ $year->year }}</option>
                            @endforeach
                        </x-forms.select>

                        <x-forms.select class="flex-1" name="semester" label="Pilih Semester">
                            @foreach ($Courses as $course )
                                <option value="{{ $course->id }}">{{ $course->course }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex gap-4">
                    <x-forms.select class="flex-1" name="mata_kuliah" label="Pilih Mata Kuliah">
                        @foreach ($Matkuls as $matkul )
                            <option value="{{ $matkul->id }}">{{ $matkul->study_program }}</option>
                        @endforeach
                    </x-forms.select>
                    <x-forms.select class="flex-1" name="dosen" label="Pilih Dosen">
                        @foreach ($Dosens as $dosen )
                            <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                        @endforeach
                    </x-forms.select>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex gap-4">
                    <x-forms.select class="flex-1" name="minggu" label="Pilih Minggu">
                        @foreach ($Weeks as $week )
                            <option value="{{ $week->id }}">{{ $week->week_number }}</option>
                        @endforeach
                    </x-forms.select>
                    <x-forms.input name="tanggal" label="Tanggal" type="datepicker" />

                    <x-forms.select class="flex-1" name="rekomendasi_dosen" label="Rekomendasi Dosen">
                        <option value="key1">test1</option>
                        <option value="key2">test2</option>
                        <option value="key3">test3</option>
                        <option value="key4">test4</option>
                    </x-forms.select>
                </div>
            </div>
        </div>

        <div class="space-y-5">
            <x-alerts.outline class="mb-5" color='teal' message="Berdasarkan hasil uji coba alat/mesin dan kesiapan bahan praktek dapat dilaporkan sebagai berikut :" />
            <div class="space-y-4">
                @foreach ($test_results as $index => $test_result)
                    <div class="flex gap-4">
                        <x-forms.select class="flex-1"
                        wire:model="test_results.{{ $index }}.bahan"
                        wire:change="handleItemChange({{ $index }}, $event.target.value)"
                        name="test_results.{{ $index }}.bahan"
                        label="Pilih Barang">
                        @foreach ($Items as $item)
                            <option value="{{ $item->id }}">{{ ucfirst($item->item_name) }}</option>
                        @endforeach
                    </x-forms.select>

                    <!-- Input untuk stok -->
                        <x-forms.input class="max-w-20"
                            wire:model="test_results.{{ $index }}.stok"
                            name="test_results.{{ $index }}.stok"
                            label="Stok"
                            disabled="true" />


                        <x-forms.input class="max-w-20"
                            wire:model='test_results.{{ $index }}.jumlah'
                            name="test_results.{{ $index }}.jumlah"
                            label="Jumlah" />

                        <x-forms.select class="flex-1 max-w-60" wire:model='test_results.{{ $index }}.tahun_ajaran' name="test_results.{{ $index }}.tahun_ajaran" label="Pilih Satuan">
                            @foreach ($Units as $unit )
                                <option value="{{$unit->id}}">{{$unit->satuan}}</option>
                            @endforeach
                        </x-forms.select>

                        <x-forms.input class="flex-1" wire:model='test_results.{{ $index }}.keterangan' name="test_results.{{ $index }}.keterangan" label="Keterangan" />

                        <div class="flex gap-2">
                            @if (count($test_results) > 1)
                                <x-buttons.outline wire:click='removeTestResult({{ $index }})' color="yellow">
                                    <i class="fa-solid fa-trash-can"></i>
                                </x-buttons.outline>
                            @endif

                            @if ($loop->iteration == 1)
                                <x-buttons.outline wire:click='addTestResult' color="blue">
                                    <i class="fa-solid fa-plus"></i>
                                </x-buttons.outline>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="text-center">
            <x-buttons.fill class="w-full max-w-xs">Simpan Laporan</x-buttons.fill>
        </div>
    </div>
</x-container>


{{-- @pushOnce('scripts')
    @script
        <script>
            Alpine.data('detailPracMatReady', () => {
                return {
                    detailPracMatReadyState: false,
                    showDetailPracMatReady (id) {
                        $wire.dispatch('initDetailPracMatReady', {id: id});
                        this.detailPracMatReadyState = true;
                    }
                }
            })

            Alpine.data('editPracMatReady', () => {
                return {
                    editPracMatReadyState: false,
                    showEditPracMatReady (id) {
                        $wire.dispatch('initEditPracMatReady', {id: id});
                        this.editPracMatReadyState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce --}}
