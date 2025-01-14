<div>
    <x-text.page-title class="mb-5">Ubah Semester</x-text.page-title>
{{-- x-data="tambahPegawai" x-on:submit.prevent="tambah" --}}
    <form x-on:submit.prevent='submitHandler' x-data="editSemester()" class="space-y-4">
        <x-forms.select wire:model.live='academic_year' name="academic_year" label="Pilih Tahun Ajaran">
            @foreach ($academic_years as $year)
                <option value="{{ $year->id }}">{{ $year->start_year }}/{{ $year->end_year }} - {{ $year->is_even? "genap" : "ganjil" }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.input wire:model.live='semester' name="semester" label="Semester" />

        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Ubah</x-buttons.outline>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editSemester', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Data Semester?',
                            text: 'Pastikan Data Semester Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.edit()
                                console.log(result);

                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', result.original.message, result.original.status)
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
