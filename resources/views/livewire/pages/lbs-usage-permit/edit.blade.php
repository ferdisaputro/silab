<x-container>
    <form>
        <div class="p-5 space-y-10 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <x-text.page-title>
                    Form Ubah Permohonan Menggunakan Fasilitas LBS Rekayasa Sistem Informasi
                </x-text.page-title>
            </div>

            <div x-data="{isStaff: true, isStaffSelected: true, isStudentSelected: false}">
                <x-alerts.outline class="mb-5" color="purple" message="Yang bertandatangan dibawah ini, saya :" />
                <div class="px-5 space-y-5">
                    <div class="text-center">
                        <x-buttons.outline color="purple" x-show="!isStaffSelected" x-on:click="isStaff = true; isStaffSelected = true; isStudentSelected = false">Pegawai</x-buttons.outline>
                        <x-buttons.fill color="purple" x-show="isStaffSelected" x-on:click="isStaff = true; isStaffSelected = true; isStudentSelected = false">Pegawai</x-buttons.fill>

                        <x-buttons.outline color="blue" x-show="!isStudentSelected" x-on:click="isStaff = false ; isStaffSelected = false; isStudentSelected = true">Mahasiswa</x-buttons.outline>
                        <x-buttons.fill color="blue" x-show="isStudentSelected" x-on:click="isStaff = false ; isStaffSelected = false; isStudentSelected = true">Mahasiswa</x-buttons.fill>
                    </div>

                    <div>
                        <div class="flex flex-wrap gap-4" x-show="isStaff" x-transition>
                            <x-forms.select class="flex-1 md:min-w-[20rem] md:max-w-lg" name="staff" label="Pilih Pegawai">
                                <option value="key1">test1</option>
                                <option value="key2">test2</option>
                                <option value="key3">test3</option>
                                <option value="key4">test4</option>
                            </x-forms.select>
                        </div>

                        <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row" x-show="!isStaff" x-transition>
                            <x-forms.input class="flex-1 md:min-w-[20rem]" name="nim" label="NIM" />
                            <x-forms.input class="flex-1 md:min-w-[20rem]" name="nama" label="Nama" />
                            <x-forms.input class="flex-1 md:min-w-[20rem]" name="golongan_kelompok" label="Golongan/Kelompok" />
                            <x-forms.select class="flex-1 md:min-w-[20rem]" name="dosen_pembimbing" label="Pilih Dosen Pembimbing">
                                <option value="key1">test1</option>
                                <option value="key2">test2</option>
                                <option value="key3">test3</option>
                                <option value="key4">test4</option>
                            </x-forms.select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color="green" message="Bermaksud akan melaksanakan kegiatan Tugas Akhir/Penelitian yang dimulai :" />
                <div class="relative justify-center flex flex-col md:flex-row gap-2 md:gap-7 px-5" date-rangepicker>
                    <x-forms.input name="datepicker-range-start" label="Tanggal Mulai" class="flex-1">
                        <i class="fa-solid fa-calendar-days fa-sm absolute top-1/2 right-4 -translate-y-1/2"></i>
                    </x-forms.input>
                    <span class="md:absolute md:left-1/2 text-center md:top-3 md:-translate-x-1/2">
                        to
                    </span>
                    <x-forms.input name="datepicker-range-end" label="Tanggal Selesai" class="flex-1">
                        <i class="fa-solid fa-calendar-days fa-sm absolute top-1/2 right-4 -translate-y-1/2"></i>
                    </x-forms.input>
                </div>
            </div>

            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color='teal' message="Adapun Sarana dan Prasarana yang saya perlukan selama kegiatan Tugas Akhir/Penelitian adalah sebagai berikut :" />
                <div class="px-5 space-y-4">
                    @foreach ($items as $index => $item)
                        <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                            <x-forms.select class="flex-1 min-w-24" wire:model='items.{{ $index }}.bahan' name="items.{{ $index }}.bahan" label="Pilih Barang">
                                <option value="key1">test1</option>
                                <option value="key2">test2</option>
                                <option value="key3">test3</option>
                                <option value="key4">test4</option>
                            </x-forms.select>

                            <div class="flex flex-1 gap-4 min-w-24 md:flex-none">
                                <x-forms.input class="flex-1 md:flex-none md:max-w-20" wire:model='items.{{ $index }}.stok' name="items.{{ $index }}.stok" label="Stok" disabled="true" />
                                <x-forms.input class="flex-1 md:flex-none md:max-w-20" wire:model='items.{{ $index }}.jumlah' name="items.{{ $index }}.jumlah" label="Jumlah" />
                            </div>


                            <x-forms.select class="flex-1 min-w-40 md:max-w-60" wire:model='items.{{ $index }}.tahun_ajaran' name="items.{{ $index }}.tahun_ajaran" label="Pilih Tahun Ajaran">
                                <option value="key1">test1</option>
                                <option value="key2">test2</option>
                                <option value="key3">test3</option>
                                <option value="key4">test4</option>
                            </x-forms.select>

                            <x-forms.input class="flex-1 min-w-24" wire:model='items.{{ $index }}.keterangan' name="items.{{ $index }}.keterangan" label="Keterangan" />

                            <div class="flex justify-end gap-2">
                                @if (count($items) > 1)
                                    <x-buttons.outline wire:click='removeItem({{ $index }})' color="yellow">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </x-buttons.outline>
                                @endif

                                @if ($loop->iteration == 1)
                                    <x-buttons.outline wire:click='addItem' color="blue">
                                        <i class="fa-solid fa-plus"></i>
                                    </x-buttons.outline>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center">
                <x-buttons.fill class="w-full max-w-xs">Simpan Perubahan Ijin Penggunaan</x-buttons.fill>
            </div>
        </div>
    </form>
</x-container>
