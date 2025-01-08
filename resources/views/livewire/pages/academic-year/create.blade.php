<div>
    <x-text.page-title class="mb-5">
        Tambah Tahun Ajaran
    </x-text.page-title>

    <form x-on:submit.prevent="submitHandler" x-data="createAcademicYear()">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-forms.input wire:model.live.debounce='startYear' type="number" name="startYear" label="Awal Tahun Ajaran(2023)" />
            <x-forms.input wire:model.live.debounce='endYear' type="number" name="endYear" label="Akhir Tahun Ajaran(2024)" />
            <x-forms.select wire:model.live='isEven' name="semester" label="Semester">
                <option value="0">Ganjil</option>
                <option value="1">Genap</option>
            </x-forms.select>

            <div class="flex flex-col sm:flex-row justify-center items-center md:col-span-2 gap-4">
                <x-buttons.fill type="submit" class="w-full md:max-w-52">Tambah</x-buttons.fill>
            </div>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createAcademicYear', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Buat Tahun Ajaran Baru?',
                            text: 'Pastikan Data Tahun Ajaran Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Tahun Ajaran Berhasil Didibuat', 'success')
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Tahun Ajaran Gagal Dibuat :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce