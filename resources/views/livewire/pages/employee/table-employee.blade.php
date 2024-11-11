<div>
    <x-tables.datatable>
        <thead>
            <tr>
                <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                <th>Foto<i class="fa-solid fa-sort ms-2"></i></th>
                <th>Nama<i class="fa-solid fa-sort ms-2"></i></th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                if ($employeeStatus == 'teknisi') $limit = 5;
                else $limit = 70
            @endphp
            @for($i = 0; $i < $limit; $i++)
                <tr wire:key='{{ $i }}'>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                    <td>foto-{{ $i }}.png</td>
                    <td>pegawai - {{ $i }}</td>
                    <td class="text-center">
                        @if (!$isSelectable)
                            <x-badges.outline class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                            <x-badges.outline class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                        @else
                        <x-badges.outline title="Tambah" class="px-2.5 py-1.5" color="blue"
                            x-on:click="
                                $wire.dispatch('addNewTechnician', {key: '{{ Crypt::encrypt($i) }}'}); {{-- havent decided yet --}}
                                ({{ $identifier }})? {{ $identifier }} = false : ''">
                                <i class="fa-regular fa-plus fa-lg"></i>
                            </x-badges.outline>
                        @endif
                    </td>
                </tr>
            @endfor
        </tbody>
    </x-tables.datatable>
</div>
