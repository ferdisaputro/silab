<div>
    <x-text.page-title class="mb-5">Ubah Jurusan</x-text.page-title>
{{-- x-data="ubahPegawai" x-on:submit.prevent="ubah" --}}
    <form wire:submit='submitHandle' class="space-y-4">
    <form action="">
        <x-forms.input wire:model.live.debounce="kode" name="kode" label="Kode Program Studi" value="{{ $kode?? '' }}" />
        <x-forms.input wire:model.live.debounce="nama" name="nama" label="Nama Program Studi" value="{{ $nama?? '' }}" />
        <x-forms.select name="ketua_program_studi" label="Pilih Ketua Program Studi" default="{{ $kaprodi?? '' }}" :options="['kaprodi-1' => 'kaprodi-1-value', 'kaprodi-2' => 'kaprodi-2-value', 'kaprodi-3' => 'kaprodi-3-value', 'kaprodi-3' => 'kaprodi-4-value']" />

        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Ubah</x-buttons.outline>
        </div>
    </form>
</div>
