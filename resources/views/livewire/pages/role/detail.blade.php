<div>
    <x-text.page-title class="mb-3">Detail Permission Role</x-text.page-title>
    <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 md:grid-cols-3" wire:loading.remove>
        {{-- @dump($this->role->permissions?? null) --}}
        @if ($this->role && $this->role->permissions->count() > 0)
            @foreach ($this->role->permissions as $permission)
                <div class="px-3 py-2 border border-gray-200 rounded-lg dark:border-gray-700">
                    {{ $permission->name }}
                </div>
            @endforeach
        @else
            <div class="text-center col-span-full">
                Tidak ada data ditemukan
            </div>
        @endif
    </div>

    <div class="text-center">
        <span class="font-semibold" wire:loading>Loading...</span>
    </div>
</div>
