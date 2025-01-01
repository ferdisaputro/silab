<x-container>
    <div class="p-5 bg-white shadow-lg rounded-xl">
        <form action="" x-data="createRole" x-on:submit.prevent="submitHandler">
            <x-text.page-title class="mb-4">
                Tambah Role Baru
            </x-text.page-title>

            <div class="flex flex-col gap-3 mb-8 md:flex-row">
                <div class="relative flex-[1.2]">
                    <x-forms.input wire:model.live.debounce='role' name="role" label="Nama Role" />
                    {{-- <div class="absolute top-0 bottom-0 right-0 flex items-center justify-end pr-3 w-28 opacity-60">
                        <span class="font-semibold text-right"><span class="text-xl" x-text="selectCounter"></span> Selected</span>
                    </div> --}}
                </div>
                <x-buttons.fill class="flex-[0.8] md:max-w-xs" type="submit">Tambah Role</x-buttons.fill>
            </div>

            <div class="space-y-4 mt-7">
                <hr>
                <h5 class="text-lg font-semibold text-center">Permission Lists</h5>
                @error('selectedPermissions')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
                @enderror
                <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 md:grid-cols-3">
                    @foreach ($permissions as $permission)
                        {{-- <div class="flex items-center border border-gray-200 rounded-lg ps-3 dark:border-gray-700 peer-checked:border-primaryTeal" wire:key='tr-{{ $loop->iteration }}'>
                            <input id="{{ $permission->name }}" type="checkbox" value="{{ $permission->name }}" name="permission" class="w-4 h-4 bg-gray-100 border-gray-300 rounded peer text-primaryTeal focus:ring-primaryLightTeal dark:focus:ring-primaryTealtext-primaryTeal dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="{{ $permission->name }}" class="w-full py-3 text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">{{ $permission->name }}</label>
                        </div> --}}
                        <div>
                            <input wire:model='selectedPermissions' type="checkbox" id="{{ $permission->name }}" value="{{ $permission->name }}" name="permission" class="hidden peer">
                            <label for="{{ $permission->name }}" class="inline-flex items-center w-full p-5 bg-white border-2 border-gray-200 rounded-lg cursor-pointer text-primaryDark dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-primaryTeal peer-checked:bg-primaryTeal/10 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="w-full text-sm">{{ $permission->name }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </form>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createRole', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Tambah Role Baru?',
                            text: 'Pastikan Data Role Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create()
                                if (result.original.status == 'success') {
                                    swal.fire({
                                        title: 'Berhasil', 
                                        text: 'Data Role Berhasil Ditambahkan. Kembali ke halaman utama?', 
                                        icon: 'success',
                                        showCancelButton: true,
                                        confirmButtonText: 'Kembali',
                                        cancelButtonText: 'Stay',
                                    }).then(returnConfirmation => {
                                        if (returnConfirmation.isConfirmed) {
                                            Livewire.navigate(`{{ route("role") }}`)
                                        }
                                    })
                                    
                                    this.$el.closest('form').reset() // reset form
                                } else
                                    swal.fire('Gagal', 'Data Role Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
