<div>
    <x-text.page-title class="mb-5">Tambah Program Studi</x-text.page-title>
{{-- x-data="tambahPegawai" x-on:submit.prevent="tambah" --}}
    <form wire:submit='submitHandle' class="space-y-4">
    <form action="">
        <x-forms.input name="kode_program_studi" label="Kode Program Studi" />
        <x-forms.input name="nama_program_studi" label="Nama Program Studi" />
        <x-forms.select name="ketua_program_studi" label="Pilih Ketua Program Studi">
            <option value="kaprodi-1">kaprodi-1-value</option>
            <option value="kaprodi-2">kaprodi-2-value</option>
            <option value="kaprodi-3">kaprodi-3-value</option>
            <option value="kaprodi-4">kaprodi-4-value</option>
        </x-forms.select>
        
        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Tambah</x-buttons.outline>
        </div>
    </form>
</div>
