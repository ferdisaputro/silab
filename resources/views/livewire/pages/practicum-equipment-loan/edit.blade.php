<x-container>
    <form x-on:submit.prevent="submitHandler" x-data="editEqLoan()">
        <div class="p-5 space-y-10 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <x-text.page-title>
                    Ubah Peminjaman Alat Praktikum
                </x-text.page-title>
            </div>

            <div>
                <x-alerts.outline class="mb-5" color="purple" message="Informasi Peminjam" />
                <div class="px-5 space-y-5">
                    <div class="text-center">
                        @if ($equipmentLoan->is_staff)
                            <x-buttons.fill color="purple">Pegawai</x-buttons.fill>
                            <x-buttons.outline color="blue">Mahasiswa</x-buttons.outline>
                        @else
                            <x-buttons.outline color="purple">Pegawai</x-buttons.outline>
                            <x-buttons.fill color="blue">Mahasiswa</x-buttons.fill>
                        @endif
                    </div>

                    <div>
                        @if ($equipmentLoan->is_staff)
                            <div class="flex flex-wrap gap-4">
                                <x-forms.select-advanced disabled wire:key='{{ now() }}' class="flex-1 md:min-w-[20rem] md:max-w-lg" name="staff" label="Pilih Pegawai">
                                    @foreach ($staffs as $staffData)
                                        <option value="{{ $staffData->id {{-- this is staff id --}} }}" {{ $staffData->id == $equipmentLoan->staff_id? "selected" : '' }}>{{ $staffData->user->name }}</option>
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
                                        <option value="{{ $lecturer->id {{-- this is staff id --}} }}" {{ $lecturer->id == $equipmentLoan->staff_id_mentor? "selected" : '' }}>{{ $lecturer->user->name }}</option>
                                    @endforeach
                                </x-forms.select-advanced>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color="green" message="Data Petugas" />
                <div class="grid grid-cols-1 gap-4 px-5 md:grid-cols-2">
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <x-forms.input value="{{ date('d/m/Y', strtotime($equipmentLoan->borrowing_date)) }}" disabled class="flex-1" name="borrowingDate" label="Tanggal Peminjaman" datepicker />
                            <x-forms.timepicker disabled id="borrow_time" value="{{ date('H:i', strtotime($equipmentLoan->borrowing_date)) }}"></x-forms.timepicker>
                        </div>
                        <x-forms.input value="{{ $equipmentLoan->memberBorrow->staff->user->name }}" disabled class="flex-1" name="petugas_peminjaman" label="Petugas Penanggung Jawab Peminjaman" />
                    </div>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <x-forms.input disabled class="flex-1" name="tangal pengembalian" label="Tanggal Pengembalian" datepicker />
                            <x-forms.timepicker disabled id="return_time"></x-forms.timepicker>
                        </div>
                        <x-forms.input disabled class="flex-1" name="petugas_pengembalian" label="Petugas Penanggung Jawab Pengembalian" />
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color='teal' message="Alat yang dipinjam" />
                <div class="px-5 space-y-5">
                    @foreach ($selectedItems as $index => $item)
                    <div wire:key='{{ $index }}'>
                        <span class="text-sm" wire:key='{{ $index }}'>Barang {{ $loop->iteration }}</span>
                        <div class="flex flex-row flex-wrap gap-4 mt-2">
                            <div class="flex flex-[1.3] gap-4">
                                <x-forms.select :disabled="!isset($item['new'])? true : false" class="flex-1 min-w-24"
                                    wire:model.live.debounce='selectedItems.{{ $index }}.item'
                                    name="selectedItems.{{ $index }}.item"
                                    label="Pilih Barang"
                                >
                                    @foreach ($equipmentLoan->laboratory->labItems as $labItem)
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
                                                ($equipmentLoan->laboratory->labItems->find($selectedItems[$index]['item'])?
                                                    $equipmentLoan->laboratory->labItems->find($selectedItems[$index]['item'])->stock : '0')
                                            : ($equipmentLoan->loanDetails->firstWhere('lab_item_id', $selectedItems[$index]['item'])?
                                                $equipmentLoan->loanDetails->firstWhere('lab_item_id', $selectedItems[$index]['item'])->stockCard->stock : '0')

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

                            <div class="flex flex-1 gap-4">
                                <x-forms.input class="flex-1 min-w-24" wire:model.live.debounce='selectedItems.{{ $index }}.description' name="selectedItems.{{ $index }}.description" label="Keterangan" />

                                <div class="flex justify-end gap-2">
                                    <x-buttons.outline wire:click='removeItem({{ $index }})' color="yellow">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </x-buttons.outline>

                                    @if ($loop->iteration == 1)
                                        <x-buttons.outline wire:click='addItem' color="blue">
                                            <i class="fa-solid fa-plus"></i>
                                        </x-buttons.outline>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center">
                <x-buttons.fill type="submit" class="w-full max-w-xs">Simpan Laporan</x-buttons.fill>
            </div>
        </div>
    </form>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editEqLoan', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Peminjaman',
                            text: 'Pastikan Data Peminjaman Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                const result = await $wire.edit()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Peminjaman Berhasil Diubah', 'success').then(() => {
                                        $wire.redirectToIndex()
                                    })
                                } else
                                    swal.fire('Gagal', 'Data laboratory Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
