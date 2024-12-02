<x-container>
    <form x-data="editRole" x-on:submit.prevent="submitHandler">
        <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
            <x-text.page-title>
                Ubah Role
            </x-text.page-title>

            <div class="flex flex-col gap-3 md:flex-row">
                <div class="relative flex-[1.2]">
                    <x-forms.input wire:model.live.debounce='role' name="role" label="Nama Role" />
                    {{-- <div class="absolute top-0 bottom-0 right-0 flex items-center justify-end pr-3 w-28 opacity-60">
                        <span class="font-semibold text-right"><span class="text-xl" x-text="selectCounter"></span> Selected</span>
                    </div> --}}
                </div>
                <x-buttons.fill class="flex-[0.8] md:max-w-xs" type="submit">Ubah Role</x-buttons.fill>
            </div>

            <div>
                <div class="pt-3 mb-4">
                    <hr>
                    <h5 class="text-lg font-semibold text-center ms-4">Permission Lists</h5>
                </div>

                <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 md:grid-cols-3">
                    @foreach ($permissions as $permission)
                        <div>
                            <input wire:model='selectedPermissions' type="checkbox" id="{{ $permission->name }}" value="{{ $permission->name }}" name="permission" class="hidden peer">
                            <label for="{{ $permission->name }}" class="inline-flex items-center w-full p-5 bg-white border-2 border-gray-200 rounded-lg cursor-pointer text-primaryDark dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-primaryTeal peer-checked:bg-primaryTeal/10 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="w-full text-sm">{{ $permission->name }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
</x-container>


@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editRole', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Role?',
                            text: 'Pastikan Data Role Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.edit()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Role Berhasil Diubahkan', 'success')
                                } else
                                    swal.fire('Gagal', 'Data Role Gagal Diubahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
