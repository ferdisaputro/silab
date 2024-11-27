<div>
    <x-tables.datatable :data="$this->users" eventTarget="employee">
        <thead>
            <tr>
                <th data-sortby="id">#</i></th>
                <th>Foto</th>
                <th data-sortby="name">Nama</i></th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                if ($employeeStatus == 'teknisi') $limit = 5;
                else $limit = 70
            @endphp
            @foreach ($this->users as $index => $user)
                <tr wire:key='{{ $loop->iteration + ($this->users->perPage() * ($this->users->currentPage() - 1)) }}'>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->users->perPage() * ($this->users->currentPage() - 1)) }}</td>
                    <td>
                        @if ($user->photo)
                            <a href="{{ $user->photo }}" target="blank">
                                <img src="{{ $user->photo }}" alt="{{ $user->photo }}" class="object-cover object-center w-20 h-20 rounded-lg">
                            </a>
                        @else
                            <img src="{{ asset('/assets/images/no-profile.jpg') }}" alt="no-profile.jpg" class="w-20 rounded-lg h-2w-20">
                        @endif
                    </td>
                    <td>{{ $user->name }}</td>
                    <td class="text-center">
                        @if (!$isSelectable)
                            <x-badges.outline class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                            <x-badges.outline class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                        @else
                        <x-badges.outline title="Tambah" class="px-2.5 py-1.5" color="blue"
                            x-on:click="
                                $wire.dispatch('addNewTechnician', {key: '{{ Crypt::encrypt($user->id) }}'}); {{-- this is dispatching function from pages/laboratory/detail --}}
                                ({{ $identifier }})? {{ $identifier }} = false : ''">
                                <i class="fa-regular fa-plus fa-lg"></i>
                            </x-badges.outline>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-tables.datatable>
</div>

