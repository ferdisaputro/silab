<div>
    <x-text.page-title class="mb-5">Ubah Minggu Akademik</x-text.page-title>
    <form x-data="editAcademicWeek()" x-on:submit.prevent='submitHandler' class="space-y-4">
        <x-forms.select wire:model.live='academic_year' name="academic_year" label="Pilih Tahun Ajaran" disabled>
            @foreach ($academic_years as $year)
                <option value="{{ $year->id }}">{{ $year->start_year }}/{{ $year->end_year }} - {{ $year->is_even? "genap" : "ganjil" }}</option>
            @endforeach
        </x-forms.select>
        <x-forms.input type="number" wire:model.live.debounce='week_number' name="week_number" label="Minggu Ke" disabled />
        <div class="flex gap-3 relative" date-rangepicker>
            <div class="flex-1">
                <div class="relative">
                    <input
                        datepicker-format="dd/mm/yyyy"
                        value="{{ date('d/m/Y', strtotime($start_date)) }}"
                        wire:model.live.debounce='start_date'
                        wire:blur="set('start_date', $el.value)"
                        class="h-12 block px-4 pb-2.5 pt-4 w-full text-sm bg-transparent disabled:bg-primaryGrey rounded-lg border border-gray-200 appearance-none dark:border-gray-600 dark:focus:border-primaryLightTeal focus:outline-none focus:ring-1 focus:ring-primaryTeal focus:border-primaryTeal peer @error('start_date') bg-red-50 border-red-500 text-red-900 placeholder-red-600 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror">
                    <label for="start_date" class="absolute text-sm duration-300 transform -translate-y-4 scale-75 left-2 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-primaryTeal capitalize peer-disabled:bg-transparent peer-focus:dark:text-primaryLightTeal peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 @error('start_date') text-red-700 dark:text-red-500 @enderror">Tanggal Mulai</label>
                    <i class="absolute -translate-y-1/2 fa-solid fa-calendar-days top-1/2 right-4"></i>
                </div>
                <div>
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="grid place-content-center">
                to
            </div>
            <div class="flex-1">
                <div class="relative">
                    <input
                        datepicker-format="dd/mm/yyyy"
                        wire:model.live.debounce='end_date'
                        wire:blur="set('end_date', $el.value)"
                        class="h-12 block px-4 pb-2.5 pt-4 w-full text-sm bg-transparent disabled:bg-primaryGrey rounded-lg border border-gray-200 appearance-none dark:border-gray-600 dark:focus:border-primaryLightTeal focus:outline-none focus:ring-1 focus:ring-primaryTeal focus:border-primaryTeal peer @error('end_date') bg-red-50 border-red-500 text-red-900 placeholder-red-600 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror">
                    <label for="end_date" class="absolute text-sm duration-300 transform -translate-y-4 scale-75 left-2 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-primaryTeal capitalize peer-disabled:bg-transparent peer-focus:dark:text-primaryLightTeal peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 @error('end_date') text-red-700 dark:text-red-500 @enderror">Tanggal Selesai</label>
                    <i class="absolute -translate-y-1/2 fa-solid fa-calendar-days top-1/2 right-4"></i>
                </div>
                <div>
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- <x-forms.input
                wire:model='start_date'
                wire:blur="set('start_date', $el.value)"
                name="start_date"
                label="Minggu Mulai"
                class="flex-1">
                <i class="fa-solid fa-calendar-days fa-sm absolute top-1/2 right-4 -translate-y-1/2"></i>
            </x-forms.input>
            <span class="absolute left-1/2 top-3 -translate-x-1/2">
                to
            </span>
            <x-forms.input
                wire:model='end_date'
                wire:blur="set('end_date', $el.value)"
                name="end_date"
                label="Minggu Selesai"
                class="flex-1">
                <i class="fa-solid fa-calendar-days fa-sm absolute top-1/2 right-4 -translate-y-1/2"></i>
            </x-forms.input> --}}
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
