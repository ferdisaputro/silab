<div>
    <x-text.page-title class="mb-5">
        Tambah Mata Kuliah
    </x-text.page-title>

    <form x-on:submit.prevent="submitHandler" x-data="createCourse()">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-forms.input wire:model.live.debounce='code' name="code" placeholder="TIF001" label="Kode Mata Kuliah" />
            <x-forms.input wire:model.live.debounce='course' name="course" label="Nama Mata Kuliah" />

            <div class="flex flex-col items-center justify-center gap-4 sm:flex-row md:col-span-2">
                <x-buttons.outline wire:click='resetForm()' color="red" class="w-full max-w-44 md:max-w-32">Reset</x-buttons.outline>
                <x-buttons.fill type="submit" class="w-full md:max-w-52">Tambah</x-buttons.fill>
            </div>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createCourse', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Buat Mata Kuliah Baru?',
                            text: 'Pastikan Data Mata Kuliah Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Mata Kuliah Berhasil Dibuat', 'success')
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Mata Kuliah Gagal Dibuat :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
