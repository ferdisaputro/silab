<x-container>
    <form action="">
        <div class="p-5 space-y-6 bg-white rounded-xl">
            <x-text.page-title>
                Ubah Role Baru
            </x-text.page-title>

            <div class="flex flex-col gap-3 md:flex-row">
                <div class="relative flex-[1.2]">
                    <x-forms.input name="role_name" label="Nama Role" />
                    {{-- <div class="absolute top-0 bottom-0 right-0 flex items-center justify-end pr-3 w-28 opacity-60">
                        <span class="font-semibold text-right"><span class="text-xl" x-text="selectCounter"></span> Selected</span>
                    </div> --}}
                </div>
                <x-buttons.outline class="flex-[0.8] md:max-w-xs" type="submit">Ubah Role</x-buttons.outline>
            </div>

            <div>
                <div class="pt-3 mb-4">
                    <hr>
                    <h5 class="text-lg font-semibold text-center ms-4">Permission Lists</h5>
                </div>

                <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 md:grid-cols-3">
                    @foreach ($this->permissions as $permission)
                        <div class="flex items-center border border-gray-200 rounded-lg ps-3 dark:border-gray-700" wire:key='ur-{{ $loop->iteration }}'>
                            <input id="{{ $permission->name }}" type="checkbox" value="{{ $permission->name }}" name="permission" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primaryTeal focus:ring-primaryLightTeal dark:focus:ring-primaryTealtext-primaryTeal dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="{{ $permission->name }}" class="w-full py-3 text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
</x-container>
