<div>
    <x-text.page-title class="mb-5">Ubah Jurusan</x-text.page-title>
{{-- x-data="ubahPegawai" x-on:submit.prevent="ubah" --}}
    <form wire:submit='submitHandle' class="space-y-4">
    <form action="">
        <x-forms.input wire:model.live.debounce="kode" name="kode" label="Kode Program Studi" value="{{ $kode?? '' }}" />
        <x-forms.input wire:model.live.debounce="nama" name="nama" label="Nama Program Studi" value="{{ $nama?? '' }}" />
        <x-forms.select name="ketua_program_studi" label="Pilih Ketua Program Studi">
            <option {{ $kaprodi == "kaprodi-1"? "selected" : '' }} value="kaprodi-1">kaprodi-1-value</option>
            <option {{ $kaprodi == "kaprodi-2"? "selected" : '' }} value="kaprodi-2">kaprodi-2-value</option>
            <option {{ $kaprodi == "kaprodi-3"? "selected" : '' }} value="kaprodi-3">kaprodi-3-value</option>
            <option {{ $kaprodi == "kaprodi-4"? "selected" : '' }} value="kaprodi-4">kaprodi-4-value</option>
        </x-forms.select>

        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Ubah</x-buttons.outline>
        </div>
    </form>
</div>
