<x-container>
    <form x-on:submit.prevent="submitHandler" x-data="createLbsPermit()">
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
                            <x-forms.input class="flex-1 md:min-w-[20rem]" wire:model="nim" name="nim" label="NIM" />
                            <x-forms.input class="flex-1 md:min-w-[20rem]" wire:model="name" name="name" label="Nama" />
                            <x-forms.input class="flex-1 md:min-w-[20rem]" wire:model="groupClass" name="groupClass" label="Golongan/Kelompok" />
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
                <div class="relative flex flex-col justify-center gap-2 px-5 md:flex-row md:gap-7">
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
                            name="startingTime"
                            wire:model="startingTime">
                        </x-forms.timepicker>
                    {{-- </div> --}}

                    <!-- 'To' Divider -->
                    <span class="text-center md:absolute md:left-1/2 md:top-3 md:-translate-x-1/2">
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
                            name="endingTime"
                            wire:model="endingTime">
                        </x-forms.timepicker>
                </div>

            </div>

            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color='teal' message="Adapun Sarana dan Prasarana yang saya perlukan selama kegiatan Tugas Akhir/Penelitian adalah sebagai berikut :" />
                <div class="px-5 space-y-4">
                    @foreach ($selectedItems as $index => $item)
                        <div class="flex flex-col flex-wrap gap-4 md:flex-row" wire:key="selected-item-{{ $index }}">
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
                                    max="{{ $selectedItems[$index]['stock'] ?? 0 }}"
                                    min="1"
                                    wire:model.debounce.500ms="selectedItems.{{ $index }}.qty"
                                    name="selectedItems.{{ $index }}.qty"
                                    label="Jumlah"
                                />
                            </div>

                            <x-forms.input
                                class="flex-1 min-w-24"
                                wire:model="selectedItems.{{ $index }}.keterangan"
                                name="selectedItems.{{ $index }}.keterangan"
                                label="Keterangan"
                            />

                            <div class="flex justify-end gap-2">
                                @if (count($selectedItems) > 1)
                                    <x-buttons.outline wire:click.prevent="removeItem({{ $index }})" color="yellow" title="Hapus item">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </x-buttons.outline>
                                @endif

                                @if ($loop->last)
                                    <x-buttons.outline wire:click.prevent="addItem" color="blue" title="Tambah item">
                                        <i class="fa-solid fa-plus"></i>
                                    </x-buttons.outline>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="text-center">
                <x-buttons.fill type="submit" class="w-full max-w-xs" >
                    Buat Ijin Penggunaan
                </x-buttons.fill>
            </div>

        </div>
    </form>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createLbsPermit', () => ({
                isStaff: true,
                isStaffSelected: true,
                isStudentSelected: false,
                submitHandler() {
                    swal.fire({
                        title: 'Buat Izin Penggunaan',
                        text: 'Pastikan data sudah benar sebelum menyimpan.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal',
                    }).then(async res => {
                        if (res.isConfirmed) {
                            try {
                                const result = await $wire.create()
                                if (result.status = 'success') {
                                    swal.fire('Berhasil', 'Data Izin Laboratorium Berhasil Disimpan', 'success').then(() => {
                                        $wire.redirectToIndex();
                                    });
                                } else {
                                    swal.fire('gagal', 'Terjadi error', 'error');
                                }
                            } catch (e) {
                                swal.fire('Error', e.message, 'error');
                            }
                        }
                    });
                }
            }))
        </script>

    @endscript
@endPushOnce
