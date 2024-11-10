<div>
    <x-text.page-title class="mb-5">Ubah Satuan</x-text.page-title>
    {{-- x-data="tambahPegawai" x-on:submit.prevent="tambah" --}}
    <form wire:submit='submitHandle' class="space-y-4">
        {{-- @dump($errors->all()) --}}
        <div class="relative">
            <x-forms.input
                wire:model.live.debounce="satuanData"
                name="satuanData"
                key="satuanData"
                label="Nama Satuan"
                value="{{ $satuanData['name']?? '' }}">
            </x-forms.input>
        </div>
        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Tambah Satuan</x-buttons.outline>
        </div>
    </form>
</div>
