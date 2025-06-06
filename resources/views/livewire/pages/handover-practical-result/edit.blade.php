<x-container x-data="editHandOver">
    <div>
        <x-modals.modal max_width="max-w-xl" identifier="createPracticumResultState">
            <livewire:pages.handover-practical-result.table-practicum-result :laboratoryId="$laboratoryId">
        </x-modals.modal>
    </div>
    <form x-on:submit.prevent="submitHandler">
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <x-text.page-title>
            Ubah Serah Terima Hasil & Sisa Praktikum
        </x-text.page-title>

        <div class="space-y-6">
            {{-- @dump($this->semesters) --}}
            <x-alerts.outline message="Data Petugas" />
            <div class="grid grid-cols-1 gap-4 px-5 place-items-center md:grid-cols-2">
                <x-forms.select-advanced
                        {{-- wire:model="selectedStudyProgram" --}}
                    model="selectedStudyProgram"
                    class="w-full"
                    name="selectedStudyProgram"
                    label="Pilih Program Studi">
                    @foreach ($this->studyPrograms as $studyProgram)
                        <option value="{{ $studyProgram->id }}"
                            {{ $selectedStudyProgram == $studyProgram->id ? 'selected' : '' }}>
                            {{ $studyProgram->study_program }}
                        </option>
                    @endforeach
                </x-forms.select-advanced>
                <div class="flex w-full gap-4">
                    <x-forms.select-advanced
                        wire:key="{{ now() }}"
                        model="selectedAcademicYear"
                        class="w-full"
                        name="tahun_ajaran"
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
                        class="w-full"
                        name="selectedSemester"
                        label="Pilih Semester">
                        @foreach ($this->semesters as $semester)
                            <option value="{{ $semester->id }}"
                                {{ $semester->id == $selectedSemester ? 'selected' : '' }}>
                                {{ $semester->semester }}
                            </option>
                        @endforeach
                    </x-forms.select-advanced>
                </div>

                <x-forms.select-advanced
                    wire:key="{{ now() }}"
                    model="selectedCourse"
                    class="w-full"
                    name="selectedCourse"
                    label="Pilih Mata Kuliah">
                    @foreach ($this->Courses as $course)
                        <option value="{{ $course->id }}"
                            {{ $course->id == $selectedCourse ? 'selected' : '' }}>
                            {{ $course->course }}
                        </option>
                    @endforeach
                </x-forms.select-advanced>
                <x-forms.select-advanced
                    wire:key="{{ now() }}"
                    model="selectedCourseInstructor"
                    class="w-full"
                    name="selectedCourseInstructor"
                    label="Pilih Dosen">
                        {{-- @foreach ($this->lecturers as $lecture)
                            <option value="{{ $lecture }}"
                                {{ $lecture->id == $selectedLecturer ? 'selected' : '' }}>
                                {{ $lecture->user->name }}
                            </option>
                        @endforeach --}}
                        @if ($this->courseInstructor)
                            {{-- @foreach ($this->lectures as $lecture) --}}
                                {{-- <option value="{{ $lecture->id }}" {{ $lecture->id == $selectedLecturer? "selected" : "" }}> --}}
                                <option value="{{ $this->courseInstructor->id }}" {{ $this->courseInstructor->id == $selectedCourseInstructor? "selected" : "" }}>
                                    {{ $this->courseInstructor->staff->user->name }}
                                </option>
                            {{-- @endforeach --}}
                        @endif
                </x-forms.select-advanced>
                <div class="w-full md:col-span-2">
                    <div class="flex justify-between gap-6 m-auto md:max-w-2xl">
                        <x-forms.select-advanced
                            wire:key="{{ now() }}"
                            model="selectedAcademicWeek"
                            class="flex-1"
                            name="selectedAcademicWeek"
                            label="Pilih Minggu">
                                @foreach ($this->academicWeeks as $academicWeek)
                                    <option value="{{ $academicWeek->id }}"
                                        {{ $academicWeek->id == $selectedAcademicWeek ? 'selected' : '' }}>
                                        {{ $academicWeek->week_number }}
                                    </option>
                                @endforeach
                        </x-forms.select-advanced>
                        <x-forms.input
                            wire:model.live.debounce="borrowingDate"
                            value="{{ $this->borrowingDate }}"
                            wire:init="borrowingDate = '{{ date('d/m/Y', strtotime(now())) }}'"
                            class="flex-1" name="borrowingDate" label="Tanggal Peminjaman" datepicker />
                    </div>
                </div>

                <div class="w-full md:col-span-2">
                    <div class="m-auto md:max-w-xl">
                        <x-forms.textarea
                            wire:model.live="practicum_event"
                            name="acara_praktek"
                            label="Acara Praktek"></x-forms.textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <x-alerts.outline message="Bahan Sisa Praktikum" color="green"/>
            <div class="px-5 space-y-4">
                @foreach ($materialItems as $index => $item)
                    <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                        <x-forms.select
                            :disabled="!isset($item['is_material_new'])? true : false"
                            class="flex-1 min-w-24"
                            wire:model.live.debounce='materialItems.{{ $index }}.material'
                            name="materialItems.{{ $index }}.material"
                            label="Pilih Barang">
                            @foreach ($this->labMaterials as $item)
                                <option
                                    value="{{ $item->id }}"
                                    {{ $item->id == $materialItems[$index]['material']? "selected" : '' }}>
                                    {{ $item->item->item_name }}
                                </option>
                            @endforeach
                        </x-forms.select>
                        <div
                            wire:key='{{ $materialItems[$index]['material'] }}'
                            {{-- wire:init="ddData" --}}
                            wire:init="set('materialItems.{{ $index }}.unit', '{{ $this->LabMaterials->find($materialItems[$index]['material']) ?
                                            $this->LabMaterials->find($materialItems[$index]['material'])->item->unit_id : '' }}')"
                            >
                            <x-forms.input
                                class="flex-1 min-w-24 md:max-w-60"
                                {{-- wire:model="materialItems.{{ $index }}.satuan" --}}
                                value="{{ $this->LabMaterials->find($materialItems[$index]['material']) ?
                                            $this->LabMaterials->find($materialItems[$index]['material'])->item->unit->satuan : '' }}"
                                label="satuan"
                                disabled="true"
                                />
                        </div>
                                {{-- @dump($this->LabMaterials->find($materialItems[$index]['material'])) --}}

                        <x-forms.input
                            class="flex-1 max-w-40"
                            wire:model.live='materialItems.{{ $index }}.qty'
                            name="materialItems.{{ $index }}.qty"
                            label="Sisa" type="number"/>

                        <div class="flex justify-end gap-2">
                            @if (count($materialItems) > 1)
                                <x-buttons.outline wire:click='removeMaterialItem({{ $index }})' color="yellow">
                                    <i class="fa-solid fa-trash-can"></i>
                                </x-buttons.outline>
                            @endif

                            @if ($loop->iteration == 1)
                                <x-buttons.outline wire:click='addMaterialItem' color="blue">
                                    <i class="fa-solid fa-plus"></i>
                                </x-buttons.outline>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="space-y-6">
            <div>
                <x-alerts.outline message="Data Hasil Praktikum" color="purple" class="mb-3"/>
                <x-buttons.outline x-on:click="createPracticumResultState = true" title="Tambah Data Hasil Praktikum" color="purple" class="ms-5">Tambah Data Hasil Praktikum</x-buttons.outline>
            </div>

            <div class="px-5 space-y-4">
                @foreach ($practicumResults as $index => $item)
                    <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                        <x-forms.select
                                :disabled="!isset($item['is_praktikum_new'])? true : false"
                                class="flex-1 min-w-24"
                                wire:model.live.debounce='practicumResults.{{ $index }}.pracRes'
                                name="practicumResults.{{ $index }}.pracRes"
                                label="Pilih Barang">
                                    @foreach ($this->LabPracticums as $LabPracticum)
                                        <option value="{{ $LabPracticum->id }}">
                                            {{ $LabPracticum->item->item_name?? "_" }}</option>
                                    @endforeach
                            </x-forms.select>

                            <x-forms.input
                                class="flex-1 max-w-60"
                                wire:model.live.debounce='practicumResults.{{ $index }}.qty'
                                name="practicumResults.{{ $index }}.qty"
                                label="Jumlah"
                                type="number"/>

                        <div class="flex justify-end gap-2">
                            @if (count($practicumResults) > 1)
                                <x-buttons.outline wire:click='removePracticumResult({{ $index }})' color="yellow">
                                    <i class="fa-solid fa-trash-can"></i>
                                </x-buttons.outline>
                            @endif

                            @if ($loop->iteration == 1)
                                <x-buttons.outline wire:click='addPracticumResult' color="blue">
                                    <i class="fa-solid fa-plus"></i>
                                </x-buttons.outline>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="text-center">
            <x-buttons.fill type="submit" title="Tambah Data" class="ms-5 min-w-xs">Ubah Data</x-buttons.fill>
        </div>
    </div>
</form>
</x-container>
@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editHandOver', () => {
                return {
                    createPracticumResultState: false,
                    submitHandler() {
                        swal.fire({
                            title: 'Buat Serah Terima Hasil dan Sisa Praktikum ',
                            text: 'Apakah Data Sudah Benar?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                const result = await $wire.edit()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Berhasil Dibuat', 'success').then(() => {
                                        $wire.redirectToIndex()
                                    })
                                } else
                                    swal.fire('Gagal', 'Data Bahan Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
