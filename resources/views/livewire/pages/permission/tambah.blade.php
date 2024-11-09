<div>
    <x-text.page-title class="mb-5">Tambah Permission</x-text.page-title>
    {{-- x-data="tambahPegawai" x-on:submit.prevent="tambah" --}}
    <form wire:submit='submitHandle' class="space-y-4">
        {{-- @dump($errors->all()) --}}
        @foreach ($permissions as $index => $permission)
            <div class="relative">
                <x-forms.input
                    wire:model.live.debounce="permissions.{{ $index }}.name"
                    name="permissions.{{ $index }}.name"
                    key="permissions.{{ $index }}.name"
                    label="Nama Permission">
                    @if (count($permissions) > 1)
                        <x-badges.fill wire:click='removePermission({{ $index }})' color='red' class="absolute px-3 top-2 right-2 bottom-2" title="Hapus">
                            <i class="fa-regular fa-trash-can"></i>
                        </x-badges.fill>
                    @endif
                </x-forms.input>
            </div>
        @endforeach
        <div wire:click='addPermission' class="relative cursor-pointer">
            <x-forms.input label="Nama Permission" disabled="true" />
            <x-badges.fill color='gray' class="absolute px-3 top-2 right-2 bottom-2" title="Hapus">
                <i class="fa-regular fa-trash-can"></i>
            </x-badges.fill>
            <span class="absolute top-0 bottom-0 left-0 right-0 grid place-items-center">
                <i class="fa-solid fa-plus fa-lg"></i>
            </span>
        </div>
        {{-- <div class="text-center">
            <x-badges.outline color="green" class="w-full max-w-[15rem] h-10">
                <i class="fa-solid fa-plus"></i>
            </x-badges.outline>
        </div> --}}
        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Tambah Permission</x-buttons.outline>
        </div>
    </form>
</div>
