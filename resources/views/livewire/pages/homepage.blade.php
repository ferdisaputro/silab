<x-container>
    <div class="overflow-hidden space-y-7 dark:bg-red-800 sm:rounded-lg">
        <div class="grid gap-4 lg:grid-cols-3">
            @foreach ($itemTypes as $itemType)
                <x-card
                    gradient="from-gray-400/45 to-gray-400"
                    color="text-primaryDark"
                    jumlah="{{ $itemType->items_count }}"
                    keterangan="Item"
                    kuantitas="{{ $itemType->items->sum(fn($item) => $item->labItems->sum('stock')) }}"
                    teks="{{ $itemType->item_type }}"
                    ikon="fa-toolbox"
                ></x-card>
            @endforeach
        </div>

        <div>
            <x-text.page-title class="mb-3">Peminjaman Alat Praktikum</x-text.page-title>
            <div class="grid gap-4 lg:grid-cols-3">
                @foreach ($laboratories as $laboratory)
                    <x-card
                        gradient="from-primaryTeal/45 to-primaryTeal"
                        color="text-primaryDark"
                        jumlah="{{ $laboratory->equipment_loans_count }}"
                        keterangan="Bulan ini"
                        {{-- kuantitas="1024" --}}
                        teks="{{ $laboratory->acronym? $laboratory->acronym.' - '.$laboratory->name : $laboratory->name }}"
                        {{-- ikon="fa-toolbox" --}}
                    ></x-card>
                @endforeach
            </div>
        </div>
        {{-- <div class="grid gap-4 lg:grid-cols-3">
            <x-card
                gradient="from-red-500/45 to-red-500"
                color="text-primaryDark"
                jumlah="30"
                kuantitas="1024"
                teks="ALat"
                ikon="fa-toolbox"
                keterangan="bulan ini"
            ></x-card>
            <x-card
                gradient="from-red-500/45 to-red-500"
                color="text-primaryDark"
                jumlah="30"
                kuantitas="1024"
                teks="ALat"
                ikon="fa-toolbox"
                keterangan="bulan ini"
            ></x-card>
            <x-card
                gradient="from-red-500/45 to-red-500"
                color="text-primaryDark"
                jumlah="30"
                kuantitas="1024"
                teks="ALat"
                ikon="fa-toolbox"
                keterangan="bulan ini"
            ></x-card>
            <x-card
                gradient="from-red-500/45 to-red-500"
                color="text-primaryDark"
                jumlah="30"
                kuantitas="1024"
                teks="ALat"
                ikon="fa-toolbox"
                keterangan="bulan ini"
            ></x-card>
        </div>
        <div class="grid gap-4 lg:grid-cols-3">
            <x-card
                gradient="from-green-500/45 to-green-500"
                color="text-primaryDark"
                jumlah="30"
                kuantitas="1024"
                teks="ALat"
                ikon="fa-toolbox"
                keterangan="bulan ini"
            ></x-card>
            <x-card
                gradient="from-green-500/45 to-green-500"
                color="text-primaryDark"
                jumlah="30"
                kuantitas="1024"
                teks="ALat"
                ikon="fa-toolbox"
                keterangan="bulan ini"
            ></x-card>
            <x-card
                gradient="from-green-500/45 to-green-500"
                color="text-primaryDark"
                jumlah="30"
                kuantitas="1024"
                teks="ALat"
                ikon="fa-toolbox"
                keterangan="bulan ini"
            ></x-card>
            <x-card
                gradient="from-green-500/45 to-green-500"
                color="text-primaryDark"
                jumlah="30"
                kuantitas="1024"
                teks="ALat"
                ikon="fa-toolbox"
                keterangan="bulan ini"
            ></x-card>
        </div> --}}
    </div>
</x-container>
