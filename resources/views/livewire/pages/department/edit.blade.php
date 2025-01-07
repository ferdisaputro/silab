<div>
    <x-text.page-title class="mb-5">Ubah Jurusan</x-text.page-title>
{{-- x-data="ubahPegawai" x-on:submit.prevent="ubah" --}}
    <form x-data="editDepartment()" x-on:submit.prevent='submitHandler' class="space-y-4">
        <x-forms.input wire:model.live.debounce="editCode" name="editCode" label="Kode Jurusan" value="{{ $code?? '' }}" />
        <x-forms.input wire:model.live.debounce="editDepartment" name="editDepartment" label="Nama Jurusan" value="{{ $department?? '' }}" />

        <x-forms.select-advanced model="editHeadOfDepartment" name="editHeadOfDepartment" label="Pilih Ketua Jurusan" wire:key='{{ now() }}'>
            @foreach ($lecturers as $lecturer)
                <option value="{{ $lecturer->user->id }}" {{ $lecturer->user->id == $editHeadOfDepartment ? 'selected' : '' }}>{{ $lecturer->user->name }}</option>
            @endforeach
        </x-forms.select-advanced>

        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Ubah</x-buttons.outline>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editDepartment', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Data Jurusan?',
                            text: 'Pastikan Data Jurusan Sudah Benar',
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
                                    swal.fire('Gagal', 'Data Jurusan Gagal Diubah :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
