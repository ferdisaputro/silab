<x-container>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Pengaturan Dosen Pengampu Matakuliah
            </x-text.page-title>
        </div>
        <form x-data="courseInstructor()" x-on:submit.prevent='submitHandler'>
            <div class="space-y-5">

                <div class="space-y-8">
                <hr>
                <!-- Pilih Jurusan -->
                <section>
                    <h5 class="text-xl font-semibold text-center mb-3">Pilih Jurusan</h5>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 p-3 bg-white border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($this->departments as $department)
                            <li class="border rounded-lg p-2">
                                <label class="flex items-center space-x-2">
                                    <input
                                        type="radio"
                                        id="department-radio-{{ $department->id }}"
                                        name="departmentId"
                                        value="{{ $department->id }}"
                                        wire:model.live="departmentId"
                                        class="form-radio text-blue-600"
                                    >
                                    <span>{{ $department->department }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <!-- Pilih Program Studi -->
                <section>
                    <h5 class="text-xl font-semibold text-center mb-3">Pilih Program Studi</h5>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 p-3 bg-white border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($this->studyPrograms as $studyProgram)
                            <li class="border rounded-lg p-2">
                                <label class="flex items-center space-x-2">
                                    <input
                                        type="radio"
                                        id="studyProgram-radio-{{ $studyProgram->id }}"
                                        name="studyProgramId"
                                        value="{{ $studyProgram->id }}"
                                        wire:model.live="studyProgramId"
                                        class="form-radio text-blue-600"
                                    >
                                    <span>{{ $studyProgram->study_program }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <!-- Pilih Tahun Ajaran -->
                <section>
                    <h5 class="text-xl font-semibold text-center mb-3">Pilih Tahun Ajaran</h5>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 p-3 bg-white border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($this->academicYears as $academicYear)
                            <li class="border rounded-lg p-2">
                                <label class="flex items-center space-x-2">
                                    <input
                                        type="radio"
                                        id="academicYear-radio-{{ $academicYear->id }}"
                                        name="academicYearId"
                                        value="{{ $academicYear->id }}"
                                        wire:model.live="academicYearId"
                                        class="form-radio text-blue-600"
                                    >
                                    <span>{{ $academicYear->start_year }} / {{ $academicYear->end_year }} ({{ $academicYear->is_even ? 'Genap' : 'Ganjil' }})</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <!-- Pilih Semester -->
                <section>
                    <h5 class="text-xl font-semibold text-center mb-3">Pilih Semester</h5>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 p-3 bg-white border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($this->semesters as $semester)
                            <li class="border rounded-lg p-2">
                                <label class="flex items-center space-x-2">
                                    <input
                                        type="radio"
                                        id="semester-radio-{{ $semester->id }}"
                                        name="semesterId"
                                        value="{{ $semester->id }}"
                                        wire:model.live="semesterId"
                                        class="form-radio text-blue-600"
                                    >
                                    <span>{{ $semester->semester }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </section>



                    <section>
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
                    </section>

                    <div class="text-center md:col-span-2">
                        <x-buttons.fill type="submit" class="w-full md:max-w-xs">Simpan</x-buttons.fill>
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
