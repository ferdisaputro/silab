<div>
    <x-text.page-title class="mb-5">Ubah Bahan Laboratorium {{ $id }}</x-text.page-title>
    <form wire:submit='submitHandle' class="space-y-4">
    <form action="">
        <div class="flex gap-4">
            <x-forms.select class="flex-1" name="bahan" label="Pilih Bahan">
                <option value="key1">test1</option>
                <option value="key2">test2</option>
                <option value="key3">test3</option>
                <option value="key4">test4</option>
            </x-forms.select>
            <x-forms.input class="w-full max-w-40" name="quantity" label="Quantity" />
        </div>

        <div class="text-center">
            <x-buttons.fill type="submit" class="w-full max-w-xs">Ubah</x-buttons.fill>
        </div>
    </form>
</div>
