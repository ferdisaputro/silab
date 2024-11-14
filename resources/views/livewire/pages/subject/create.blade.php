<div>
    <x-text.page-title class="mb-5">
        Tambah Tahun Ajaran
    </x-text.page-title>

    <form action="" wire:submit>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <x-forms.input name="kode_matkul" placeholder="TIF001" label="Kode Mata Kuliah" />
        <x-forms.input name="nama_matkul" label="Nama Mata Kuliah" />

        <div class="flex flex-col items-center justify-center gap-4 sm:flex-row md:col-span-2">
            <x-buttons.outline color="red" class="w-full max-w-44 md:max-w-32">Reset</x-buttons.outline>
            <x-buttons.fill class="w-full md:max-w-52">Tambah</x-buttons.fill>
        </div>
    </div>
</div>
