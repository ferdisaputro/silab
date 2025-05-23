<x-container>
    <form x-on:submit.prevent="submitHandler" x-data="pracMatEdit()">
    <div class="p-5 space-y-7 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Laporan Kesiapan Bahan Praktikum
            </x-text.page-title>
        </div>

        <div class="space-y-5">
            <x-alerts.outline class="mb-5" message="Informasi Praktek" />
            <div class="space-y-4">
                <div class="flex gap-4">
                    <x-forms.select-advanced
                        {{-- wire:model="selectedStudyProgram" --}}
                        model="selectedStudyProgram"
                        class="flex-1"
                        name="selectedStudyProgram"
                        label="Pilih Program Studi">
                        @foreach ($this->studyPrograms as $studyProgram)
                            <option value="{{ $studyProgram->id }}"
                                {{ $selectedStudyProgram == $studyProgram->id ? 'selected' : '' }}>
                                {{ $studyProgram->study_program }}
                            </option>
                        @endforeach

                    </x-forms.select-advanced>
                    <div class="flex flex-1 gap-4">
                        <x-forms.select-advanced
                            wire:key="{{ now() }}"
                            model="selectedAcademicYear"
                            class="flex-1"
                            name="selectedAcademicYear"
                            label="Pilih Tahun Ajaran">
                            @foreach ($this->academicYears as $academicYear)
                                <option value="{{ $academicYear->id }}"
                                    {{ $academicYear->id == $selectedAcademicYear ? 'selected' : '' }}>
                                    {{ $academicYear->start_year }} / {{ $academicYear->end_year }} ({{ $academicYear->is_even? "Genap" : "Ganjil" }})
                                </option>
                            @endforeach
                        </x-forms.select-advanced>

                        <x-forms.select-advanced
                            wire:key="{{ now() }}"
                            model="selectedSemester"
                            class="flex-1"
                            name="selectedSemester"
                            label="Pilih Semester">
                            @foreach ($this->semesters as $semester)
                                <option value="{{ $semester->id }}"
                                    {{ $semester->id == $selectedSemester? "selected" : "" }}>
                                    {{ $semester->semester }}
                                </option>
                            @endforeach
                        </x-forms.select-advanced>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex gap-4">
                    <x-forms.select-advanced
                        wire:key="{{ now() }}"
                        class="flex-1"
                        model="selectedCourse"
                        name="selectedCourse"
                        label="Pilih Mata Kuliah">
                        @foreach ($this->Courses as $course )
                            <option value="{{ $course->id }}" {{ $course->id == $selectedCourse? 'selected' : '' }}>
                                {{ $course->course }}
                            </option>

                        @endforeach
                    </x-forms.select-advanced>

                    <x-forms.select-advanced
                        class="flex-1"
                        model="selectedLecturer"
                        name="selectedLecturer"
                        label="Pilih Dosen">
                        @foreach ($this->lecturers as $lecturer)
                                <option value="{{ $lecturer->id }}" {{ $lecturer->id == $selectedLecturer? "selected" : "" }}>
                                    {{ $lecturer->user->name }}</option>
                            @endforeach

                    </x-forms.select-advanced>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex gap-4">
                    <x-forms.select-advanced
                        wire:key="{{ now() }}"
                        class="flex-1"
                        model="selectedAcademicWeek"
                        name="selectedAcademicWeek"
                        label="Pilih Minggu">
                        @foreach ($this->academicWeeks as $academicWeek)
                            <option value="{{ $academicWeek->id }}" {{ $academicWeek->id == $selectedAcademicWeek? "selected" : "" }}>
                                {{ $academicWeek->week_number}}
                            </option>
                        @endforeach
                    </x-forms.select-advanced>

                    <x-forms.input
                        wire:model.live.debounce="borrowingDate"
                        value="{{ $this->borrowingDate }}"
                        wire:init="borrowingDate = '{{ date('d/m/Y', strtotime(now())) }}'"
                        class="flex-1" name="borrowingDate" label="Tanggal Peminjaman" datepicker />
                        {{-- @dump($recomendations) --}}
                        <x-forms.select
                        wire:model.live.debounce='recomendations'
                        class="flex-1"
                        name="recomendations"
                        label="Rekomendasi Dosen">
                        @php
                            $recommendationTexts = [
                                1 => "Siapkan dan Lanjutkan",
                                2 => "Dimodifikasi",
                                3 => "Diganti Acara Praktek yang Lain",
                                4 => "Ditunda"
                            ];
                        @endphp
                        @foreach ($recommendationTexts as $key => $text)
                            <option value="{{ $key }}" {{ $key == $recomendations? "selected": "" }}>{{ $text }}</option>
                        @endforeach
                    </x-forms.select>

                </div>
            </div>
        </div>

        <div class="space-y-5">
            <x-alerts.outline class="mb-5" color='teal' message="Berdasarkan hasil uji coba alat/mesin dan kesiapan bahan praktek dapat dilaporkan sebagai berikut :" />
            <div class="space-y-4">
                @foreach ($selectedItems as $index => $item)
                <div>
                    <div class="flex flex-row flex-wrap gap-4 mt-2">
                        <div class="flex flex-[1.3] gap-4">
                            {{-- @if (!empty($item['is_new'])) --}}
                            <x-forms.select
                                :disabled="!isset($item['is_new'])? true : false"
                                class="flex-1 min-w-24"
                                wire:model.live='selectedItems.{{ $index }}.item'
                                name="selectedItems.{{ $index }}.item"
                                label="Pilih alat dan Bahan"
                            >
                                @foreach ($this->LabItems as $labItem)
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
                                        isset($item['is_new'])?
                                            ($pracMatUpdate->laboratory->labItems->find($selectedItems[$index]['item'])?
                                                $pracMatUpdate->laboratory->labItems->find($selectedItems[$index]['item'])->stock : '0')
                                        : ($pracMatUpdate->pracMacs->firstWhere('lab_item_id', $selectedItems[$index]['item'])?
                                            $pracMatUpdate->pracMacs->firstWhere('lab_item_id', $selectedItems[$index]['item'])->stockCard->stock : '0')

                                    }})"
                                >
                                    <x-forms.input
                                    class="flex-1 md:flex-none md:max-w-20"
                                    wire:model='selectedItems.{{ $index }}.stock'
                                    label="Stok"
                                    disabled/>
                                </div>
                                <x-forms.input
                                    type="number"
                                    class="flex-1 md:flex-none md:max-w-20"
                                    max="{{ isset($selectedItems[$index]['stock'])? (String) $selectedItems[$index]['stock'] : '' }}"
                                    wire:model.live.debounce='selectedItems.{{ $index }}.qty'
                                    name="selectedItems.{{ $index }}.qty"
                                    label="jumlah" />
                            </div>
                        </div>

                        <div class="flex flex-1 gap-4">
                            <x-forms.input
                                class="flex-1 min-w-24"
                                wire:model.live.debounce='selectedItems.{{ $index }}.description'
                                name="selectedItems.{{ $index }}.description"
                                label="Keterangan" />

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
            Alpine.data('pracMatEdit', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Edit Kesiapan Bahan',
                            text: 'Apakah Data Kesiapan Bahan Praktikum Sudah Benar?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                const result = await $wire.edit()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Kesiapan Berhasil Dibuat', 'success').then(() => {
                                        $wire.redirectToIndex()
                                    })
                                } else
                                    swal.fire('Gagal', 'Data Kesiapan Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
