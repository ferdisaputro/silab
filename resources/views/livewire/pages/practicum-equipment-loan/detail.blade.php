<div>
    <form>
        <div class="p-5 space-y-10 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <x-text.page-title>
                    Detail Peminjaman Alat Praktikum {{ $id }}
                </x-text.page-title>
            </div>

            <div x-data="{isStaff: true, isStaffSelected: true, isStudentSelected: false}">
                <x-alerts.outline class="mb-5" color="purple" message="Informasi Peminjam" />
                <div class="px-5 space-y-5">
                    <div class="text-center">
                        <x-buttons.outline color="purple" x-show="!isStaffSelected" x-on:click="isStaff = true; isStaffSelected = true; isStudentSelected = false">Pegawai</x-buttons.outline>
                        <x-buttons.fill color="purple" x-show="isStaffSelected" x-on:click="isStaff = true; isStaffSelected = true; isStudentSelected = false">Pegawai</x-buttons.fill>
                        
                        <x-buttons.outline color="blue" x-show="!isStudentSelected" x-on:click="isStaff = false ; isStaffSelected = false; isStudentSelected = true">Mahasiswa</x-buttons.outline>
                        <x-buttons.fill color="blue" x-show="isStudentSelected" x-on:click="isStaff = false ; isStaffSelected = false; isStudentSelected = true">Mahasiswa</x-buttons.fill>
                    </div>

                    <div>
                        <div class="flex flex-wrap gap-4" x-show="isStaff" x-transition>
                            <x-forms.select disabled class="flex-1 md:min-w-[20rem] md:max-w-lg" name="staff" label="Pilih Dosen">
                                <option value="key1">test1</option>
                                <option value="key2">test2</option>
                                <option value="key3">test3</option>
                                <option value="key4">test4</option>
                            </x-forms.select>
                        </div>

                        <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row" x-show="!isStaff" x-transition>
                            <x-forms.input disabled class="flex-1 md:min-w-[20rem]" name="nim" label="NIM" />
                            <x-forms.input disabled class="flex-1 md:min-w-[20rem]" name="nama" label="Nama" />
                            <x-forms.input disabled class="flex-1 md:min-w-[20rem]" name="golongan_kelompok" label="Golongan/Kelompok" />
                            <x-forms.select disabled class="flex-1 md:min-w-[20rem]" name="dosen_pembimbing" label="Pilih Dosen Pembimbing">
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
                <x-alerts.outline class="mb-5" color="green" message="Data Petugas" />
                <div class="grid grid-cols-1 gap-4 px-5 md:grid-cols-2">
                    <div class="space-y-4">
                        <x-forms.input disabled class="flex-1 md:min-w-[25rem]" name="petugas_peminjaman" label="Petugas Peminjaman" />
                        <x-forms.input disabled class="flex-1 md:min-w-[20rem]" name="tanggal_peminjaman" label="Tanggal Peminjaman" type="datepicker" />
                    </div>
                    <div class="space-y-4">
                        <x-forms.input disabled class="flex-1 md:min-w-[25rem]" name="petugas_pengembalian" label="Petugas Pengembalian" />
                        <x-forms.input disabled class="flex-1 md:min-w-[20rem]" name="tanggal_pengembalian" label="Tanggal Pengembalian" type="datepicker" />
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color='teal' message="Alat yang dipinjam" />
                <div class="px-5 space-y-4">
                    @foreach ($items as $index => $item)
                        <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                            <x-forms.select disabled class="flex-1 min-w-24" wire:model='items.{{ $index }}.bahan' name="items.{{ $index }}.bahan" label="Pilih Barang">
                                <option value="key1">test1</option>
                                <option value="key2">test2</option>
                                <option value="key3">test3</option>
                                <option value="key4">test4</option>
                            </x-forms.select>

                            <div class="flex flex-1 gap-4 min-w-24 md:flex-none">
                                <x-forms.input disabled class="flex-1 md:flex-none md:max-w-20" wire:model='items.{{ $index }}.stok' name="items.{{ $index }}.stok" label="Stok" disabled="true" />
                                <x-forms.input disabled class="flex-1 md:flex-none md:max-w-20" wire:model='items.{{ $index }}.jumlah' name="items.{{ $index }}.jumlah" label="Jumlah" />
                            </div>


                            <x-forms.select disabled class="flex-1 min-w-24 md:max-w-60" wire:model='items.{{ $index }}.tahun_ajaran' name="items.{{ $index }}.tahun_ajaran" label="Pilih Tahun Ajaran">
                                <option value="key1">test1</option>
                                <option value="key2">test2</option>
                                <option value="key3">test3</option>
                                <option value="key4">test4</option>
                            </x-forms.select>

                            <x-forms.input disabled class="flex-1 min-w-24" wire:model='items.{{ $index }}.keterangan' name="items.{{ $index }}.keterangan" label="Keterangan" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
</div>