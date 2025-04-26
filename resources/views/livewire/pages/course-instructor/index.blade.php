<x-container>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Pengaturan Dosen Pengampu Matakuliah
            </x-text.page-title>
        </div>
        <form x-data="courseInstructor()" x-on:submit.prevent='submitHandler'>
            <div class="space-y-5">
                
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <x-forms.select-advanced class="flex-1" model="departmentId" name="departmentId" label="Pilih Jurusan">
                        @foreach ($this->departments as $department)
                            <option value="{{ $department->id }}" {{ $department->id == $departmentId ? 'selected' : '' }}>{{ $department->department }}</option>
                        @endforeach
                    </x-forms.select-advanced>

                    <x-forms.select-advanced wire:key='{{ $departmentId }}' class="flex-1" model="studyProgramId" name="studyProgramId" label="Pilih Progran Studi">
                        @foreach ($this->studyPrograms as $studyProgram)
                            <option value="{{ $studyProgram->id }}" {{ $studyProgram->id == $studyProgramId ? 'selected' : '' }}>{{ $studyProgram->study_program }}</option>
                        @endforeach
                    </x-forms.select-advanced>

                    <x-forms.select-advanced class="flex-1" model="academicYearId" name="academicYearId" label="Pilih Tahun Ajaran">
                        @foreach ($this->academicYears as $academicYear)
                            <option value="{{ $academicYear->id }}" {{ $academicYear->id == $academicYearId ? 'selected' : '' }}>{{ $academicYear->start_year }} / {{ $academicYear->end_year }} ({{ $academicYear->is_even? "Genap" : "Ganjil" }})</option>
                        @endforeach
                    </x-forms.select-advanced>

                    <x-forms.select-advanced wire:key='{{ $academicYearId }}' class="flex-1" model="semesterId" name="semesterId" label="Pilih Semester">
                        @foreach ($this->semesters as $semester)
                            <option value="{{ $semester->id }}" {{ $semester->id == $semesterId ? 'selected' : '' }}>{{ $semester->semester }}</option>
                        @endforeach
                    </x-forms.select-advanced>

                    <div class="col-span-2">
                        <x-tables.datatable>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mata Kuliah</th>
                                    <th>Pilih Dosen Pengampu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->semesterCourses as $index => $semesterCourse)
                                    <tr wire:key='{{ $semesterCourse->course->id }}' wire:init="set('semesterCoursesList', [])">
                                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $semesterCourse->course->id }}</td>
                                        <td>
                                            <input wire:key='{{ $semesterCourse->course->id }}' type="hidden" wire:init="set('semesterCoursesList.{{ $semesterCourse->course->id }}.course_id', {{ $semesterCourse->course->id }})">
                                            {{ $semesterCourse->course->course }}
                                        </td>
                                        <td>
                                            <x-forms.select-advanced
                                                wire:key="{{ $this->semesterCoursesList[$semesterCourse->course_id]['lecturer_id']?? '' }}"
                                                wire:init="set('semesterCoursesList.{{ $semesterCourse->course->id }}.lecturer_id', {{ $semesterCourse->courseInstructor->staff_id?? null }})"
                                                model="semesterCoursesList.{{ $semesterCourse->course->id }}.lecturer_id"
                                                name="semesterCoursesList.{{ $semesterCourse->course->id }}.lecturer_id"
                                                label="Pilih Dosen Pengampu"
                                                withRefresh="false"
                                                {{-- wire:init="set('semesterCoursesList.{{ $semesterCourse->staff_id }}.course_id', {{ $semesterCourse->staff_id }})" --}}
                                            >
                                                @foreach ($lecturers as $lecturer)
                                                    <option
                                                        value="{{ $lecturer->id {{-- this is staff id --}} }}"
                                                        {{ $lecturer->id == ($this->semesterCoursesList[$semesterCourse->course_id]['lecturer_id']?? null) ? 'selected' : '' }}
                                                    >
                                                        {{ $lecturer->user->name }}
                                                    </option>
                                                @endforeach
                                            </x-forms.select-advanced>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-tables.datatable>
                    </div>

                    <div class="text-center md:col-span-2">
                        <x-buttons.fill type="submit" class="w-full md:max-w-xs">Simpan</x-buttons.fill>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('courseInstructor', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Simpan perubahan?',
                            text: 'Simpan perubahan settingan pengaturan dosen pengampu',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.edit()
                                console.log(result);

                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', result.original.message, 'success')
                                    this.$el.closest('form').reset() // reset form
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endpushOnce
