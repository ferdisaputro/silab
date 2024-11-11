<div>
    <x-text.page-title class="mb-5">Tambah Jurusan</x-text.page-title>
{{-- x-data="tambahPegawai" x-on:submit.prevent="tambah" --}}
    <form wire:submit='submitHandle' class="space-y-4">
    <form action="">
        <x-forms.input name="kode_jurusan" label="Kode Jurusan" />
        <x-forms.input name="nama_jurusan" label="Nama Jurusan" />
        <x-forms.select name="ketua_jurusan" label="Pilih Ketua Jurusan">
            <option value="key1">test1</option>
            <option value="key2">test2</option>
            <option value="key3">test3</option>
            <option value="key4">test4</option>
        </x-forms.select>

        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Tambah</x-buttons.outline>
        </div>
    </form>
</div>
