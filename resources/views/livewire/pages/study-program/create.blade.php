<div>
    <x-text.page-title class="mb-5 flex items-center gap-4">Tambah Program Studi</x-text.page-title> 
    <form x-data="createStudyProgram" x-on:submit.prevent='submitHandler' class="space-y-4">
        <x-forms.input wire:model.live.debounce='code' name="code" label="Kode Program Studi" />
        <x-forms.input wire:model.live.debounce='studyProgram' name="studyProgram" label="Nama Program Studi" />
        <x-forms.select-advanced model="department" name="department" label="Pilih Jurusan">
            @foreach ($departments as $department)
                <option value="{{ $department->id {{-- this is staff id --}} }}">{{ $department->code." | ".$department->department }}</option>
            @endforeach
        </x-forms.select-advanced>
        <x-forms.select-advanced model="headOfStudyProgram" name="headOfStudyProgram" label="Pilih Ketua Program Studi">
            @foreach ($lecturers as $lecturer)
                <option value="{{ $lecturer->id {{-- this is staff id --}} }}">{{ $lecturer->user->name }}</option>
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
            Alpine.data('createStudyProgram', () => {
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
