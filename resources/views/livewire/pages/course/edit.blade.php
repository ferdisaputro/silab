<div>
    <x-text.page-title class="mb-5">
        Ubah Mata Kuliah
    </x-text.page-title>

    <form x-on:submit.prevent="submitHandler" x-data="editCourse()">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-forms.input wire:model.live.debounce='code' name="code" placeholder="TIF001" label="Kode Mata Kuliah" />
            <x-forms.input wire:model.live.debounce='course' name="course" label="Nama Mata Kuliah" />

            <div class="flex flex-col items-center justify-center gap-4 sm:flex-row md:col-span-2">
                <x-buttons.fill type="submit" class="w-full md:max-w-52">Ubah</x-buttons.fill>
            </div>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editCourse', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Mata Kuliah Baru?',
                            text: 'Pastikan Data Mata Kuliah Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.edit()
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', result.original.message, result.original.status)
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Mata Kuliah Gagal Diubah :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
