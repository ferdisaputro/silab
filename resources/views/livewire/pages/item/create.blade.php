<div>
    <form x-data="createItem" x-on:submit.prevent="submitHandler">
        <x-text.page-title class="mb-6"> Tambah Barang </x-text.page-title>
        <div class="flex flex-col gap-8 mb-6 md:gap-6 md:flex-row">
            <div class="flex flex-col flex-1 space-y-5">
                <x-alerts.outline message="Data barang yang akan ditambahkan" icon="fa-caret-right" />
                <div class="grid flex-1 grid-cols-1 gap-4 lg:grid-cols-2">
                    <x-forms.input
                        name="item_code"
                        label="Kode Barang"
                        key="item_code"
                        type="text"
                        wire:model.live.debounce="item_code"/>
                    <x-forms.input
                        name="item_name"
                        label="Nama Barang"
                        key="item_name"
                        type="text"
                        wire:model.live.debounce="item_name" />
                    <x-forms.select
                        name="item_type_id"
                        label="Jenis barang"
                        key="item_type_id"
                        wire:model.live.debounce="item_type_id">
                        @foreach ($itemTypes as $itemType)
                            <option value="{{ $itemType->id }}">{{ ucfirst($itemType->item_type) }}</option>
                        @endforeach
                    </x-forms.select>

                    <x-forms.select
                        name="unit_id"
                        label="Satuan Default"
                        key="unit_id"
                        wire:model.live.debounce="unit_id">
                        @foreach ($unitItems as $unitItem)
                        <option value="{{ $unitItem->id }}" {{ $unitItem->id == $satuanText ? 'selected' : '' }}>{{ ucfirst($unitItem->satuan) }}
                        @endforeach
                    </x-forms.select>

                    <x-forms.textarea
                        name="specification"
                        label="Spesifikasi"
                        key="specification"
                        wire:model.live.debounce="specification" />
                    <x-forms.textarea
                        name="description"
                        label="Keterangan"
                        key="description"
                        wire:model.live.debounce="description" />
                </div>

                    <x-buttons.fill
                        type="submit"
                        class="hidden w-full md:inline-block">
                        Tambah Barang
                    </x-buttons.fill>
                </div>

            <div class="flex flex-col flex-1 space-y-5 md:max-w-72 lg:max-w-80">
                <x-alerts.outline message="Satuan barang" icon="fa-caret-right" color="yellow" />
                <div class="flex-1 space-y-3">
                    <div class="flex gap-4">
                        <x-forms.input
                        name="satuan_barang"
                        label="Satuan"
                        key="satuan_barang"
                        wire:model.live.debounce="satuan_barang" readonly />
                        <x-forms.input
                        name="quantity"
                        label="Qty"
                        key="quantity"
                        type="number"
                        wire:model.live.debounce="quantity" />
                    </div>
                </div>
                <x-buttons.outline wire:click="resetForm" class="hidden w-full md:inline-block ">Reset</x-buttons.outline>
            </div>
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
                            title: 'Tambah Item Baru?',
                            text: 'Pastikan Data Item Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data item Berhasil Ditambahkan', 'success')
                                    // this.$el.closest('form').reset() // reset form
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Item Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce

{{-- <div class="flex gap-4">
            <x-buttons.outline color='red' wire:click="resetForm; $refs.form.reset()" class="inline-block w-full md:hidden max-w-40">
                    Reset
            </x-buttons.outline>
            <x-buttons.fill type="submit" class="inline-block w-full md:hidden">
                Tambah
            </x-buttons.fill>
        </div> --}}
