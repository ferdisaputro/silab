<div x-data="Object.assign({listEmployeeState: false}, laboratory())">
    <div>
        <x-modals.modal identifier="listEmployeeState">
            <livewire:pages.employee.table-employee isSelectable="true" employeeStatus="technician" identifier="listEmployeeState" {{-- this is the identifier to close the modal(table-employee modal) --}} />
        </x-modals.modal>
    </div>
    <div class="space-y-6">
        <div class="flex items-center justify-between mb-6">
            <x-text.page-title>
                Pengurus Lab
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="listEmployeeState = true" color="purple">Tambahkan Teknisi</x-buttons.fill>
            </div>
        </div>

        @if (count($newTechnicians) > 0)
            <div wire:key='testsadfoiuase'>
                <x-alerts.outline class="mb-4" color="blue" title="NEW!" message="Tambahan pengurus laboratorium." />
                <x-tables.datatable>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Status Kepegawaian</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($newTechnicians as $index => $newTechnician)
                            <tr wire:key='newTechnician-{{ $loop->iteration }}'>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</td>
                                <td>
                                    @if ($newTechnician->user->photo)
                                    <a href="{{ Storage::url($newTechnician->user->photo) }}" target="blank">
                                        <img src="{{ Storage::url($newTechnician->user->photo) }}" alt="{{ $newTechnician->user->photo }}" class="object-cover object-center w-20 h-20 rounded-lg">
                                    </a>
                                @else
                                    <img src="{{ asset('/assets/images/no-profile.jpg') }}" alt="no-profile.jpg" class="w-20 rounded-lg h-2w-20">
                                @endif
                                </td>
                                <td>{{ $newTechnician->user->name }}</td>
                                <td>{{ $newTechnician->staffStatus->staff_status }}</td>
                                <td class="text-center">
                                    <x-badges.outline wire:click="removeNewTechnician({{ $index }})" title="Hapus karyawan dari laboratory" class="px-2.5 py-1.5" color="green"><i class="fa-regular fa-minus fa-lg"></i></x-badges.outline>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-tables.datatable>
                <div class="text-center">
                    <x-buttons.outline color="teal" class="w-full max-w-xs" x-on:click="submitHandler">Tambah Member Baru</x-buttons.outline>
                </div>
            </div>
        @endif

        <div>
            @if (count($newTechnicians) > 0)
                <x-alerts.outline wire:key='asiouncasiejuhrfaskdjfh' class="mb-4" color="green" title="OLD!" message="Data lama pengurus laboratorium." />
            @endif
            {{-- <livewire:pages.employee.table-employee employeeStatus="teknisi"/> --}}
            <x-tables.datatable>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Status Kepegawaian</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->laboratory->members->where('is_active', 1)->sortBy('updated_at') as $member)
                        <tr wire:key='members-{{ $loop->iteration }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</td>
                            <td>
                                @if ($member->staff->user->photo)
                                    <a href="{{ Storage::url($member->staff->user->photo) }}" target="blank">
                                        <img src="{{ Storage::url($member->staff->user->photo) }}" alt="{{ $member->staff->user->photo }}" class="object-cover object-center w-20 h-20 rounded-lg">
                                    </a>
                                @else
                                    <img src="{{ asset('/assets/images/no-profile.jpg') }}" alt="no-profile.jpg" class="w-20 rounded-lg h-2w-20">
                                @endif
                            </td>
                            <td>{{ $member->staff->user->name }}</td>
                            <td>{{ $member->staff->staffStatus->staff_status }}</td>
                            <td class="text-center">
                                <x-badges.outline x-on:click="removeMember('{{ Crypt::encrypt($member->staff_id) }}', '{{ $member->staff->user->name }}', '{{ $this->laboratory->name }}')" title="Hapus karyawan dari laboratory" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-tables.datatable>
        </div>
    </div>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('laboratory', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Tambahkan Member Lab Baru?',
                            text: 'Pastikan Data Member Lab Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.edit()
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', result.original.message, result.original.status)
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Member Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    },
                    removeMember(key, labMember, department) {
                        swal.fire({
                            title: 'Remove Member Lab?',
                            text: `Remove Member Lab (${labMember}) Dari Laboratorium (${department})`,
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.removeMember(key)
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', result.original.message, result.original.status)
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Lab Member Gagal Diremove :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
