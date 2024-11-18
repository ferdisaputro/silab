<form class="space-y-10">
    <div class="flex items-center justify-between">
        <x-text.page-title>
            Konfirmasi Berita Acara Kerusakan/Kehilangan {{ $id }}
        </x-text.page-title>
    </div>

    <div>
        <x-alerts.outline class="mb-5" color="purple" message="Saya yang bertanda tangan dibawah ini: " />
        <div class="px-5 space-y-5">
            <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row">
                <x-forms.input class="flex-1 md:min-w-[20rem]" name="nim" label="NIM" />
                <x-forms.input class="flex-1 md:min-w-[20rem]" name="nama" label="Nama" />
                <x-forms.input class="flex-1 md:min-w-[20rem]" name="golongan_kelompok" label="Golongan/Kelompok" />
                <x-forms.input class="flex-1 md:min-w-[20rem]" name="tanggal_penggantian" label="Tanggal Kesanggupan Mengganti" type="datepicker" />
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <x-alerts.outline class="mb-5" color="green" message="Barang yang rusak sebagai berikut: " />
        <div class="px-5 space-y-4">
            @foreach ($items as $index => $item)
                <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                    <x-forms.select class="flex-1 min-w-24" wire:model='items.{{ $index }}.bahan' name="items.{{ $index }}.bahan" label="Pilih Barang">
                        <option value="key1">test1</option>
                        <option value="key2">test2</option>
                        <option value="key3">test3</option>
                        <option value="key4">test4</option>
                    </x-forms.select>

                    <x-forms.input class="flex-1 max-w-52" wire:model='items.{{ $index }}.keterangan' name="items.{{ $index }}.keterangan" label="Keterangan" type="number" />

                    <div class="flex justify-end gap-2">
                        <x-buttons.outline title="Konfirmasi Pengembalian" wire:click='removeItem({{ $index }})' type="blue">
                            Konfirmasi
                        </x-buttons.outline>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="text-center">
        <x-buttons.fill class="w-full max-w-xs">Konfirmasi Berita Acara</x-buttons.fill>
    </div>
</form>
