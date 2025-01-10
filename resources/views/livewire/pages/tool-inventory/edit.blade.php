<div>
    <x-text.page-title class="mb-5" wire:loading.remove>Edit Alat {{ $toolTopName }}</x-text.page-title>
    <x-text.page-title class="mb-5" wire:loading>Loading...</x-text.page-title>
    <form x-data="editLabTool" x-on:submit.prevent="submitHandler" class="space-y-4">
        <div class="flex gap-4">
            <x-forms.select class="flex-1"
                name="editItemIdTool"
                label="Pilih Bahan"
                key="editItemIdTool"
                wire:model.live.debounce="editItemIdTool">
                @foreach ($items as $item)
                <option value="{{ $item->id }}" {{ $item->id == $toolName ? 'selected' : '' }}>
                    {{ ucfirst($item->item_name) }}
                </option>
                @endforeach
            </x-forms.select>
            <x-forms.input class="w-full max-w-40"
            name="editStockTool"
            label="Jumlah"
            key="editStockTool"
            wire:model.live.debounce="editStockTool"/>
        </div>

        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Ubah</x-buttons.outline>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editLabTool', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Edit Alat ?',
                            text: 'Pastikan Data Alat Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.edit   ()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Alat Berhasil di Edit', 'success')
                                    // this.$el.closest('form').reset() // reset form
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Alat Gagal di Edit:'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
