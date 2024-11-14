<div>
    <x-text.page-title class="mb-5">Tambah Minggu Akademik {{ $id }}</x-text.page-title>
{{-- x-data="tambahPegawai" x-on:submit.prevent="tambah" --}}
    <form wire:submit='submitHandle' class="space-y-4">
    <form action="">
        <x-forms.select name="academic_year" label="Pilih Tahun Ajaran">
            <option value="2021/2022">2021/2022</option>
            <option value="2022/2023">2022/2023</option>
            <option value="2023/2024">2023/2024</option>
            <option value="2024/2025">2024/2025</option>
        </x-forms.select>
        <x-forms.input name="week_of" label="Minggu Ke" />
        <div class="flex gap-9 relative" date-rangepicker>
            <x-forms.input name="datepicker-range-start" label="Minggu Mulai" class="flex-1">
                <i class="fa-solid fa-calendar-days fa-sm absolute top-1/2 right-4 -translate-y-1/2"></i>
            </x-forms.input>
            <span class="absolute left-1/2 top-3 -translate-x-1/2">
                to
            </span>
            <x-forms.input name="datepicker-range-end" label="Minggu Selesai" class="flex-1">
                <i class="fa-solid fa-calendar-days fa-sm absolute top-1/2 right-4 -translate-y-1/2"></i>
            </x-forms.input>
        </div>
        <x-forms.input name="description" label="Keterangan" />

        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Tambah</x-buttons.outline>
        </div>
    </form>
</div>
