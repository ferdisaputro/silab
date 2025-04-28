<x-container>
    <form>
        <div class="p-5 space-y-10 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <x-text.page-title>
                    Form Permohonan Menggunakan Fasilitas LBS Rekayasa Sistem Informasi{{ $selectedLab }}
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
                            <x-forms.select-advanced wire:key='{{ now() }}' class="flex-1 md:min-w-[20rem] md:max-w-lg" model="staff" name="staff" label="Pilih Pegawai">
                                @foreach ($staffs as $staffData)
                                    <option value="{{ $staffData->id {{-- this is staff id --}} }}" {{ $staffData->id == $staff? "selected" : '' }}>{{ $staffData->user->name }}</option>
                                @endforeach
                            </x-forms.select-advanced>
                        </div>

                        <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row" x-show="!isStaff" x-transition>
                            <x-forms.input class="flex-1 md:min-w-[20rem]" name="nim" label="NIM" />
                            <x-forms.input class="flex-1 md:min-w-[20rem]" name="nama" label="Nama" />
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
                <div class="relative justify-center flex flex-col md:flex-row gap-2 md:gap-7 px-5" date-rangepicker>
                    {{-- <div class="flex gap-2"> --}}
                        <!-- Start Date Picker -->
                        <x-forms.input
                            wire:model.live.debounce="startDate"
                            value="{{ date('d/m/Y', strtotime(now())) }}"
                            wire:init="startDate = '{{ date('d/m/Y', strtotime(now())) }}'"
                            class="flex-1"
                            name="startDate"
                            label="Tanggal Mulai"
                            datepicker />

                        <!-- Start Time Picker -->
                        <x-forms.timepicker wire:model="endTime" id="start_time" value="{{ date('H:i', time()) }}"></x-forms.timepicker>
                    {{-- </div> --}}

                    <!-- 'To' Divider -->
                    <span class="md:absolute md:left-1/2 text-center md:top-3 md:-translate-x-1/2">
                        to
                    </span>

                    {{-- <div class="flex gap-2"> --}}
                        <!-- End Date Picker -->
                        <x-forms.input
                            wire:model.live.debounce="endDate"
                            value="{{ date('d/m/Y', strtotime(now())) }}"
                            wire:init="endDate = '{{ date('d/m/Y', strtotime(now())) }}'"
                            class="flex-1"
                            name="endDate"
                            label="Tanggal Selesai"
                            datepicker />

                        <!-- End Time Picker -->
                        <x-forms.timepicker wire:model="endTime" id="end_time" value="{{ date('H:i', time()) }}"></x-forms.timepicker>
                    {{-- </div> --}}
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
                                        wire:key='{{ $selectedItems[$index]['item']?? now() }}'
                                        wire:init="set('selectedItems.{{ $index }}.stock', {{
                                            $this->labItems->find($selectedItems[$index]['item'])?
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
                            <x-forms.select-advanced wire:key='{{ now() }}' class="flex-1" model="academicYearId" name="academicYearId" label="Pilih Tahun Ajaran" wire:key='{{ now() }}'>
                                @foreach ($this->academicYears as $academicYear)
                                    <option value="{{ $academicYear->id }}" {{ $academicYear->id == $academicYearId ? 'selected' : '' }}>{{ $academicYear->start_year }} / {{ $academicYear->end_year }} ({{ $academicYear->is_even? "Genap" : "Ganjil" }})</option>
                                @endforeach
                            </x-forms.select-advanced>

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

            <div class="text-center">
                <x-buttons.fill class="w-full max-w-xs" wire:click="create">
                    Buat Ijin Penggunaan
                </x-buttons.fill>
            </div>

        </div>
    </form>
</x-container>
