<div>
    <x-text.page-title class="mb-5">Tambah Semester</x-text.page-title>
{{-- x-data="tambahPegawai" x-on:submit.prevent="tambah" --}}
    <form x-on:submit.prevent='submitHandler' x-data="createSemester()" class="space-y-4">
        <x-forms.select wire:model.live='academic_year' name="academic_year" label="Pilih Tahun Ajaran">
            @foreach ($academic_years as $year)
                <option value="{{ $year->id }}">{{ $year->start_year }}/{{ $year->end_year }} - {{ $year->is_even? "genap" : "ganjil" }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.select wire:model.live='semester' name="semester" label="Semester">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </x-forms.select>

        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Tambah</x-buttons.outline>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createSemester', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Buat Semester Baru?',
                            text: 'Pastikan Data Semester Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create()
                                console.log(result);
                                
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