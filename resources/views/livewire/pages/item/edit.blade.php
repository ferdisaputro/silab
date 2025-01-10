<div>
    <form x-data="editItem" x-on:submit.prevent="submitHandler">
        <x-text.page-title class="mb-5" wire:loading.remove>Edit Barang {{ $editItemName}}</x-text.page-title>
        <x-text.page-title class="mb-5" wire:loading>Loading...</x-text.page-title>
        <div class="flex flex-col gap-8 mb-6 md:gap-6 md:flex-row">
            <div class="flex flex-col flex-1 space-y-5">
                <x-alerts.outline message="Data barang yang akan di Edit" icon="fa-caret-right" />
                <div class="grid flex-1 grid-cols-1 gap-4 lg:grid-cols-2">
                    <x-forms.input
                        name="editItemCode"
                        label="Kode Barang"
                        key="editItemCode"
                        type="text"
                        wire:model.live.debounce="editItemCode"/>
                    <x-forms.input
                        name="editItemName"
                        label="Barang"
                        key="editItemName"
                        type="text"
                        wire:model.live.debounce="editItemName" />
                    <x-forms.select
                        name="editType"
                        label="Jenis Barang"
                        key="editType"
                        wire:model.live.debounce="editType">
                        @foreach ($itemTypes as $itemType)
                            <option value="{{ $itemType->id }}">{{ ucfirst($itemType->item_type) }}</option>
                        @endforeach
                    </x-forms.select>

                    <x-forms.select
                        name="editUnit"
                        label="Satuan Default"
                        key="editUnit"
                        wire:model.live.debounce="editUnit">
                        @foreach ($unitItems as $unitItem)
                            <option value="{{ $unitItem->id }}" {{ $unitItem->id == $satuanText ? 'selected' : '' }}>
                                {{ ucfirst($unitItem->satuan) }}
                            </option>
                        @endforeach
                    </x-forms.select>

                    <x-forms.textarea
                        name="editSpec"
                        label="Spesifikasi"
                        key="editSpec"
                        wire:model.live.debounce="editSpec"></x-forms.textarea>
                    <x-forms.textarea
                        name="editDesc"
                        label="Keterangan"
                        key="editDesc"
                        wire:model.live.debounce="editDesc"></x-forms.textarea>
                </div>

                <x-buttons.fill
                    type="submit"
                    class="hidden w-full md:inline-block">
                    Edit Barang
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
                            wire:model.live.debounce="satuan_barang"
                            readonly />
                        <x-forms.input
                            name="editQty"
                            label="Qty"
                            key="editQty"
                            type="number"
                            wire:model.live.debounce="editQty" />
                    </div>
                </div>
                <x-buttons.outline wire:click="resetForm" class="hidden w-full md:inline-block">Reset</x-buttons.outline>
            </div>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editItem', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Edit Item ?',
                            text: 'Pastikan Data Item Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.edit   ()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data item Berhasil di Edit', 'success')
                                    // this.$el.closest('form').reset() // reset form
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Item Gagal di Edit:'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
