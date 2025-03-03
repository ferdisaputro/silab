<x-container>
    <form x-on:submit.prevent="submitHandler" x-data="createEqLoan()">
        <div class="p-5 space-y-10 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <x-text.page-title>
                    Pengembalian Peminjaman Alat Praktikum
                </x-text.page-title>
            </div>

            <div wire:init="set('isStaff', 1)" x-data="{isStaff: true, isStaffSelected: true, isStudentSelected: false}">
                <x-alerts.outline class="mb-5" color="purple" message="Informasi Pengembali" />
                <div class="px-5 space-y-5">
                    <div class="text-center">
                        <x-buttons.outline wire:click="set('isStaff', 1)" color="purple" x-show="!isStaffSelected" x-on:click="isStaff = true; isStaffSelected = true; isStudentSelected = false">Pegawai</x-buttons.outline>
                        <x-buttons.fill color="purple" x-show="isStaffSelected" x-on:click="isStaff = true; isStaffSelected = true; isStudentSelected = false">Pegawai</x-buttons.fill>

                        <x-buttons.outline wire:click="set('isStaff', 0)" color="blue" x-show="!isStudentSelected" x-on:click="isStaff = false ; isStaffSelected = false; isStudentSelected = true">Mahasiswa</x-buttons.outline>
                        <x-buttons.fill color="blue" x-show="isStudentSelected" x-on:click="isStaff = false ; isStaffSelected = false; isStudentSelected = true">Mahasiswa</x-buttons.fill>
                    </div>

                    <div>
                        <div class="flex flex-wrap gap-4" x-show="isStaff" x-transition>
                            <x-forms.select-advanced wire:key='{{ now() }}' class="flex-1 md:min-w-[20rem] md:max-w-lg" model="staffReturner" name="staffReturner" label="Pilih Pegawai">
                                @foreach ($staffs as $staffData)
                                    <option value="{{ $staffData->id {{-- this is staff id --}} }}" {{ $staffData->id == $staffReturner? "selected" : '' }}>{{ $staffData->user->name }}</option>
                                @endforeach
                            </x-forms.select-advanced>
                        </div>

                        <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row" x-show="!isStaff" x-transition>
                            <x-forms.input wire:model.live.debounce='returnerNim' class="flex-1 md:min-w-[20rem]" name="returnerNim" label="NIM" />
                            <x-forms.input wire:model.live.debounce='returnerName' class="flex-1 md:min-w-[20rem]" name="returnerName" label="Nama" />
                            <x-forms.input wire:model.live.debounce='returnerGroupClass' class="flex-1 md:min-w-[20rem]" name="returnerGroupClass" label="Golongan/Kelompok" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color="green" message="Data Petugas" />
                <div class="grid grid-cols-1 gap-4 px-5 md:grid-cols-2">
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <x-forms.input
                                value="{{ date('d/m/Y', strtotime($equipmentLoan->borrowing_date)) }}"
                                disabled
                                class="flex-1" name="borrowingDate" label="Tanggal Peminjaman" datepicker />
                            <x-forms.timepicker disabled id="borrow_time" value="{{ date('H:i', strtotime($equipmentLoan->borrowing_date)) }}"></x-forms.timepicker>
                        </div>
                        <x-forms.input value="{{ $equipmentLoan->memberBorrow->staff->user->name }}" disabled class="flex-1" name="petugas_peminjaman" label="Petugas Penanggung Jawab Peminjaman" />
                    </div>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <x-forms.input
                                wire:model.live.debounce="returnDate"
                                value="{{ date('d/m/Y', strtotime(now())) }}"
                                wire:init="returnDate = '{{ date('d/m/Y', strtotime(now())) }}'"
                                class="flex-1" name="returnDate" label="Tanggal Pengembalian" datepicker />
                            <x-forms.timepicker id="return_time" wire:init="returnTime = '{{ date('H:i', time()) }}'" wire:model='returnTime'></x-forms.timepicker>
                        </div>
                        <x-forms.input value="{{ Auth::user()->name }}" disabled class="flex-1" label="Petugas Penanggung Jawab Pengembalian" />
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color='teal' message="Alat yang dipinjam" />
                <div class="px-5 space-y-5">
                    @foreach ($equipmentLoan->loanDetails as $index => $loanDetail)
                    <div>
                        <span class="text-sm">Barang {{ $index + 1 }}</span>
                        <div class="flex flex-row flex-wrap gap-4 mt-2">
                            <div class="flex flex-[1.3] gap-4 flex-wrap">
                                <x-forms.input
                                    class="flex-1 md:min-w-32"
                                    value="{{ $loanDetail->labItem->item->item_name }}"
                                    label="Barang"
                                    disabled="true" />
                                <div class="flex flex-1 gap-4 md:flex-none">
                                    <x-forms.input
                                        value="{{ $loanDetail->qty }}"
                                        class="flex-1"
                                        label="Jumlah Pinjam"
                                        disabled="true" />
                                    <x-forms.input
                                        type="number"
                                        class="flex-1"
                                        max="{{ (String) $loanDetail->qty }}"
                                        min="0"
                                        wire:model.live.debounce='loanDetailItems.{{ $index }}.returnQty'
                                        name="loanDetailItems.{{ $index }}.returnQty"
                                        label="Jumlah Kembali" />
                                </div>
                                <x-forms.input value="{{ $loanDetail->description }}" disabled class="flex-1 min-w-24" label="Keterangan" />
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
            Alpine.data('createEqLoan', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Buat Pengembalian',
                            text: 'Pastikan Data pengembalian Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                const result = await $wire.return()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data pengembalian berhasil disimpan', 'success').then(() => {
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
