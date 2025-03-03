<div>
    <form>
        <div class="p-5 space-y-10">
            <div class="flex items-center justify-between">
                <x-text.page-title>
                    Detail Peminjaman Alat Praktikum
                </x-text.page-title>
            </div>
    
            <div>
                <x-alerts.outline class="mb-5" color="purple" message="Informasi Peminjam" />
                <div class="px-5 space-y-5">
                    <div class="text-center">
                        @if ($this->equipmentLoan->is_staff)
                            <x-buttons.fill color="purple">Pegawai</x-buttons.fill>
                            <x-buttons.outline color="blue">Mahasiswa</x-buttons.outline>
                        @else
                            <x-buttons.outline color="purple">Pegawai</x-buttons.outline>
                            <x-buttons.fill color="blue">Mahasiswa</x-buttons.fill>
                        @endif
                    </div>
    
                    <div>
                        @if ($this->equipmentLoan->is_staff)
                            <div class="flex flex-wrap gap-4">
                                <x-forms.input disabled value="{{ $this->equipmentLoan->staffBorrower->user->name }}" class="flex-1 md:min-w-[20rem] md:max-w-lg" name="nim" label="Pegawai Peminjam" />
                                {{-- <x-forms.select-advanced disabled wire:key='{{ now() }}' class="flex-1 md:min-w-[20rem] md:max-w-lg" name="staff" label="Pilih Dosen">
                                    @foreach ($lecturers as $lecturer)
                                        <option value="{{ $lecturer->id}}" {{ $lecturer->id == $this->equipmentLoan->staff_id? "selected" : '' }}>{{ $lecturer->user->name }}</option>
                                    @endforeach
                                </x-forms.select-advanced> --}}
                            </div>
                        @else
                            <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row">
                                <x-forms.input disabled value="{{ $this->equipmentLoan->nim }}" class="flex-1 md:min-w-[20rem]" name="nim" label="NIM" />
                                <x-forms.input disabled value="{{ $this->equipmentLoan->name }}" class="flex-1 md:min-w-[20rem]" name="name" label="Nama" />
                                <x-forms.input disabled value="{{ $this->equipmentLoan->group_class }}" class="flex-1 md:min-w-[20rem]" name="groupClass" label="Golongan/Kelompok" />
                                <x-forms.select-advanced disabled class="flex-1 md:min-w-[20rem] md:max-w-lg" model="mentor" name="mentor" label="Pilih Dosen">
                                    @foreach ($lecturers as $lecturer)
                                        <option value="{{ $lecturer->id {{-- this is staff id --}} }}" {{ $lecturer->id == $this->equipmentLoan->staff_id_mentor? "selected" : '' }}>{{ $lecturer->user->name }}</option>
                                    @endforeach
                                </x-forms.select-advanced>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    
            <div>
                <x-alerts.outline class="mb-5" color="purple" message="Informasi Pengembali" />
                <div class="px-5 space-y-5">
                    <div class="text-center">
                        @if ($this->equipmentLoan->is_returner_staff)
                            <x-buttons.fill color="purple">Pegawai</x-buttons.fill>
                            <x-buttons.outline color="blue">Mahasiswa</x-buttons.outline>
                        @else
                            <x-buttons.outline color="purple">Pegawai</x-buttons.outline>
                            <x-buttons.fill color="blue">Mahasiswa</x-buttons.fill>
                        @endif
                    </div>
    
                    <div>
                        @if ($this->equipmentLoan->is_returner_staff)
                            <div class="flex flex-wrap gap-4">
                                {{-- @dd() --}}
                                <x-forms.input disabled value="{{ $this->equipmentLoan->staffReturner->user->name }}" class="flex-1 md:min-w-[20rem] md:max-w-lg" name="nim" label="Pegawai Pengembali" />
                                {{-- <x-forms.select-advanced disabled wire:key='{{ now() }}' class="flex-1 md:min-w-[20rem] md:max-w-lg" name="staff" label="Pilih Dosen">
                                    @foreach ($lecturers as $lecturer)
                                        <option value="{{ $lecturer->id}}" {{ $lecturer->id == $this->equipmentLoan->staff_id_returner? "selected" : '' }}>{{ $lecturer->user->name }}</option>
                                    @endforeach
                                </x-forms.select-advanced> --}}
                            </div>
                        @else
                            <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row">
                                <x-forms.input disabled value="{{ $this->equipmentLoan->returner_nim }}" class="flex-1 md:min-w-[20rem]" name="nim" label="NIM" />
                                <x-forms.input disabled value="{{ $this->equipmentLoan->returner_name }}" class="flex-1 md:min-w-[20rem]" name="name" label="Nama" />
                                <x-forms.input disabled value="{{ $this->equipmentLoan->returner_group_class }}" class="flex-1 md:min-w-[20rem]" name="groupClass" label="Golongan/Kelompok" />
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
                            <x-forms.input value="{{ date('d/m/Y', strtotime($this->equipmentLoan->borrowing_date)) }}" disabled class="flex-1 md:min-w-[20rem]" name="tanggal_peminjaman" label="Tanggal Peminjaman" type="datepicker" />
                            <x-forms.timepicker disabled id="borrow_time" value="{{ date('H:i', strtotime($equipmentLoan->borrowing_date)) }}"></x-forms.timepicker>
                        </div>
                        <x-forms.input value="{{ $this->equipmentLoan->memberBorrow->user->name }}" disabled class="flex-1 md:min-w-[25rem]" name="petugas_peminjaman" label="Petugas Peminjaman" />
                    </div>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <x-forms.input value="{{ date('d/m/Y', strtotime($this->equipmentLoan->return_date)) }}" disabled class="flex-1 md:min-w-[20rem]" name="tanggal_pengembalian" label="Tanggal Pengembalian" type="datepicker" />
                            <x-forms.timepicker disabled id="return_time" value="{{ date('H:i', strtotime($equipmentLoan->return_date)) }}"></x-forms.timepicker>
                        </div>
                        <x-forms.input value="{{ $this->equipmentLoan->memberReturn->user->name }}" disabled class="flex-1 md:min-w-[25rem]" name="petugas_pengembalian" label="Petugas Pengembalian" />
                    </div>
                </div>
            </div>
    
            <div class="space-y-5">
                <x-alerts.outline class="mb-5" color='teal' message="Alat yang dipinjam" />
                <div class="px-5 space-y-4">
                    @foreach ($this->equipmentLoan->loanDetails->load('labItem', 'labItem.item') as $index => $loanDetail)
                        <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                            <x-forms.input disabled value="{{ $loanDetail->labItem->item->item_name }}" class="flex-1 min-w-24" label="Barang" />
    
                            <div class="flex flex-1 gap-4 min-w-24 md:flex-none">
                                <x-forms.input disabled value="{{ $loanDetail->qty }}" class="flex-1 md:flex-none md:max-w-32" label="Jumlah" />
                                <x-forms.input disabled value="{{ $loanDetail->return_qty }}" class="flex-1 md:flex-none md:max-w-32" label="Jumlah Kembali" />
                            </div>
    
                            <x-forms.input disabled value="{{ $loanDetail->description }}" class="flex-1 min-w-24" label="Keterangan" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>    
</div>