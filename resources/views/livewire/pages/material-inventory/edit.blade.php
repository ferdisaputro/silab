<div>
    <x-text.page-title class="mb-5" wire:loading.remove>Edit Bahan {{ $materialTopName }} </x-text.page-title>
        <x-text.page-title class="mb-5" wire:loading>Loading...</x-text.page-title>
    <form x-data="editLabItem" x-on:submit.prevent="submitHandler" class="space-y-4">
        <div class="flex gap-4">
            <x-forms.select class="flex-1"
                name="editItemId"
                label="Pilih Bahan"
                key="editItemId"
                disabled
                wire:model="editItemId">
                @foreach ($items as $item)
                <option value="{{ $item->id }}" {{ $item->id == $materialName ? 'selected' : '' }}>
                    {{ ucfirst($item->item_name) }}
                </option>
                @endforeach
            </x-forms.select>
            <x-forms.input class="w-full max-w-40"
                name="editStock"
                label="Jumlah"
                key="editStock"
                wire:model="editStock"/>
        </div>

        <div class="text-center">
            <x-buttons.fill type="submit" class="w-full max-w-xs">Ubah</x-buttons.fill>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editLabItem', () => {
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
