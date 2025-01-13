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
                <div class="flex flex-col gap-4 md:flex-row">
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
                </div>
                <div class="flex flex-col gap-4 md:flex-row">
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
