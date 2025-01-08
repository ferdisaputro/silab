<div>
    <x-text.page-title class="mb-5">
        Ubah Tahun Ajaran
    </x-text.page-title>

    <form x-on:submit.prevent="submitHandler" x-data="editAcademicYear">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-forms.input wire:model.live.debounce='editStartYear' type="number" name="startYear" label="Awal Tahun Ajaran(2023)" />
            <x-forms.input wire:model.live.debounce='editEndYear' type="number" name="endYear" label="Akhir Tahun Ajaran(2024)" />
            <x-forms.select wire:model.live='editIsEven' name="semester" label="Semester">
                <option {{ $editIsEven == 0? "selected" : '' }} value="0">Ganjil</option>
                <option {{ $editIsEven == 1? "selected" : '' }} value="1">Genap</option>
            </x-forms.select>

            <div class="flex flex-col sm:flex-row justify-center items-center md:col-span-2 gap-4">
                <x-buttons.fill type="submit" class="w-full md:max-w-52">Ubah</x-buttons.fill>
            </div>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editAcademicYear', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Data Academic Year',
                            text: 'Pastikan Data Academic Year Sudah Benar',
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
                                    swal.fire('Gagal', 'Data Academic Year Gagal Diubah :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
