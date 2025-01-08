<x-container x-data="Object.assign(selectCourse(), selectLecturer())">
    <div>
        <x-modals.modal identifier="selectCourseState" max_width="max-w-3xl">
            <livewire:pages.course-instructor.course-table />
        </x-modals.modal>

        <x-modals.modal identifier="selectLecturerState" max_width="max-w-3xl">
            <livewire:pages.course-instructor.lecturer-table />
        </x-modals.modal>
    </div>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Pengaturan Dosen Pengampu Matakuliah
            </x-text.page-title>
        </div>
        <div class="space-y-5">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <x-forms.select-advanced wire:key='{{ now() }}' class="flex-1" model="departmentId" name="departmentId" label="Pilih Jurusan" wire:key='{{ now() }}'>
                    @foreach ($this->departments as $department)
                        <option value="{{ $department->id }}" {{ $department->id == $departmentId ? 'selected' : '' }}>{{ $department->department }}</option>
                    @endforeach
                </x-forms.select-advanced>

                <x-forms.select-advanced wire:key='{{ now() }}' class="flex-1" model="studyProgramId" name="studyProgramId" label="Pilih Progran Studi" wire:key='{{ now() }}'>
                    @foreach ($this->studyPrograms as $studyProgram)
                        <option value="{{ $studyProgram->id }}" {{ $studyProgram->id == $studyProgramId ? 'selected' : '' }}>{{ $studyProgram->study_program }}</option>
                    @endforeach
                </x-forms.select-advanced>

                <x-forms.select-advanced wire:key='{{ now() }}' class="flex-1" model="academicYearId" name="academicYearId" label="Pilih Tahun Ajaran" wire:key='{{ now() }}'>
                    @foreach ($this->academicYears as $academicYear)
                        <option value="{{ $academicYear->id }}" {{ $academicYear->id == $academicYearId ? 'selected' : '' }}>{{ $academicYear->start_year }} / {{ $academicYear->end_year }} ({{ $academicYear->is_even? "Genap" : "Ganjil" }})</option>
                    @endforeach
                </x-forms.select-advanced>

                <x-forms.select-advanced wire:key='{{ now() }}' class="flex-1" model="semesterId" name="semesterId" label="Pilih Semester" wire:key='{{ now() }}'>
                    @foreach ($this->semesters as $semester)
                        <option value="{{ $semester->id }}" {{ $semester->id == $semesterId ? 'selected' : '' }}>{{ $semester->semester }}</option>
                    @endforeach
                </x-forms.select-advanced>

                <div class="col-span-2">
                    <x-tables.datatable wire:key='{{ now() }}'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mata Kuliah</th>
                                <th>Pilih Dosen Pengampu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->semesterCourses as $semesterCourse)
                                <tr wire:key='{{ $loop->iteration }}'>
                                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</td>
                                    <td>{{ $semesterCourse->course->course }}</td>
                                    <td>{{ "form Select" }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-tables.datatable>
                </div>

                <div class="text-center md:col-span-2">
                    <x-buttons.fill type="submit" class="w-full md:max-w-xs">Tambah</x-buttons.fill>
                </div>
            </div>
        </div>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('selectCourse', () => {
                return {
                    selectCourseState: false,
                    showSelectCourse (id) {
                        // $wire.dispatch('initSelectCourse', {id: id});
                        this.selectCourseState = true;
                    }
                }
            })

            Alpine.data('selectLecturer', () => {
                return {
                    selectLecturerState: false,
                    showSelectLecturer (id) {
                        // $wire.dispatch('initSelectLecturer', {id: id});
                        this.selectLecturerState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce
