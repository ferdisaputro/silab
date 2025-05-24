<x-container x-data="createHandOver">
    <div>
        <x-modals.modal max_width="max-w-xl" identifier="createPracticumResultState">
            <livewire:pages.handover-practical-result.table-practicum-result :laboratoryId=$laboratoryId lazy>
        </x-modals.modal>
    </div>
    <form x-on:submit.prevent="submitHandler">
        {{-- @dump($errors->all()) --}}
        {{-- @dump($selectedLecturer) --}}
        <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
            <x-text.page-title>
                Buat Serah Terima Hasil & Sisa Praktikum
            </x-text.page-title>

            <div class="space-y-6">
                <x-alerts.outline message="Data Petugas" />
                <div class="grid grid-cols-1 gap-4 px-5 place-materialItems-center md:grid-cols-2">
                    <x-forms.select-advanced
                        model="selectedStudyProgram"
                        class="w-full"
                        name="selectedStudyProgram"
                        label="Pilih Program Studi">
                            @foreach ($this->studyPrograms as $studyProgram)
                            <option value="{{ $studyProgram->id }}" {{ $studyProgram->id == $selectedStudyProgram? "selected" : "" }}>
                                {{ $studyProgram->study_program }} </option>
                            @endforeach
                    </x-forms.select-advanced>
                    <div class="flex w-full gap-4">
                        <x-forms.select-advanced
                            wire:key="{{ now() }}"
                            model="selectedAcademicYear"
                            class="w-full"
                            name="selectedAcademicYear"
                            label="Pilih Tahun Ajaran">
                                @foreach ($this->academicYears as $academicYear)
                                <option value="{{ $academicYear->id }}" {{ $academicYear->id == $selectedAcademicYear? "selected" : "" }}>
                                    {{ $academicYear->start_year }} / {{ $academicYear->end_year }} ({{ $academicYear->is_even? "Genap" : "Ganjil" }})</option>
                                @endforeach
                        </x-forms.select-advanced>
                        <x-forms.select-advanced
                            wire:key="{{ now() }}"
                            model="selectedSemester"
                            class="w-full"
                            name="selectedSemester"
                            label="Pilih Semester">
                            @foreach ($this->semesters as $semester )
                            <option value="{{ $semester->id }}" {{ $semester->id == $selectedSemester? "selected" : "" }}>
                                {{ $semester->semester }}</option>
                            @endforeach
                        </x-forms.select-advanced>
                    </div>

                    <x-forms.select-advanced
                        wire:key="{{ now() }}"
                        model="selectedCourse"
                        class="w-full"
                        name="selectedCourse"
                        label="Pilih Mata Kuliah">
                        @foreach ($this->courses as $course)
                            <option value="{{ $course->id }}" {{ $course->id == $selectedCourse? "selected" : "" }}>
                                {{ $course->course }}
                            </option>
                        @endforeach
                    </x-forms.select-advanced>
                    <x-forms.select-advanced
                        wire:key="{{ now() }}"
                        model="selectedLecturer"
                        class="w-full"
                        name="selectedLecturer"
                        label="Pilih Dosen">
                            @foreach ($this->lectures as $lecture)
                                <option value="{{ $lecture->id }}" {{ $lecture->id == $selectedLecturer? "selected" : "" }}>
                                    {{ $lecture->user->name }}
                                </option>
                            @endforeach
                    </x-forms.select-advanced>

                    <div class="w-full md:col-span-2">
                        <div class="flex justify-center gap-4 m-auto md:max-w-xl">
                            <x-forms.select-advanced
                                wire:key="{{ now() }}"
                                model="selectedAcademicWeek"
                                class="flex-1"
                                name="selectedAcademicWeek"
                                label="Pilih Minggu">
                                @foreach ($this->academicWeeks as $academicWeek )
                                    <option value="{{ $academicWeek->id }}" {{ $academicWeek->id == $selectedAcademicWeek? "selected" : "" }}>
                                        {{ $academicWeek->week_number }}
                                    </option>
                                @endforeach
                            </x-forms.select-advanced>
                            <x-forms.input
                                wire:model.blur="handOverDate"
                                name="handOverDate"
                                value="{{ date('d/m/Y', strtotime(now())) }}"
                                wire:init="handOverDate = '{{ date('d/m/Y', strtotime(now())) }}'"
                                class="flex-1" label="tanggal" datepicker />
                        </div>
                    </div>

                    <div class="w-full md:col-span-2">
                        <div class="m-auto md:max-w-xl">
                            <x-forms.textarea
                                name="acara_praktek"
                                label="Acara Praktek"
                                wire:model.live.debounce="practicumEvent">
                            </x-forms.textarea>
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
                                class="flex-1 min-w-24"
                                wire:model.live.change='materialItems.{{ $index }}.material'
                                name="materialItems.{{ $index }}.material"
                                label="Pilih Bahan">
                                    @foreach ($labMaterials as $LabMaterial)
                                        <option
                                            value="{{ $LabMaterial->id }}" {{ collect($materialItems)->firstWhere('material', $LabMaterial->id)? "disabled" : '' }}>
                                            {{ $LabMaterial->item->item_name }}
                                        </option>
                                    @endforeach
                            </x-forms.select>

                            <div
                            wire:key='{{ $materialItems[$index]['material'] }}'
                            {{-- wire:init="ddData" --}}
                            wire:init="set('materialItems.{{ $index }}.unit', '{{ $labMaterials->find($materialItems[$index]['material']) ?
                                            $labMaterials->find($materialItems[$index]['material'])->item->unit_id : '' }}')"
                            >
                            <x-forms.input
                                class="flex-1 min-w-24 md:max-w-60"
                                {{-- wire:model="materialItems.{{ $index }}.satuan" --}}
                                value="{{ $labMaterials->find($materialItems[$index]['material']) ?
                                            $labMaterials->find($materialItems[$index]['material'])->item->unit->satuan : '' }}"
                                label="satuan"
                                disabled="true"
                                />
                        </div>

                            <x-forms.input
                                class="flex-1 max-w-40"
                                wire:model.live.debounce='materialItems.{{ $index }}.qty'
                                name="materialItems.{{ $index }}.qty" label="Sisa"
                                type="number"/>
                                {{-- <x-forms.input
                                class="flex-1 min-w-24 md:max-w-60"
                                wire:key='{{ $materialItems[$index]['item']?? now() }}'
                                wire:init="set('materialItems.{{ $index }}.satuan',{{
                                    $LabMaterials->find($materialItems[$index]['material'])?
                                    $LabMaterials->find($materialItems[$index]['material'])->item->unit->satuan : ''}})"
                                name="materialItems.{{ $index }}.satuan"
                                label="Satuan"
                                readonly/> --}}

                                {{-- <x-forms.input
                                    class="flex-1 min-w-24 md:max-w-60"
                                    wire:model="materialItems.{{ $index }}.satuan"
                                    name="materialItems.{{ $index }}.satuan"
                                    label="Satuan"
                                    readonly/> --}}



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
                                class="flex-1 min-w-24"
                                wire:model='practicumResults.{{ $index }}.pracRes'
                                name="practicumResults.{{ $index }}.pracRes"
                                label="Pilih Barang">
                                    @foreach ($labPracticums as $LabPracticum)
                                        <option value="{{ $LabPracticum->id }}" {{ collect($practicumResults)->firstWhere('pracRes', $LabPracticum->id)? "disabled" : '' }}>
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
                <x-buttons.fill type="submit" title="Tambah Data" class="ms-5 min-w-xs">Tambah Data</x-buttons.fill>
            </div>
        </div>
    </form>
</x-container>
@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createHandOver', () => {
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
                                const result = await $wire.create()
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
