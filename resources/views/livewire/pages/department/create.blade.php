<div>
    <x-text.page-title class="mb-5">Tambah Jurusan</x-text.page-title>
{{-- x-data="tambahPegawai" x-on:submit.prevent="tambah" --}}
    <form wire:submit='submitHandle' class="space-y-4">
    <form action="">
        <x-forms.input name="kode_jurusan" label="Kode Jurusan" />
        <x-forms.input name="nama_jurusan" label="Nama Jurusan" />
        <x-forms.select name="ketua_jurusan" label="Pilih Ketua Jurusan" :options="['key1' => 'test1', 'key2' => 'test2', 'key3' => 'test3', 'key3' => 'test4']" />

        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Tambah</x-buttons.outline>
        </div>
    </form>
</div>
