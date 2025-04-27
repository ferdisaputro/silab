<form x-on:submit.prevent="submitHandler" x-data="lossDamageEdit()" class="space-y-10">
    <div class="flex items-center justify-between">
        <x-text.page-title>
            Ubah Berita Acara Kerusakan/Kehilangan
        </x-text.page-title>
    </div>

    <div>
        <x-alerts.outline class="mb-5" color="purple" message="Saya yang bertanda tangan dibawah ini: " />
        <div class="px-5 space-y-5">
            <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row">
                <x-forms.input wire:model="nim" class="flex-1 md:min-w-[20rem]" name="nim" label="NIM" />
                <x-forms.input wire:model="name" class="flex-1 md:min-w-[20rem]" name="name" label="Nama" />
                <x-forms.input wire:model="group_class" class="flex-1 md:min-w-[20rem]" name="group_class" label="Golongan/Kelompok" />

                <div class="flex justify-center flex-col items-center md:flex-row">
                    <x-forms.input
                        wire:model="borrowingDate"
                        class="flex-1 md:min-w-[20rem]"
                        name="borrowingDate"
                        label="Tanggal Kesiapan Mengganti"
                        type="date" {{-- type date agar muncul datepicker --}}
                    />
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <x-alerts.outline class="mb-5" color="green" message="Barang yang rusak sebagai berikut: " />
        <div class="px-5 space-y-4">
            @if ($this->items)
            @foreach ($this->items as $index => $item)
            <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                @if (!empty($item['is_new']))
                    <x-forms.select
                        wire:model="items.{{ $index }}.bahan"
                        name="items.{{ $index }}.bahan"
                        class="flex-1 min-w-24"
                        label="Pilih Barang"
                    >
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($this->labItems as $labItem)
                            <option value="{{ $labItem->id?? ''}}">{{ $labItem->item->item_name }}</option>
                        @endforeach
                    </x-forms.select>
                @else
                    <x-forms.input disabled value="{{ $item['item_name'] ?? '-' }}" class="flex-1 min-w-24" label="Barang" />
                @endif

                <x-forms.input
                    class="flex-1 max-w-52"
                    wire:model="items.{{ $index }}.jumlah"
                    name="items.{{ $index }}.jumlah"
                    label="Jumlah"
                    type="number"
                />

                <div class="flex justify-end gap-2">
                    @if (count($items) > 1)
                        <x-buttons.outline wire:click='removeItem({{ $index }})' color="yellow">
                            <i class="fa-solid fa-trash-can"></i>
                        </x-buttons.outline>
                    @endif
                    @if ($loop->iteration == 1)
                        <x-buttons.outline wire:click='addItem' color="blue">
                            <i class="fa-solid fa-plus"></i>
                        </x-buttons.outline>
                    @endif
                </div>
            </div>
        @endforeach

            @endif
        </div>
    </div>

    <div class="text-center">
        <x-buttons.fill type="submit" class="w-full max-w-xs">Ubah Berita Acara</x-buttons.fill>
    </div>
</form>
@pushOnce('scripts')
    @script
        <script>
            Alpine.data('lossDamageEdit', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Peminjaman',
                            text: 'Pastikan Data Peminjaman Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                const result = await $wire.edit()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Peminjaman Berhasil Diubah', 'success')
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data laboratory Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
