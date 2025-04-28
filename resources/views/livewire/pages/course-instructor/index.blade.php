<x-container>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Pengaturan Dosen Pengampu Matakuliah
            </x-text.page-title>
        </div>
        <form x-data="courseInstructor()" x-on:submit.prevent='submitHandler'>
            <div class="space-y-5">

                <div class="flex flex-col gap-4">
                    <hr>
                    <!-- Judul Pilih Jurusan -->
                    <h5 class="text-lg font-semibold text-center">Pilih Jurusan</h5>

                    <!-- Daftar Jurusan -->
                    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($this->departments as $department)
                            <li class="border border-gray-200 rounded-lg dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input
                                        id="department-radio-{{ $department->id }}"
                                        type="radio"
                                        value="{{ $department->id }}"
                                        wire:model.live="departmentId"
                                        name="departmentId"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                                            dark:focus:ring-blue-600 dark:ring-offset-gray-700
                                            dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600
                                            dark:border-gray-500"
                                    >
                                    <label for="department-radio-{{ $department->id }}"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ $department->department }}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{-- <!-- @dump($this->studyPrograms) --> --}}
                <div class="flex flex-col gap-4">
                    <hr>
                    <!-- Judul Pilih Program Studi -->
                    <h5 class="text-lg font-semibold text-center">Pilih Program Studi</h5>

                    <!-- Daftar Program Studi -->
                    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($this->studyPrograms as $studyProgram)
                            <li class="border border-gray-200 rounded-lg dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input
                                        id="studyProgram-radio-{{ $studyProgram->id }}"
                                        type="radio"
                                        value="{{ $studyProgram->id }}"
                                        wire:model.live="studyProgramId"
                                        name="studyProgramId"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                                            dark:focus:ring-blue-600 dark:ring-offset-gray-700
                                            dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600
                                            dark:border-gray-500"
                                    >
                                    <label for="studyProgram-radio-{{ $studyProgram->id }}"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ $studyProgram->study_program }}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="flex flex-col gap-4">
                    <hr>
                    <!-- Judul Pilih Tahun Ajaran -->
                    <h5 class="text-lg font-semibold text-center">Pilih Tahun Ajaran</h5>

                    <!-- Daftar Tahun Ajaran -->
                    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($this->academicYears as $academicYear)
                            <li class="border border-gray-200 rounded-lg dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input
                                        id="academicYear-radio-{{ $academicYear->id }}"
                                        type="radio"
                                        value="{{ $academicYear->id }}"
                                        wire:model.live="academicYearId"
                                        name="academicYearId"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                                            dark:focus:ring-blue-600 dark:ring-offset-gray-700
                                            dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600
                                            dark:border-gray-500"
                                    >
                                    <label for="academicYear-radio-{{ $academicYear->id }}"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ $academicYear->start_year }} / {{ $academicYear->end_year }} ({{ $academicYear->is_even ? 'Genap' : 'Ganjil' }})
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="flex flex-col gap-4">
                    <hr>
                    <!-- Judul Pilih Semester -->
                    <h5 class="text-lg font-semibold text-center">Pilih Semester</h5>

                    <!-- Daftar Semester -->
                    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($this->semesters as $semester)
                            <li class="border border-gray-200 rounded-lg dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input
                                        id="semester-radio-{{ $semester->id }}"
                                        type="radio"
                                        value="{{ $semester->id }}"
                                        wire:model.live="semesterId"
                                        name="semesterId"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                                            dark:focus:ring-blue-600 dark:ring-offset-gray-700
                                            dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600
                                            dark:border-gray-500"
                                    >
                                    <label for="semester-radio-{{ $semester->id }}"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ $semester->semester }}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>


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
