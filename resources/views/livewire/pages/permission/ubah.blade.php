<div>
    <x-text.page-title class="mb-5" wire:loading.remove>Tambah Permission {{ $id }}</x-text.page-title>
    <x-text.page-title class="mb-5" wire:loading>Loading...</x-text.page-title>
    {{-- x-data="tambahPegawai" x-on:submit.prevent="tambah" --}}
    <form wire:submit='submitHandle' class="space-y-4">
        <div class="relative">
            <x-forms.input
                wire:model.live.debounce="permission.name"
                name="permission.name"
                key="permission.name"
                label="Nama Permission" />
        </div>
        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Tambah Permission</x-buttons.outline>
        </div>
    </form>
</div>
