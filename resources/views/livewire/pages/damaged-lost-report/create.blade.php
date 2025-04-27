<form class="space-y-10" x-on:submit.prevent="submitHandler" x-data="createLossDamage()">
    <div class="flex items-center justify-between">
        <x-text.page-title>
            Buat Berita Acara Kerusakan/Kehilangan {{ $selectedLab }}

        </x-text.page-title>
    </div>

    <div>
        {{-- @dump($this->selectedLab , $this->LabItems) --}}
        {{-- @dump($this->$borrowingDate) --}}
        <x-alerts.outline class="mb-5" color="purple" message="Saya yang bertanda tangan dibawah ini: " />

        <div class="px-5 space-y-5">

            {{-- Bagian Identitas --}}
            <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row">
                <x-forms.input
                    class="flex-1 md:min-w-[20rem]"
                    name="nim"
                    label="NIM"
                    wire:model.live.debounce="nim"/>

                <x-forms.input
                    class="flex-1 md:min-w-[20rem]"
                    name="name"
                    label="Nama"
                    wire:model.live.debounce="name"/>

                <x-forms.input
                    class="flex-1 md:min-w-[20rem]"
                    name="group"
                    label="Golongan/Kelompok"
                    wire:model.live.debounce="group"/>
            </div>

            {{-- Bagian Tanggal --}}
            <div class="flex justify-center flex-col items-center md:flex-row">
                <x-forms.input
                    wire:model.live.debounce="borrowingDate"
                    value="{{ date('d/m/Y', strtotime(now())) }}"
                    wire:init="borrowingDate = '{{ date('d/m/Y', strtotime(now())) }}'"
                    class="w-full md:max-w-md"
                    name="borrowingDate"
                    label="Tanggal Kesiapan Mengganti"
                    datepicker />
            </div>

        </div>
    </div>


    <div class="space-y-5">
        <x-alerts.outline class="mb-5" color="green" message="Barang yang rusak sebagai berikut: " />
        <div class="px-5 space-y-4">
            @foreach ($items as $index => $item)
                <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                    <x-forms.select
                        wire:key="{{ $selectedLab }}"
                        class="flex-1 min-w-24"
                        wire:model='items.{{ $index }}.bahan'
                        name="items.{{ $index }}.bahan"
                        label="Pilih Barang">
                            @foreach ($this->labItems as $labitem)
                                {{-- <option value="{{ $labitem->id }}" {{ $labitem->id == $item[$index]['item']? "selected" : ""}}> --}}
                                <option value="{{ $labitem->id }}" {{ $labitem->id }}>
                                    {{ $labitem->item->item_name }}
                                </option>
                            @endforeach
                    </x-forms.select>

                    <x-forms.input class="flex-1 max-w-52" wire:model='items.{{ $index }}.jumlah' name="items.{{ $index }}.jumlah" label="Jumlah Hilang/Rusak" type="number" />

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
        </div>
    </div>

    <div class="text-center">
        <x-buttons.fill type="submit" class="w-full max-w-xs">Buat Berita Acara</x-buttons.fill>
    </div>
</form>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createLossDamage', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Buat Kesiapan Bahan',
                            text: 'Apakah Data Kesiapan Bahan Praktikum Sudah Benar?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                const result = await $wire.create()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Peminjaman Berhasil Dibuat', 'success').then(() => {
                                        // $wire.redirectToIndex()
                                        $wire.$parent.$refresh()
                                    })
                                } else
                                    swal.fire('Gagal', 'Data Kesiapan Bahan Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce

