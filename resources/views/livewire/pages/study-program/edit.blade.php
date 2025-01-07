<div>
    <x-text.page-title class="mb-5 flex items-center gap-4">Ubah Program Studi</x-text.page-title> 
{{-- x-data="ubahPegawai" x-on:submit.prevent="ubah" --}}
    <form x-data="editStudyProgram()" x-on:submit.prevent='submitHandler' class="space-y-4">
        <x-forms.input wire:model.live.debounce="editCode" name="editCode" label="Kode Program Study" value="{{ $code?? '' }}" />
        <x-forms.input wire:model.live.debounce="editStudyProgram" name="editStudyProgram" label="Nama Program Study" value="{{ $studyProgram?? '' }}" />

        <x-forms.select-advanced model="editDepartment" name="department" label="Pilih Department" wire:key='{{ now() }}'>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ $department->id == $editDepartment ? 'selected' : '' }}>{{ $department->department }}</option>
            @endforeach
        </x-forms.select-advanced>
        <x-forms.select-advanced model="editHeadOfStudyProgram" name="editHeadOfStudyProgram" label="Pilih Ketua Program Study" wire:key='{{ now() }}'>
            @foreach ($lecturers as $lecturer)
                <option value="{{ $lecturer->id }}" {{ $lecturer->id == $editHeadOfStudyProgram ? 'selected' : '' }}>{{ $lecturer->user->name }}</option>
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
            Alpine.data('editStudyProgram', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Data Program Study?',
                            text: 'Pastikan Data Program Study Sudah Benar',
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
                                    swal.fire('Gagal', 'Data Program Study Gagal Diubah :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
