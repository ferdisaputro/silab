{{-- <x-container> --}}
    <div>
        <h3 class="mb-6 text-xl font-semibold">Tambah Pegawai</h3>
        <form x-data="createEmployee" x-on:submit.prevent="create">
            <div class="flex flex-col gap-7 lg:flex-row">
                <div class="flex-1 space-y-4 lg:max-w-md">
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG or JPG</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>

                    <div>
                        {{-- <h3 class="mb-2 font-semibold">Status</h3> --}}
                        <ul class="flex items-center w-full overflow-hidden text-sm font-medium border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center">
                                    <input id="aktif" checked type="radio" name="status" class="hidden peer">
                                    <label for="aktif" class="w-full py-3 text-sm font-medium text-center cursor-pointer hover:bg-primaryLightTeal/60 peer-checked:bg-primaryLightTeal">Aktif</label>
                                </div>
                            </li>
                            <div class="border-r"></div>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center">
                                    <input id="tidak-aktif" type="radio" name="status" class="hidden peer">
                                    <label for="tidak-aktif" class="w-full py-3 text-sm font-medium text-center cursor-pointer hover:bg-red-500/60 peer-checked:text-primaryWhite peer-checked:bg-red-500">Tidak Aktif</label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <ul class="flex items-center w-full overflow-hidden text-sm font-medium border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600">
                            <li class="flex-1 border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center">
                                    <input id="administrator" type="radio" name="status-employee" class="hidden peer">
                                    <label for="administrator" class="w-full py-3 text-sm font-medium text-center cursor-pointer peer-checked:text-white peer-checked:bg-blue-500 hover:bg-blue-300">Administrator</label>
                                </div>
                            </li>
                            <div class="border-r"></div>
                            <li class="flex-1 border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center">
                                    <input id="dosen" type="radio" name="status-employee" class="hidden peer">
                                    <label for="dosen" class="w-full py-3 text-sm font-medium text-center cursor-pointer peer-checked:text-white peer-checked:bg-blue-500 hover:bg-blue-300">Dosen</label>
                                </div>
                            </li>
                            <div class="border-r"></div>
                            <li class="flex-1 border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center">
                                    <input id="teknisi" type="radio" name="status-employee" class="hidden peer">
                                    <label for="teknisi" class="w-full py-3 text-sm font-medium text-center cursor-pointer peer-checked:text-white peer-checked:bg-blue-500 hover:bg-blue-300">Teknisi</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex-1 space-y-4">
                    <h5 class="text-lg font-semibold ms-4">Informasi Pribadi</h5>

                    <x-forms.input class="min-w-28" wire:model.live.debounce='kode' name="kode" type="text" label="NIP / NIK / NRP" key="kode"></x-forms.input>
                    <x-forms.input class="min-w-28" wire:model.live.debounce='name' name="name" type="text" label="Name" key="name"></x-forms.input>
                    <x-forms.input class="min-w-28" wire:model.live.debounce='nomor' name="nomor" type="text" label="nomor telefon" key="nomor"></x-forms.input>

                    <div class="pt-3">
                        <hr>
                        <h5 class="text-lg font-semibold ms-4">Informasi Akun</h5>
                    </div>

                    <div class="flex flex-wrap gap-3 ">
                        <x-forms.input class="flex-1 min-w-32" wire:model.live.debounce='name' name="name" type="text" label="test" key="kode"></x-forms.input>
                        <x-forms.select class="flex-1 min-w-32" name="kode1" label="test" key="kode1">
                            <option value="test-val1">test1</option>
                            <option value="test-val2">test2</option>
                            <option value="test-val3">test3</option>
                            <option value="test-val4">test4</option>
                        </x-forms.select>
                        <x-forms.input class="flex-1 min-w-32" name="kode2" type="text" label="test" key="kode2"></x-forms.input>
                        <x-forms.input class="flex-1 min-w-32" name="kode2" type="text" label="test" key="kode2"></x-forms.input>
                    </div>
                </div>
            </div>
            <div class="text-center mt-7">
                <x-buttons.outline type="submit" class="w-full max-w-xs">
                    Tambah
                </x-buttons.outline>
            </div>
        </form>
    </div>
{{-- </x-container> --}}

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createEmployee', () => {
                return {
                    create() {
                        swal.fire({
                            text: 'test',
                            icon: 'success',
                            timer: 2000,
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
