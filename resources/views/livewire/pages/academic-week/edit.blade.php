<div>
    <x-text.page-title class="mb-5">Ubah Minggu Akademik</x-text.page-title>
    <form x-data="editAcademicWeek()" x-on:submit.prevent='submitHandler' class="space-y-4">
        <x-forms.select wire:model.live='academic_year' name="academic_year" label="Pilih Tahun Ajaran" disabled>
            @foreach ($academic_years as $year)
                <option value="{{ $year->id }}">{{ $year->start_year }}/{{ $year->end_year }} - {{ $year->is_even? "genap" : "ganjil" }}</option>
            @endforeach
        </x-forms.select>
        <x-forms.input type="number" wire:model.live.debounce='week_number' name="week_number" label="Minggu Ke" disabled />
        <div class="flex gap-9 relative" date-rangepicker>
            <x-forms.input wire:model='start_date' wire:blur="set('start_date', $el.value)" name="start_date" label="Minggu Mulai" class="flex-1">
                <i class="fa-solid fa-calendar-days fa-sm absolute top-1/2 right-4 -translate-y-1/2"></i>
            </x-forms.input>
            <span class="absolute left-1/2 top-3 -translate-x-1/2">
                to
            </span>
            <x-forms.input wire:model='end_date' wire:blur="set('end_date', $el.value)" name="end_date" label="Minggu Selesai" class="flex-1">
                <i class="fa-solid fa-calendar-days fa-sm absolute top-1/2 right-4 -translate-y-1/2"></i>
            </x-forms.input>
        </div>
        <x-forms.input wire:model.live.debounce='description' name="description" label="keterangan" />

        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Ubah</x-buttons.outline>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editAcademicWeek', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Minggu Ajaran Baru?',
                            text: 'Pastikan Data Minggu Ajaran Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.update()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', result.original.message, 'success')
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