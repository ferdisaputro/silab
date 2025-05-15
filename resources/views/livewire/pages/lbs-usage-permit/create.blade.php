<x-container>
    <form x-on:submit.prevent="submitHandler" x-data="createEqLoan()">
        <div class="p-5 space-y-10 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <x-text.page-title>
                    Form Permohonan Menggunakan Fasilitas LBS Rekayasa Sistem Informasi
                    {{-- {{ $laboratoryId }} --}}
                </x-text.page-title>
            </div>

            <div wire:init="set('isStaff', 1)" x-data="{isStaff: true, isStaffSelected: true, isStudentSelected: false}">
                <x-alerts.outline class="mb-5" color="purple" message="Informasi Permohonan Menggunakan Fasilitas LBS" />
                <div class="px-5 space-y-5">
                    <div class="text-center">
                        <x-buttons.outline wire:click="set('isStaff', 1)" color="purple" x-show="!isStaffSelected" x-on:click="isStaff = true; isStaffSelected = true; isStudentSelected = false">Pegawai</x-buttons.outline>
                        <x-buttons.fill color="purple" x-show="isStaffSelected" x-on:click="isStaff = true; isStaffSelected = true; isStudentSelected = false">Pegawai</x-buttons.fill>

                        <x-buttons.outline wire:click="set('isStaff', 0)" color="blue" x-show="!isStudentSelected" x-on:click="isStaff = false ; isStaffSelected = false; isStudentSelected = true">Mahasiswa</x-buttons.outline>
                        <x-buttons.fill color="blue" x-show="isStudentSelected" x-on:click="isStaff = false ; isStaffSelected = false; isStudentSelected = true">Mahasiswa</x-buttons.fill>
                    </div>

                    <div>
                        <div class="flex flex-wrap gap-4" x-show="isStaff" x-transition>
                            <x-forms.select-advanced wire:key='{{ now() }}' class="flex-1 md:min-w-[20rem] md:max-w-lg" model="staff" name="staff" label="Pilih Pegawai">
                                @foreach ($staffs as $staffData)
                                    <option value="{{ $staffData->id {{-- this is staff id --}} }}" {{ $staffData->id == $staff? "selected" : '' }}>{{ $staffData->user->name }}</option>
                                @endforeach
                            </x-forms.select-advanced>
                        </div>

                        <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row" x-show="!isStaff" x-transition>
                            <x-forms.input class="flex-1 md:min-w-[20rem]" name="nim" label="NIM" />
                            <x-forms.input class="flex-1 md:min-w-[20rem]" name="name" label="Nama" />
                            <x-forms.input class="flex-1 md:min-w-[20rem]" name="golongan_kelompok" label="Golongan/Kelompok" />
                            <x-forms.select-advanced wire:key='{{ now() }}' model="mentor" class="flex-1 md:min-w-[20rem]" name="mentor" label="Pilih Dosen Pembimbing">
                                @foreach ($lecturers as $lecturer)
                                    <option value="{{ $lecturer->id {{-- this is staff id --}} }}" {{ $lecturer->id == $mentor? "selected" : '' }}>{{ $lecturer->user->name }}</option>
                                @endforeach
                            </x-forms.select-advanced>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <x-alerts.outline class="mb-5" color="green" message="Bermaksud akan melaksanakan kegiatan Tugas Akhir/Penelitian yang dimulai :" />
                <div class="relative justify-center flex flex-col md:flex-row gap-2 md:gap-7 px-5">
                    {{-- <div class="flex gap-2"> --}}
                        <!-- Start Date Picker -->
                        <x-forms.input
                            wire:model.live.debounce="startingDate"
                            {{-- value="{{ date('d/m/Y', strtotime(now())) }}" --}}
                            wire:init="startingDate = '{{ date('d/m/Y', strtotime(now())) }}'"
                            class="flex-1"
                            name="staringDate"
                            label="Tanggal Mulai"
                            datepicker />

                        <!-- Start Time Picker -->
                        <x-forms.timepicker
                            wire:init="startingTime = '{{ date('H:i', time()) }}'"
                            id="start_time"
                            wire:model="startingTime">
                        </x-forms.timepicker>
                    {{-- </div> --}}

                    <!-- 'To' Divider -->
                    <span class="md:absolute md:left-1/2 text-center md:top-3 md:-translate-x-1/2">
                        to
                    </span>

                    {{-- <div class="flex gap-2"> --}}
                        <!-- End Date Picker -->
                        <x-forms.input
                            wire:model.live.debounce="endingDate"
                            {{-- value="{{ date('d/m/Y', strtotime(now())) }}" --}}
                            wire:init="endingDate = '{{ date('d/m/Y', strtotime(now())) }}'"
                            class="flex-1"
                            name="endingDate"
                            label="Tanggal Selesai"
                            datepicker />

                        <!-- End Time Picker -->
                        <x-forms.timepicker
                            wire:init="endingTime = '{{ date('H:i', time()) }}'"
                            id="end_time"
                            wire:model="endingTime">
                        </x-forms.timepicker>
                </div>

            </div>

            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color='teal' message="Adapun Sarana dan Prasarana yang saya perlukan selama kegiatan Tugas Akhir/Penelitian adalah sebagai berikut :" />
                <div class="px-5 space-y-4">
                    @foreach ($selectedItems as $index => $item)
                        <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                            <x-forms.select class="flex-1 min-w-24"
                                    wire:model.live.debounce='selectedItems.{{ $index }}.item'
                                    name="selectedItems.{{ $index }}.item"
                                    label="Pilih Barang"
                                >
                                    @foreach ($this->labItems as $labItem)
                                        <option
                                            value="{{ $labItem->id }}"
                                            {{ $labItem->id == $selectedItems[$index]['item']? "selected" : '' }}
                                        >
                                            {{ $labItem->item->item_name }}
                                        </option>
                                    @endforeach
                                </x-forms.select>

                            <div class="flex flex-1 gap-4 min-w-24 md:flex-none">
                                    <div
                                        wire:key='{{ $selectedItems[$index]['item'] ?? now() }}'
                                        wire:init="set('selectedItems.{{ $index }}.stock', {{
                                                $this->labItems->find($selectedItems[$index]['item']) ?
                                                    $this->labItems->find($selectedItems[$index]['item'])->stock : '0'
                                        }})"
                                    >
                                        <x-forms.input
                                            class="flex-1 md:flex-none md:max-w-20"
                                            wire:model='selectedItems.{{ $index }}.stock'
                                            label="Stok"
                                            disabled="true" />
                                    </div>

                                    <x-forms.input
                                        type="number"
                                        class="flex-1 md:flex-none md:max-w-20"
                                        max="{{ (String) $selectedItems[$index]['stock'] }}"
                                        wire:model.live.debounce='selectedItems.{{ $index }}.qty'
                                        name="selectedItems.{{ $index }}.qty"
                                        label="jumlah" /></div>
                            {{-- <x-forms.select-advanced wire:key='{{ now() }}' class="flex-1" model="academic_year" name="academic_year" label="Pilih Tahun Ajaran" wire:key='{{ now() }}'>
                                @foreach ($this->academicYears as $academicYear)
                                    <option value="{{ $academicYear->id }}" {{ $academicYear->id == $academic_year ? 'selected' : '' }}>{{ $academicYear->start_year }} / {{ $academicYear->end_year }} ({{ $academicYear->is_even? "Genap" : "Ganjil" }})</option>
                                @endforeach
                            </x-forms.select-advanced> --}}

                            <x-forms.input class="flex-1 min-w-24" wire:model='items.{{ $index }}.keterangan' name="items.{{ $index }}.keterangan" label="Keterangan" />

                            <div class="flex justify-end gap-2">
                                @if (count($selectedItems) > 1)
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

            <div x-data="createLbsPermit" class="text-center">
                <x-buttons.fill type="submit" class="w-full max-w-xs"
                @click="submitHandler"
                >
                    Buat Ijin Penggunaan
                </x-buttons.fill>
            </div>

        </div>
    </form>
</x-container>


@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createLbsPermit', () => {
                return {
                    submitHandler() {
                        // Menampilkan SweetAlert konfirmasi
                        swal.fire({
                            title: 'Buat Izin Penggunaan',
                            text: 'Pastikan data sudah benar sebelum menyimpan.',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                // Jika "Ya" dipilih, lakukan aksi pengiriman data ke backend
                                const result = await $wire.create(); // Ini memanggil metode create dari Livewire

                                // Setelah proses selesai, cek apakah data berhasil disimpan
                                if (result.original.status === 'success') {
                                    swal.fire('Berhasil', 'Data Izin Laboratorium Berhasil Disimpan', 'success').then(() => {
                                        $wire.redirectToIndex(); // Arahkan ke halaman index
                                    });
                                } else {
                                    swal.fire('Gagal', 'Data Izin Laboratorium Gagal Ditambahkan: ' + result.original.message, 'error');
                                }
                        });
                    }
                }
            });
        </script>
    @endscript
@endPushOnce

