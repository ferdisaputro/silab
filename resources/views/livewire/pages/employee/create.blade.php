{{-- <x-container> --}}
    <div>
        <h3 class="mb-6 text-xl font-semibold">Tambah Pegawai</h3>
        <form x-data="createEmployee" x-on:submit.prevent='submitHandler'>
            <div class="flex flex-col gap-7 lg:flex-row">
                <div class="flex-1 space-y-4 lg:max-w-md">
                    <div>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer min-h-64 bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500">
                                @if ($photo)
                                    <div class="my-3">
                                        <div class="w-2/5 mx-auto aspect-1">
                                            <img src="{{ $photo->temporaryUrl() }}" alt="{{ $photo->getClientOriginalName() }}" class="object-cover object-center w-full h-full border rounded-lg">
                                        </div>
                                    </div>
                                @endif

                                <div class="flex flex-col items-center justify-center pt-5 pb-8">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or JPEG</p>
                                </div>
                                <input wire:model.live='photo' id="dropzone-file" type="file" accept=".png, .jpg, .jpeg" class="hidden" />
                            </label>
                        </div>
                        @error("photo")
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        {{-- <h3 class="mb-2 font-semibold">Status</h3> --}}
                        <ul class="flex items-center w-full overflow-hidden text-sm font-medium border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center">
                                    <input wire:model='status' id="aktif" checked type="radio" name="status" value="1" class="hidden peer">
                                    <label for="aktif" class="w-full py-3 text-sm font-medium text-center cursor-pointer hover:bg-primaryLightTeal/60 peer-checked:bg-primaryLightTeal">Aktif</label>
                                </div>
                            </li>
                            <div class="border-r"></div>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center">
                                    <input wire:model='status' id="tidak-aktif" type="radio" name="status" value="0" class="hidden peer">
                                    <label for="tidak-aktif" class="w-full py-3 text-sm font-medium text-center cursor-pointer hover:bg-red-500/60 peer-checked:text-primaryWhite peer-checked:bg-red-500">Tidak Aktif</label>
                                </div>
                            </li>
                        </ul>
                        @error("status")
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <ul class="flex items-center w-full overflow-hidden text-sm font-medium border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600">
                            @foreach ($staffStatuses as $staffStatus)
                                @if ($loop->iteration > 0)
                                    <div class="border-r"></div>
                                @endif
                                <li class="flex-1 border-b border-gray-200 sm:border-b-0 @if (!$loop->last) sm:border-r @endif dark:border-gray-600">
                                    <div class="flex items-center">
                                        <input wire:model='staff_statuses_id' {{ $loop->first? "checked" : '' }} id="{{ $staffStatus->staff_status }}" value="{{ $staffStatus->id }}" type="radio" name="status-employee" class="hidden peer">
                                        <label for="{{ $staffStatus->staff_status }}" class="w-full py-3 text-sm font-medium text-center cursor-pointer peer-checked:text-white peer-checked:bg-blue-500 hover:bg-blue-300">{{ $staffStatus->staff_status }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @error("staff_statuses_id")
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex-1 space-y-4">
                    <h5 class="text-lg font-semibold ms-4">Informasi Pribadi</h5>

                    <x-forms.input wire:model.live.debounce='code' class="min-w-28" name="code" type="text" label="NIP / NIK / NRP" key="kode"></x-forms.input>
                    <x-forms.input wire:model.live.debounce='name' required class="min-w-28" name="name" type="text" label="Name" key="name"></x-forms.input>
                    <x-forms.input wire:model.live.debounce='phone' class="min-w-28" name="phone" type="text" label="nomor telefon" key="phone"></x-forms.input>

                    <div class="pt-3">
                        <hr>
                        <h5 class="text-lg font-semibold ms-4">Informasi Akun</h5>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <x-forms.input wire:model.live.debounce='email' required name="email" type="email" label="email" key="email"></x-forms.input>
                        <x-forms.select wire:model.live.debounce='role' required name="role" label="Role" key="role">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </x-forms.select>
                        <x-forms.input wire:model.live.debounce='password_confirmation' name="password_confirmation" type="password" label="Password" key="password_confirmation"></x-forms.input>
                        <x-forms.input wire:model.live.debounce='password' name="password" type="password" label="Ulangi Password" key="password"></x-forms.input>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center gap-4 text-center mt-7">
                <x-buttons.fill wire:loading.remove type="submit" class="w-full max-w-xs">
                    Tambah
                </x-buttons.fill>
                <x-buttons.outline wire:loading type="button" class="w-full max-w-xs">
                    <x-loading.circle></x-loading.circle>
                </x-buttons.outline>
                <x-buttons.outline type="button" color='red' x-on:click="$wire.resetForm()">
                    Reset
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
                    submitHandler() {
                        swal.fire({
                            title: 'Tambah Staff Baru?',
                            text: 'Pastikan Data Staff Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Staff Berhasil Ditambahkan', 'success')
                                    this.$el.closest('form').reset() // reset form
                                    $wire.$parent.$refresh() //refresh component from the parent of this component wich is index
                                } else
                                    swal.fire('Gagal', 'Data Staff Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce

