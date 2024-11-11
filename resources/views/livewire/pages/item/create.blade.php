<div>
    <form action="" x-ref='form'>
        <x-text.page-title class="mb-6">
            Tambah Barang
        </x-text.page-title>
        <div class="flex flex-col gap-8 mb-6 md:gap-6 md:flex-row">
            <div class="flex flex-col flex-1 space-y-5">
                <x-alerts.outline message="Data barang yang akan ditambahkan" icon="fa-caret-right"/>
                <div class="grid flex-1 grid-cols-1 gap-4 lg:grid-cols-2">
                    <x-forms.input name="kode_barang" label="Kode Barang"></x-forms.input>
                    <x-forms.input name="barang" label="Barang"></x-forms.input>
                    <x-forms.select name="jenis_barang" label="Jenis barang">
                        <option value="alat">Alat</option>
                        <option value="bahan">Bahan</option>
                        <option value="hasil-praktek">Hasil Praktek</option>
                    </x-forms.select>
                    <x-forms.select name="satuan_default" label="Satuan Default">
                        <option value="rim">Rim</option>
                        <option value="pcs">Pcs</option>
                        <option value="pack">Pack</option>
                    </x-forms.select>
                    <x-forms.textarea class="min-h-32" placeholder="spesifikasi" name="spesifikasi" label="Spesifikasi" />
                    <x-forms.textarea class="min-h-32" placeholder="keterangan" name="keterangan" label="Keterangan" />
                </div>
                <x-buttons.fill type="submit" class="hidden w-full md:inline-block">
                    Tambah Barang
                </x-buttons.fill>
            </div>

            <div class="flex flex-col flex-1 space-y-5 md:max-w-72 lg:max-w-80">
                <x-alerts.outline message="Satuan barang" icon="fa-caret-right" color="yellow"/>
                <div class="flex-1 space-y-3">
                    @foreach ($unitItems as $index => $unitItem)
                        <div class="flex gap-4" wire:key='{{ $index }}'>
                            <x-forms.select height="h-10" class="flex-1" name="satuan - {{ $index }}" label="Satuan - {{ $index }}">
                                <option value="rim">Rim</option>
                                <option value="pcs">Pcs</option>
                                <option value="pack">Pack</option>
                            </x-forms.select>
                            <x-forms.input height="h-10" type="number" class="max-w-24" name="qty - {{ $index }}" label="Qty - {{ $index }}"></x-forms.input>
                            @if (count($unitItems) > 1)
                                <x-badges.outline wire:click='removeUnitItem({{ $index }})' color="yellow" title="Remove" class="px-4">
                                    <i class="fa-solid fa-trash-can"></i>
                                </x-badges.outline>
                            @endif
                        </div>
                    @endforeach

                    <div class="text-center">
                        <x-buttons.outline wire:loading.remove wire:click='addUnitItem' color="blue" class="w-full max-w-56" height="h-10">
                            <i class="fa-solid fa-plus"></i>
                        </x-buttons.outline>
                        <x-buttons.outline wire:loading wire:target='addUnitItem' color="blue" class="w-full max-w-56" height="h-10">
                            <x-loading.circle height="h-6" width="w-6"></x-loading.circle>
                        </x-buttons.outline>
                    </div>
                </div>
                <x-buttons.outline color='red' wire:click="resetForm; $refs.form.reset()" class="hidden w-full md:inline-block">
                    Reset
                </x-buttons.outline>
            </div>

            <div class="flex gap-4">
                <x-buttons.outline color='red' wire:click="resetForm; $refs.form.reset()" class="inline-block w-full md:hidden max-w-40">
                    Reset
                </x-buttons.outline>
                <x-buttons.fill type="submit" class="inline-block w-full md:hidden">
                    Tambah
                </x-buttons.fill>
            </div>
        </div>
    </form>
</div>
