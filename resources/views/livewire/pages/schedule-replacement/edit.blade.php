<x-container>
    {{-- @dump($errors->all()) --}}
    <form x-data="editScheduleReplacement()" x-on:submit.prevent="submitHandler">
        <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <div>
                    <x-text.page-title>
                        Ubah Penggantian Jadwal (Jurusan: {{ $this->department->department }})
                    </x-text.page-title>
                    <x-forms.select
                        class="mt-3 ml-2"
                        name="selectedLaboratory"
                        label="Pilih Jurusan"
                        wire:model.live='selectedLaboratory'
                        wire:key='{{ $selectedLaboratory }}'
                        disabled
                    >
                        @foreach ($this->laboratories as $laboratory)
                            <option value="{{ $laboratory->id }}" {{ $laboratory->id == $selectedLaboratory? "selected" : "" }}>{{ $laboratory->code }} - {{ $laboratory->laboratory }} ({{ $laboratory->department->department }})</option>
                        @endforeach
                    </x-forms.select>
                </div>
            </div>

            <div class="space-y-5">
                {{-- @dump($selectedStudyProgram, $selectedAcademicYear, $selectedSemester)
                @dump($this->studyPrograms, $this->academicYears, $this->semesters, $this->courses) --}}

                <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row">
                    <x-forms.select-advanced disabled model="selectedStudyProgram" class="flex-1 md:min-w-56" name="studyProgram" label="Pilih Prodi">
                        {{-- @foreach ($this->studyPrograms as $studyProgram )
                            <option value="{{ $studyProgram->id }}" {{ $studyProgram->id == $selectedStudyProgram? "selected" : '' }}>{{ $studyProgram->study_program }}</option>
                        @endforeach --}}
                    </x-forms.select-advanced>
                    <x-forms.select-advanced disabled model="selectedAcademicYear" class="flex-1 md:min-w-56" name="tahun_ajaran" label="Pilih Tahun Ajaran">
                        {{-- @foreach ($this->academicYears as $academicYear)
                            <option value="{{ $academicYear->id }}" {{ $academicYear->id == $selectedAcademicYear? "selected" : '' }}>{{ $academicYear->start_year }} / {{ $academicYear->end_year }} ({{ $academicYear->is_even? "Genap" : "Ganjil" }})</option>
                        @endforeach --}}
                    </x-forms.select-advanced>
                    <x-forms.select-advanced disabled model="selectedSemester" class="flex-1 md:min-w-56" name="semester" label="Pilih Semester">
                        {{-- @foreach ($this->semesters as $semester)
                            <option value="{{ $semester->id }}" {{ $semester->id == $selectedSemester? "selected" : '' }}>{{ $semester->semester }}</option>
                        @endforeach --}}
                    </x-forms.select-advanced>

                    <x-forms.select-advanced disabled model="selectedCourse" class="flex-1 md:min-w-56" name="mata_kuliah" label="Pilih Mata Kuliah">
                        {{-- @foreach ($this->courses as $course )
                            <option value="{{ $course->id }}" {{ $course->id == $selectedCourse? "selected" : '' }}>{{ $course->course }}</option>
                        @endforeach --}}
                    </x-forms.select-advanced>

                    <x-forms.select-advanced model="selectedLecturer" class="flex-1 md:min-w-56" name="dosen" label="Pilih Dosen">
                        @foreach ($lecturers as $lecturer)
                            <option value="{{ $lecturer->id }}" {{ $lecturer->id == $selectedLecturer? "selected" : '' }}>{{ $lecturer->user->name }}</option>
                        @endforeach
                    </x-forms.select-advanced>
                </div>

                <div class="grid flex-1 grid-cols-1 gap-4 md:grid-cols-2">
                    <x-forms.input
                            wire:model.live.debounce="realSchedule"
                            value="{{ date('d/m/Y', strtotime(now())) }}"
                            wire:init="realSchedule = '{{ date('d/m/Y', strtotime(now())) }}'"
                            class="flex-1" value="{{ date('d/m/Y', strtotime($realSchedule)) }}" name="realSchedule" label="Tanggal Peminjaman" datepicker />
                    <x-forms.input
                            wire:model.live.debounce="replacementSchedule"
                            value="{{ date('d/m/Y', strtotime(now())) }}"
                            wire:init="replacementSchedule = '{{ date('d/m/Y', strtotime(now())) }}'"
                            class="flex-1" value="{{ date('d/m/Y', strtotime($replacementSchedule)) }}" name="replacementSchedule" label="Tanggal Peminjaman" datepicker />
                </div>

                <x-forms.textarea wire:model.live.debounce='practicumEvent' value="{{ $practicumEvent }}" class="min-h-44" name="acara_praktikum" label="Acara Praktikum"></x-forms.textarea>

                <div class="text-center">
                    <x-buttons.fill type="submit" class="w-full max-w-xs">Ubah Penggantian Jadwal</x-buttons.fill>
                </div>
            </div>
        </div>
    </form>
    {{-- @dump($laboratoryId, $this->department) --}}
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editScheduleReplacement', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Ubah Penggantian Jadwal',
                            text: 'Pastikan Data Penggantian Jadwal Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                const result = await $wire.edit()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Penggantian Jadwal Berhasil Diubah', 'success').then(() => {
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
