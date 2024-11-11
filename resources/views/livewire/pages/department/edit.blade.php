<div>
    <x-text.page-title class="mb-5">Ubah Jurusan</x-text.page-title>
{{-- x-data="ubahPegawai" x-on:submit.prevent="ubah" --}}
    <form wire:submit='submitHandle' class="space-y-4">
    <form action="">
        <x-forms.input wire:model.live.debounce="kode" name="kode" label="Kode Jurusan" value="{{ $kode?? '' }}" />
        <x-forms.input wire:model.live.debounce="nama" name="nama" label="Nama Jurusan" value="{{ $nama?? '' }}" />
        <x-forms.select name="ketua_jurusan" label="Pilih Ketua Jurusan">
            <option {{ $kajur == "kajur-1"? "selected" : "" }} value="kajur-1">kajur-1-value</option>
            <option {{ $kajur == "kajur-2"? "selected" : "" }} value="kajur-2">kajur-2-value</option>
            <option {{ $kajur == "kajur-3"? "selected" : "" }} value="kajur-3">kajur-3-value</option>
            <option {{ $kajur == "kajur-4"? "selected" : "" }} value="kajur-4">kajur-4-value</option>
        </x-forms.select>

        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Ubah</x-buttons.outline>
        </div>
    </form>
</div>
