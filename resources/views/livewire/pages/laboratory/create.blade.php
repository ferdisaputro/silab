<div>
    <form x-on:submit.prevent="submitHandler" x-data="createLaboratory()">
        <x-text.page-title class="mb-6">
            Tambah Data Laboratorium
        </x-text.page-title>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-forms.select-advanced model="department" name="department" label="Pilih Jurusan">
                @foreach ($departments as $department)
                    <option value="{{ $department->id {{-- this is staff id --}} }}">{{ $department->department }}</option>
                @endforeach
            </x-forms.select-advanced>
            <x-forms.input wire:model.live.debounce="code" name="code" label="Kode Laboratorium"></x-forms.input>
            <x-forms.input wire:model.live.debounce="name" name="name" label="Nama Laboratorium"></x-forms.input>
            <x-forms.input wire:model.live.debounce="acronym" name="acronym" label="Singkatan Laboratorium"></x-forms.input>
            <x-forms.input wire:model.live.debounce="color" name="color" label="Singkatan Laboratorium" type="color"></x-forms.input>
            <x-forms.select-advanced model="labLeader" name="labLeader" label="Pilih Ketua Lab">
                @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer->id {{-- this is staff id --}} }}">{{ $lecturer->user->name }}</option>
                @endforeach
            </x-forms.select-advanced>

            <div class="text-center md:col-span-2">
                <x-buttons.fill type="submit" class="w-full max-w-xs">
                    Tambah
                </x-buttons.fill>
            </div>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createLaboratory', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Buat laboratory Baru?',
                            text: 'Pastikan Data laboratory Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                const result = await $wire.create()
                                // console.log(result);

                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data laboratory Berhasil Dibuat', 'success')
                                    this.$el.closest('form').reset() // reset form
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data laboratory Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
