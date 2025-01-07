<div>
    <x-text.page-title class="mb-5">Tambah Jurusan</x-text.page-title>
{{-- x-data="tambahPegawai" x-on:submit.prevent="tambah" --}}
    <form x-data="createDepartment" x-on:submit.prevent='submitHandler' class="space-y-4">
        <x-forms.input wire:model.live.debounce='code' name="code" label="Kode Jurusan" />
        <x-forms.input wire:model.live.debounce='department' name="department" label="Nama Jurusan" />
        <x-forms.select-advanced model="headOfDepartment" name="headOfDepartment" label="Pilih Ketua Jurusan">
            @foreach ($lecturers as $lecturer)
                <option value="{{ $lecturer->user->id }}">{{ $lecturer->user->name }}</option>
            @endforeach
        </x-forms.select-advanced>
        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Tambah</x-buttons.outline>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createDepartment', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Tambah Jurusan Baru?',
                            text: 'Pastikan Data Jurusan Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', result.original.message, 'success')
                                    this.$el.closest('form').reset() // reset form
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
