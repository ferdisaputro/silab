<x-container>
    <form x-on:submit.prevent="submitHandler" x-data="createEqLoan()">
        <div class="p-5 space-y-10 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <x-text.page-title>
                    Tambah Peminjaman Alat Praktikum
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
                        <div class="flex flex-wrap gap-4" x-show="isStaff" x-transition>
                            <x-forms.select-advanced wire:key='{{ now() }}' class="flex-1 md:min-w-[20rem] md:max-w-lg" model="staff" name="staff" label="Pilih Pegawai">
                                @foreach ($staffs as $staffData)
                                    <option value="{{ $staffData->id {{-- this is staff id --}} }}" {{ $staffData->id == $staff? "selected" : '' }}>{{ $staffData->user->name }}</option>
                                @endforeach
                            </x-forms.select-advanced>
                        </div>

                        <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row" x-show="!isStaff" x-transition>
                            <x-forms.input wire:model.live.debounce='nim' class="flex-1 md:min-w-[20rem]" name="nim" label="NIM" />
                            <x-forms.input wire:model.live.debounce='name' class="flex-1 md:min-w-[20rem]" name="name" label="Nama" />
                            <x-forms.input wire:model.live.debounce='groupClass' class="flex-1 md:min-w-[20rem]" name="groupClass" label="Golongan/Kelompok" />
                            <x-forms.select-advanced wire:key='{{ now() }}' model="mentor" class="flex-1 md:min-w-[20rem]" name="mentor" label="Pilih Dosen Pembimbing">
                                @foreach ($lecturers as $lecturer)
                                    <option value="{{ $lecturer->id {{-- this is staff id --}} }}" {{ $lecturer->id == $mentor? "selected" : '' }}>{{ $lecturer->user->name }}</option>
                                @endforeach
                            </x-forms.select-advanced>
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
                                wire:model.live.debounce="borrowingDate"
                                value="{{ date('d/m/Y', strtotime(now())) }}"
                                wire:init="borrowingDate = '{{ date('d/m/Y', strtotime(now())) }}'"
                                class="flex-1" name="borrowingDate" label="Tanggal Peminjaman" datepicker />
                        <x-forms.timepicker wire:init="borrowingTime = '{{ date('H:i', time()) }}'" id="borrow_time" wire:model="borrowingTime"></x-forms.timepicker>
                        </div>
                        <x-forms.input
                            value="{{ Auth::user()->name }}"
                            disabled class="flex-1"
                            name="petugas_peminjaman"
                            label="Petugas Penanggung Jawab Peminjaman" />
                    </div>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <x-forms.input disabled class="flex-1" name="tangal pengembalian" label="Tanggal Pengembalian" datepicker />
                            <x-forms.timepicker id="end_time" disabled></x-forms.timepicker>
                        </div>
                        <div class="flex">
                            <x-forms.input disabled class="flex-1" name="petugas_pengembalian" label="Petugas Penanggung Jawab Pengembalian" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color='teal' message="Alat yang dipinjam" />
                <div class="px-5 space-y-5">
                    @foreach ($selectedItems as $index => $item)
                    <div>
                        <span class="text-sm">Barang {{ $index + 1 }}</span>
                        <div class="flex flex-row flex-wrap gap-4 mt-2">
                            <div class="flex flex-[1.3] gap-4">
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
                                        label="jumlah" />
                                </div>
                            </div>

                            <div class="flex flex-1 gap-4">
                                <x-forms.input class="flex-1 min-w-24" wire:model.live.debounce='selectedItems.{{ $index }}.description' name="selectedItems.{{ $index }}.description" label="Keterangan" />

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
                            title: 'Buat Peminjaman',
                            text: 'Pastikan Data Peminjaman Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                const result = await $wire.create()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Peminjaman Berhasil Dibuat', 'success').then(() => {
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
