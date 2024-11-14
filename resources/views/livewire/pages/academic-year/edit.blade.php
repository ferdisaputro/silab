<div>
    <x-text.page-title class="mb-5">
        Ubah Tahun Ajaran {{ $id }}
    </x-text.page-title>

    <form action="" wire:submit>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-forms.input name="tahun_ajaran" label="Tahun Ajaran(2021/2022)" />
        <x-forms.select name="semester" label="Semester">
            <option value="ganjil">Ganjil</option>
            <option value="genap">Genap</option>
        </x-forms.select>

        <div class="flex flex-col sm:flex-row justify-center items-center md:col-span-2 gap-4">
            <x-buttons.outline color="red" class="w-full max-w-44 md:max-w-32">Reset</x-buttons.outline>
            <x-buttons.fill class="w-full md:max-w-52">Ubah</x-buttons.fill>
        </div>
    </div>
</div>
