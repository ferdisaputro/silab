<div>
    <x-text.page-title class="mb-5" wire:loading.remove>Ubah Permission {{ $editPermissionName }}</x-text.page-title>
    <x-text.page-title class="mb-5" wire:loading>Loading...</x-text.page-title>
    {{-- x-data="ubahPegawai" x-on:submit.prevent="ubah" --}}
    <form class="space-y-4" x-data="editPermission" x-on:submit.prevent="submitHandler">
        <div class="relative">
            <div class="relative flex gap-3">
                <x-forms.input
                    wire:model.live.debounce="editPermissionName"
                    name="editPermissionName"
                    key="editPermissionName"
                    label="Nama Permission"
                    class="flex-1" />
            </div>
        </div>
        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Ubah Permission</x-buttons.outline>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editPermission', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Data Permission',
                            text: 'Pastikan Data Permission Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.edit()
                                // console.log(result);
                                // return
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', result.original.message, result.original.status)
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Permission Gagal Diubah :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
