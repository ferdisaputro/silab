<div>
    <x-tables.datatable id="tabel-study-program">
        <thead>
            <tr>
                <th># <i class="fa-solid fa-sort ms-2"></i></th>
                <th>Kode Program Study <i class="fa-solid fa-sort ms-2"></i></th>
                <th>Program Study <i class="fa-solid fa-sort ms-2"></i></th>
                <th>Kaprogram Study <i class="fa-solid fa-sort ms-2"></i></th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- only for simulation of loading data --}}
            {{-- @if ($dataCount > 0) --}}
                @for ($i = 0; $i < 50; $i++)
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                        <td>KODE-{{ $i }}</td>
                        <td>Nama Program Studi {{ $i }}</td>
                        <td>Ketua Program Studi {{ $i }}</td>
                        <td class="text-center">
                            @if (!$isSelectable)
                                <x-badges.outline x-on:click="showEditStudyProgram('{{ Crypt::encrypt($i) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                            @else
                                <x-badges.outline title="Tambah" class="px-2.5 py-1.5" color="blue"
                                    x-on:click="
                                        $wire.dispatch('addNewStudy', {key: '{{ Crypt::encrypt($i) }}'});
                                        ({{ $identifier }})? {{ $identifier }} = false : ''
                                    "><i class="fa-regular fa-plus fa-lg"></i></x-badges.outline>
                            @endif
                        </td>
                    </tr>
                @endfor
            {{-- @endif --}}
        </tbody>
    </x-tables.datatable>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('studyProgram', () => {
                return {
                    // this will add new study into department.detail
                    addNewStudy(key) {

                    }
                }
            })
        </script>
    @endscript
@endPushOnce
