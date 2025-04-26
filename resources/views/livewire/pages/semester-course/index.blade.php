<x-container x-data="course()" x-effect="courseStateChange()">
    <div wire:ignore>
        <x-modals.modal max_width="max-w-4xl" identifier="addCourseState">
            <table id="course-semester-table">
                <thead>
                    <tr>
                        <th>#</i></th>
                        <th>Kode Matkul</i></th>
                        <th>Nama Matkul</i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr class="cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</td>
                            <td>{{ $course->code }}</td>
                            <td>{{ $course->course }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-modals.modal>
    </div>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Data Mata Kuliah Semester
            </x-text.page-title>
        </div>
        <form x-on:submit.prevent="submitHandler">
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
                <!-- @dump($this->studyPrograms) -->
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

                <!-- <hr> -->
                
                <div class="flex flex-col gap-4">
                    <hr>
                    <x-forms.input wire:model.live.debounce='totalGroup' name="totalGroup" label="Jumlah Golongan" type="number" class="flex-1" />
                </div>
                <div>
                    <div class="text-right">
                        <x-buttons.outline class="mt-5 mb-5" color="purple" x-on:click="addCourseState = true">Pilih Data Mata Kuliah</x-buttons.outline>
                    </div>
                    <x-tables.datatable>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Matkul</th>
                                <th>Nama Matkul</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->selectedCoursesList as $index => $course)
                                <tr wire:key='{{ $loop->iteration }}'>
                                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</td>
                                    <td>{{ $course->code }}</td>
                                    <td>{{ $course->course }}</td>
                                    <td>
                                        @if ($course->is_active)
                                            <x-badges.fill color="blue" class="px-2.5 py-1.5">Aktif</x-badges.fill>
                                        @else
                                            <x-badges.fill color="yellow" class="px-2.5 py-1.5">Non Aktif</x-badges.fill>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-tables.datatable>
                </div>
                @if ($this->selectedCoursesList->count())
                    <div class="text-center">
                        <x-buttons.fill type="submit" class="w-full max-w-xs">Tambah</x-buttons.fill>
                    </div>
                @endif
            </div>
        </form>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('course', () => {
                return {
                    addCourseState: false,
                    courseStateChange() {
                        if (!this.addCourseState) {
                            const selectedCourse = window.table.data.data.filter((row) => {
                                return row.selected
                            }).map((selectedRow) => {
                                return selectedRow.cells[1].data[0].data //get data based on first table column
                            })

                            $wire.dispatch('setSelectedCourses', {
                                courses: selectedCourse
                            }); // this is dispatching function from this page class (pages/semester-courses/index)
                        }
                    },
                    submitHandler() {
                        swal.fire({
                            title: 'Buat Mata Kuliah Semester Baru?',
                            text: 'Pastikan Data Mata Kuliah Semester Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create()
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

            if (document.getElementById("course-semester-table") && typeof DataTable !== 'undefined') {
                let multiSelect = true;
                let rowNavigation = false;

                const resetTable = function() {
                    if (window.table) {
                        window.table.destroy();
                    }

                    const options = {
                        rowRender: (row, tr, _index) => {
                            if (!tr.attributes) {
                                tr.attributes = {};
                            }
                            if (!tr.attributes.class) {
                                tr.attributes.class = "";
                            }
                            if (row.selected) {
                                tr.attributes.class += " selected";
                            } else {
                                tr.attributes.class = tr.attributes.class.replace(" selected", "");
                            }
                            return tr;
                        },
                        perPage: 9999999
                    };
                    if (rowNavigation) {
                        options.rowNavigation = true;
                        options.tabIndex = 1;
                    }

                    window.table = new DataTable("#course-semester-table", options);

                    // Mark all rows as unselected
                    window.table.data.data.forEach(data => {
                        data.selected = false;
                    });

                    window.table.on("datatable.selectrow", (rowIndex, event) => {
                        event.preventDefault();
                        const row = window.table.data.data[rowIndex];
                        if (row.selected) {
                            row.selected = false;
                        } else {
                            if (!multiSelect) {
                                window.table.data.data.forEach(data => {
                                    data.selected = false;
                                });
                            }
                            row.selected = true;
                        }
                        window.table.update();
                    });
                };

                // Row navigation makes no sense on mobile, so we deactivate it and hide the checkbox.
                const isMobile = window.matchMedia("(any-pointer:coarse)").matches;
                if (isMobile) {
                    rowNavigation = false;
                }

                resetTable();
            }
        </script>
    @endscript
@endPushOnce
