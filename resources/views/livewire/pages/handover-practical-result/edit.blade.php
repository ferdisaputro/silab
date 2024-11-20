<x-container x-data="{createPracticumResultState: false}">
    <div>
        <x-modals.modal identifier="createPracticumResultState">
            <livewire:pages.handover-practical-result.table-practicum-result>
        </x-modals.modal>
    </div>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <x-text.page-title>
            Ubah Serah Terima Hasil & Sisa Praktikum
        </x-text.page-title>

        <div class="space-y-6">
            <x-alerts.outline message="Data Petugas" />
            <div class="grid grid-cols-1 gap-4 px-5 place-items-center md:grid-cols-2">
                <x-forms.select class="w-full" name="prodi" label="Pilih Program Studi">
                    <option value="key1">test1</option>
                    <option value="key2">test2</option>
                    <option value="key3">test3</option>
                    <option value="key4">test4</option>
                </x-forms.select>
                <div class="flex w-full gap-4">
                    <x-forms.select class="w-full" name="tahun_ajaran" label="Pilih Tahun Ajaran">
                        <option value="key1">test1</option>
                        <option value="key2">test2</option>
                        <option value="key3">test3</option>
                        <option value="key4">test4</option>
                    </x-forms.select>
                    <x-forms.select class="w-full" name="semester" label="Pilih Semester">
                        <option value="key1">test1</option>
                        <option value="key2">test2</option>
                        <option value="key3">test3</option>
                        <option value="key4">test4</option>
                    </x-forms.select>
                </div>

                <x-forms.select class="w-full" name="mata_kuliah" label="Pilih Mata Kuliah">
                    <option value="key1">test1</option>
                    <option value="key2">test2</option>
                    <option value="key3">test3</option>
                    <option value="key4">test4</option>
                </x-forms.select>
                <x-forms.select class="w-full" name="dosen" label="Pilih Dosen">
                    <option value="key1">test1</option>
                    <option value="key2">test2</option>
                    <option value="key3">test3</option>
                    <option value="key4">test4</option>
                </x-forms.select>

                <div class="w-full md:col-span-2">
                    <div class="flex justify-center gap-4 m-auto md:max-w-xl">
                        <x-forms.select class="flex-1" name="minggu" label="Pilih Minggu">
                            <option value="key1">test1</option>
                            <option value="key2">test2</option>
                            <option value="key3">test3</option>
                            <option value="key4">test4</option>
                        </x-forms.select>
                        <x-forms.input class="flex-1" name="tanggal" label="tanggal" type="datepicker" />
                    </div>
                </div>

                <div class="w-full md:col-span-2">
                    <div class="m-auto md:max-w-xl">
                        <x-forms.textarea name="acara_praktek" label="Acara Praktek"></x-forms.textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <x-alerts.outline message="Bahan Sisa Praktikum" color="green"/>
            <div class="px-5 space-y-4">
                @foreach ($bahanItems as $index => $item)
                    <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                        <x-forms.select class="flex-1 min-w-24" wire:model='bahanItems.{{ $index }}.bahan' name="bahanItems.{{ $index }}.bahan" label="Pilih Barang">
                            <option value="key1">test1</option>
                            <option value="key2">test2</option>
                            <option value="key3">test3</option>
                            <option value="key4">test4</option>
                        </x-forms.select>
                        
                        <x-forms.input class="flex-1 max-w-40" wire:model='bahanItems.{{ $index }}.sisa' name="bahanItems.{{ $index }}.sisa" label="Sisa" type="number"/>

                        <x-forms.select class="flex-1 min-w-24 md:max-w-60" wire:model='bahanItems.{{ $index }}.satuan' name="bahanItems.{{ $index }}.satuan" label="Pilih Satuan">
                            <option value="key1">test1</option>
                            <option value="key2">test2</option>
                            <option value="key3">test3</option>
                            <option value="key4">test4</option>
                        </x-forms.select>

                        <div class="flex justify-end gap-2">
                            @if (count($bahanItems) > 1)
                                <x-buttons.outline wire:click='removeBahanItem({{ $index }})' color="yellow">
                                    <i class="fa-solid fa-trash-can"></i>
                                </x-buttons.outline>
                            @endif

                            @if ($loop->iteration == 1)
                                <x-buttons.outline wire:click='addBahanItem' color="blue">
                                    <i class="fa-solid fa-plus"></i>
                                </x-buttons.outline>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="space-y-6">
            <div>
                <x-alerts.outline message="Data Hasil Praktikum" color="purple" class="mb-3"/>
                <x-buttons.outline x-on:click="createPracticumResultState = true" title="Tambah Data Hasil Praktikum" color="purple" class="ms-5">Tambah Data Hasil Praktikum</x-buttons.outline>
            </div>
            <div class="px-5 space-y-4">
                @foreach ($practicumResults as $index => $item)
                    <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                        <x-forms.select class="flex-1 min-w-24" wire:model='practicumResults.{{ $index }}.bahan' name="practicumResults.{{ $index }}.bahan" label="Pilih Barang">
                            <option value="key1">test1</option>
                            <option value="key2">test2</option>
                            <option value="key3">test3</option>
                            <option value="key4">test4</option>
                        </x-forms.select>
                        
                        <x-forms.input class="flex-1 max-w-60" wire:model='practicumResults.{{ $index }}.sisa' name="practicumResults.{{ $index }}.sisa" label="Sisa" type="number"/>

                        <div class="flex justify-end gap-2">
                            @if (count($practicumResults) > 1)
                                <x-buttons.outline wire:click='removePracticumResult({{ $index }})' color="yellow">
                                    <i class="fa-solid fa-trash-can"></i>
                                </x-buttons.outline>
                            @endif

                            @if ($loop->iteration == 1)
                                <x-buttons.outline wire:click='addPracticumResult' color="blue">
                                    <i class="fa-solid fa-plus"></i>
                                </x-buttons.outline>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="text-center">
            <x-buttons.fill title="Tambah Data" class="ms-5 min-w-xs">Ubah Data</x-buttons.fill>
        </div>
    </div>
</x-container>