<div>
    <form x-on:submit.prevent="submitHandler" x-data="editLaboratory()">
        <x-text.page-title class="mb-6">
            Ubah Data Laboratorium
        </x-text.page-title>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-forms.select-advanced model="editDepartment" name="department" label="Pilih Jurusan" wire:key='{{ now() }}'>
                @foreach ($departments as $department)
                    <option value="{{ $department->id {{-- this is staff id --}} }}" {{ $department->id == $editDepartment ? 'selected' : '' }}>{{ $department->department }}</option>
                @endforeach
            </x-forms.select-advanced>
            <x-forms.input wire:model.live.debounce="editCode" name="code" label="Kode Laboratorium"></x-forms.input>
            <x-forms.input wire:model.live.debounce="editName" name="name" label="Nama Laboratorium"></x-forms.input>
            <x-forms.input wire:model.live.debounce="editAcronym" name="acronym" label="Singkatan Laboratorium"></x-forms.input>
            <x-forms.input wire:model.live.debounce="editColor" name="color" label="Warna Laboratorium" type="color"></x-forms.input>
            <x-forms.select-advanced model="editLabLeader" name="labLeader" label="Pilih Ketua Lab" wire:key='{{ now() }}'>
                @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer->id {{-- this is staff id --}} }}" {{ $lecturer->id == $editLabLeader ? 'selected' : '' }}>{{ $lecturer->user->name }}</option>
                @endforeach
            </x-forms.select-advanced>

            <div class="col-span-2 text-center">
                <x-buttons.fill type="submit" class="w-full max-w-xs">
                    Ubah
                </x-buttons.fill>
            </div>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editLaboratory', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Data Laboratorium?',
                            text: 'Pastikan Data Laboratorium Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                const result = await $wire.edit()
                                console.log(result);

                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', result.original.message, 'success')
                                    $wire.$parent.$refresh()
                                }
                                else
                                    swal.fire('Gagal', 'Data Laboratorium Gagal Diubah :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
