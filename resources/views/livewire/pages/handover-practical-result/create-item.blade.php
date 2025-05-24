<div>
    <form x-data="createItem" x-on:submit.prevent="submitHandler">
        <div class="space-y-6">
            <x-alerts.outline message="Tambah Praktikum" color="green"/>
            <div class="space-y-4">
                @foreach ($items as $index => $item)
                    <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                        <x-forms.input
                            class="flex-1 min-w-56 md:max-w-72"
                            wire:model.live.debounce='items.{{ $index }}.praktikum'
                            name="items.{{ $index }}.praktikum"
                            label="Nama Hasil Praktikum">

                        </x-forms.input>

                        <x-forms.select
                            class="flex-1 min-w-24 md:max-w-40"
                            wire:model.live.debounce='items.{{ $index }}.satuan'
                            name="items.{{ $index }}.satuan"
                            label="Pilih Satuan">
                                @foreach ($this->Units as $unit )
                                    <option value="{{ $unit->id }}">{{ $unit->satuan }}</option>
                                @endforeach
                        </x-forms.select>

                        <x-forms.textarea
                            class="flex-1 min-w-full max-w-full"
                            label="Acara Praktek"
                            wire:model.live.debounce='items.{{ $index }}.description'
                            name="items.{{ $index }}.description">

                        </x-forms.textarea>

                        <div class="flex justify-end gap-2">
                            @if (count($items) > 1)
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
            <x-buttons.fill
                type="submit" class="hidden w-full md:inline-block">
                    Tambah Barang
            </x-buttons.fill>
        </div>
    </form>
</div>
@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createItem', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Tambah Hasil Praktikum Baru?',
                            text: 'Pastikan Data Hasil Praktikum Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Hasil Praktikum Berhasil Ditambahkan', 'success')
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Hasil Praktikum Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
