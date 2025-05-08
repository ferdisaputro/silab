<x-container>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <div>
                <x-text.page-title>
                    Tabel Ijin Penggunaan LBS
                    {{-- {{$selectedLab}} --}}
                </x-text.page-title>
                <x-forms.select
                        class="mt-3 ml-2"
                        name="selectedLab"
                        label="Pilih Lab"
                        wire:model.live='selectedLab'>
                        @foreach ($this->laboratories as $lab)
                            <option value="{{ $lab->id }}" {{ $lab->id == $selectedLab? "selected" : "" }}>{{ $lab->code }} - {{ $lab->name }}</option>
                        @endforeach
                    </x-forms.select>
            </div>
            <div>
                <a href="{{ route('lbs-usage-permit.create', ['id' => Crypt::encrypt($selectedLab)]) }}" wire:navigate>
                    <x-buttons.fill title="Tambah Ijin Pengguna" color="purple">Tambah Ijin Penggunaan</x-buttons.fill>
                </a>
            </div>
        </div>

        <div>
            <x-tables.datatable :data="$this->lbsUsage" eventTarget="equipmentLoan" id="tabel-equipmentLoan">
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Nama <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Tanggal Mulai <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Tanggal Selesai <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Status <i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->lbsUsage as $lbs )
                        <tr wire:key='{{ $loop->iteration + ($this->lbsUsage->perPage() * ($this->lbsUsage->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->lbsUsage->perPage() * ($this->lbsUsage->currentPage() - 1)) }}</td>
                            <td>
                                @if ($lbs->is_staff == 1)
                                    {{ $lbs->name }}
                                @else
                                    {{ $lbs->nim }} - {{ $lbs->name }}
                                @endif
                            </td>
                            <td>{{ $lbs->start_date }}</td>
                            <td>{{ $lbs->end_date }}</td>
                            <td>
                                @if ($lbs->status == 1)
                                    belum selesai
                                @else
                                    Selesai
                                @endif
                            </td>
                            <td class="flex flex-wrap justify-center gap-2 text-center">
                                <x-badges.outline title="Print" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-print fa-lg"></i></x-badges.outline>
                                <a href="{{ route('lbs-usage-permit.edit', ['id' => Crypt::encrypt($lbs->id)]) }}" wire:navigate>
                                    <x-badges.outline title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                </a>
                                <x-badges.outline title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-tables.datatable>
        </div>
    </div>
</x-container>
