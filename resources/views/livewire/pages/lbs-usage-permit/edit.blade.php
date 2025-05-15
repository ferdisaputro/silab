<x-container>
    <form x-on:submit.prevent="submitHandler" x-data="editLbs()">
        <div class="p-5 space-y-10 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <x-text.page-title>
                    Form Ubah Permohonan Menggunakan Fasilitas LBS Rekayasa Sistem Informasi
                </x-text.page-title>
            </div>

            <div wire:init="set('isStaff', 1)" x-data="{isStaff: true, isStaffSelected: true, isStudentSelected: false}">
                <x-alerts.outline class="mb-5" color="purple" message="Informasi Peminjam" />
                <div class="px-5 space-y-5">
                    <div class="text-center">
                        <x-buttons.outline wire:click="set('isStaff', 1)" color="purple" x-show="!isStaffSelected" x-on:click="isStaff = true; isStaffSelected = true; isStudentSelected = false">Pegawai</x-buttons.outline>
                        <x-buttons.fill color="purple" x-show="isStaffSelected" x-on:click="isStaff = true; isStaffSelected = true; isStudentSelected = false">Pegawai</x-buttons.fill>

                        <x-buttons.outline wire:click="set('isStaff', 0)" color="blue" x-show="!isStudentSelected" x-on:click="isStaff = false ; isStaffSelected = false; isStudentSelected = true">Mahasiswa</x-buttons.outline>
                        <x-buttons.fill color="blue" x-show="isStudentSelected" x-on:click="isStaff = false ; isStaffSelected = false; isStudentSelected = true">Mahasiswa</x-buttons.fill>
                    </div>

                    <div>
                        <div>
                            @if ($lbsUsagePermit->is_staff)
                                <div class="flex flex-wrap gap-4">
                                    <x-forms.select-advanced disabled wire:key='{{ now() }}' class="flex-1 md:min-w-[20rem] md:max-w-lg" name="staff" label="Pilih Pegawai">
                                        @foreach ($staffs as $staffData)
                                            <option value="{{ $staffData->id {{-- this is staff id --}} }}" {{ $staffData->id == $lbsUsagePermit->staff_id? "selected" : '' }}>{{ $staffData->user->name }}</option>
                                        @endforeach
                                    </x-forms.select-advanced>
                                </div>
                            @else
                                <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row">
                                    <x-forms.input wire:model.live.debounce="nim" class="flex-1 md:min-w-[20rem]" name="nim" label="NIM" />
                                    <x-forms.input wire:model.live.debounce="name" class="flex-1 md:min-w-[20rem]" name="name" label="Nama" />
                                    <x-forms.input wire:model.live.debounce="groupClass" class="flex-1 md:min-w-[20rem]" name="groupClass" label="Golongan/Kelompok" />
                                    <x-forms.select-advanced wire:key='{{ now() }}' class="flex-1 md:min-w-[20rem] md:max-w-lg" model="mentor" name="mentor" label="Pilih Dosen Pembimbing">
                                        @foreach ($lecturers as $lecturer)
                                            <option value="{{ $lecturer->id {{-- this is staff id --}} }}" {{ $lecturer->id == $lbsUsagePermit->staff_id_mentor? "selected" : '' }}>{{ $lecturer->user->name }}</option>
                                        @endforeach
                                    </x-forms.select-advanced>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>



            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color="green" message="Bermaksud akan melaksanakan kegiatan Tugas Akhir/Penelitian yang dimulai :" />
                <div class="relative justify-center flex flex-col md:flex-row gap-2 md:gap-7 px-5" >

                     <x-forms.input value="{{ date('d/m/Y', strtotime($lbsUsagePermit->start_date)) }}"
                        {{-- disabled  --}}
                        class="flex-1"
                        name="startingDate"
                        label="Tanggal Mulai"
                        datepicker />
                    <x-forms.timepicker
                        {{-- disabled  --}}
                        id="start_time"
                        value="{{ date('H:i', strtotime($lbsUsagePermit->start_date)) }}">
                    </x-forms.timepicker>
                    <span class="md:absolute md:left-1/2 text-center md:top-3 md:-translate-x-1/2">
                        to
                    </span>
                    <x-forms.input value="{{ date('d/m/Y', strtotime($lbsUsagePermit->end_date)) }}"
                        {{-- disabled --}}
                        class="flex-1"
                        name="endingDate"
                        label="Tanggal Selesai"
                        datepicker />
                    <x-forms.timepicker
                        {{-- disabled --}}
                        id="end_time"
                        value="{{ date('H:i', strtotime($lbsUsagePermit->end_date)) }}">
                    </x-forms.timepicker>
                </div>
            </div>

            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color='teal' message="Adapun Sarana dan Prasarana yang saya perlukan selama kegiatan Tugas Akhir/Penelitian adalah sebagai berikut :" />
                <div class="px-5 space-y-4">
                    @foreach ($selectedItems as $index => $item)
                        <div class="flex flex-[1.3] gap-4">
                                <x-forms.select :disabled="!isset($item['new'])? true : false" class="flex-1 min-w-24"
                                    wire:model.live.debounce='selectedItems.{{ $index }}.item'
                                    name="selectedItems.{{ $index }}.item"
                                    label="Pilih Barang"
                                >
                                    @foreach ($lbsUsagePermit->laboratory->labItems as $labItem)
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
                                            isset($item['new'])?
                                                ($lbsUsagePermit->laboratory->labItems->find($selectedItems[$index]['item'])?
                                                    $lbsUsagePermit->laboratory->labItems->find($selectedItems[$index]['item'])->stock : '0')
                                            : ($lbsUsagePermit->details->firstWhere('lab_item_id', $selectedItems[$index]['item'])?
                                                $lbsUsagePermit->details->firstWhere('lab_item_id', $selectedItems[$index]['item'])->stockCard->stock : '0')

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
                                        label="jumlah" />
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>

            <div x-data="createLbsPermit" class="text-center">
                <x-buttons.fill type="submit" class="w-full max-w-xs" @click="submitHandler">
                    Simpan Perubahan
                </x-buttons.fill>
            </div>
        </div>
    </form>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editLbs', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Ijin Penggunaan LBS',
                            text: 'Pastikan Data Ijin Penggunaan LBS Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                const result = await $wire.edit()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Ijin Penggunaan LBS Berhasil Diubah', 'success')
                                } else
                                    swal.fire('Gagal', 'Data Ijin Penggunaan LBS Gagal Diubah :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
