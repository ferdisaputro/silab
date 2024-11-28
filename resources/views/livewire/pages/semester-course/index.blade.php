<x-container x-data="addCourse()" x-effect="courseStateChange()">
    <div wire:ignore>
        <x-modals.modal max_width="max-w-4xl" identifier="addCourseState">
            {{-- <x-tables.datatable perPage="99999"> --}}
            <table id="course-semester-table">
                <thead>
                    <tr>
                        <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Kode Matkul<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Nama Matkul<i class="fa-solid fa-sort ms-2"></i></th>
                        {{-- <th data-sortable="false"> --}}
                            {{-- <x-forms.checkbox x-on:click="console.log($store.selectedCourse.selectedCourses)"></x-forms.checkbox> --}}
                            {{-- <x-forms.checkbox x-on:click="console.log(table.data)"></x-forms.checkbox> --}}
                        {{-- </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr class="cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $course['id'] }}</td>
                            <td>{{ $course['kode'] }}</td>
                            <td>{{ $course['name'] }}</td>
                            {{-- <td>
                                <x-forms.checkbox  class="course-checkbox" value="{{ $i }}" x-on:click="$store.selectedCourse.addRemoveCourse({{ $i }}, $event.target.checked)"></x-forms.checkbox>
                                <x-forms.checkbox  class="course-checkbox" value="{{ $course['id'] }}"
                                    x-on:click="$store.selectedCourse.addRemoveCourse({{ $course['id'] }}, $event.target.checked)"
                                    x-init="$store.selectedCourse.checkIfSelected($refs['course-{{ $course['id'] }}'])" x-ref="course-{{ $course['id'] }}"/>
                                    x-effect="$store.selectedCourse.checkIfSelected($el)"/>{{ $course['id'] }}
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- </x-tables.datatable> --}}
        </x-modals.modal>
    </div>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Data Mata Kuliah Semester
            </x-text.page-title>
        </div>
        <div class="space-y-5">
            <div class="flex flex-col gap-4 md:flex-row">
                <x-forms.select class="flex-1" name="pilih_jurusan" label="Pilih Jurusan">
                    <option value="bizd-4">Jurusan Peternakan</option>
                    <option value="bizd-7">Jurusan Manajemen Agribisnis</option>
                    <option value="89om-8">Jurusan Teknologi Informasi</option>
                    <option value="qrll-9">Jurusan Bahasa Komunikasi Dan Pariwisata</option>
                    <option value="47a3-10">Jurusan Kesehatan</option>
                    <option value="o9xz-11">Jurusan Teknik</option>
                </x-forms.select>

                <x-forms.select class="flex-1" name="pilih_prodi" label="Pilih Prodi">
                    <option value="myce-3">Manajemen Informatika (PL17.3.5.1)</option>
                    <option value="39q4-4">Teknik Komputer (PL17.3.5.2)</option>
                    <option value="uyyx-5">Teknik Informatika (PL17.3.5.3)</option>
                    <option value="t64g-8">Teknik Komputer WXIT (PL17.3.5.4)</option>
                    <option value="y5qr-9">Manajemen Informatika - Internasional (PL17.3.5.5)</option>
                    <option value="5ib5-10">Teknik Informatika - Internasional (PL17.3.5.6)</option>
                    <option value="qxsa-11">Teknik Informatika - Bondowoso (PL17.3.5.7)</option>
                    <option value="5j1f-12">Teknik Informatika - PSDKU Nganjuk (PL17.3.5.8)</option>
                    <option value="pvf7-13">Teknik Informatika - PSDKU Sidoarjo (PL17.3.5.9)</option>
                    <option value="4ynr-14">Teknik Informatika - Program Lintas Jenjang (PLJ) (PL17.3.5.10)</option>
                    <option value="bbjr-15">Bisnis Digital (PL17.3.5.11)</option>
                </x-forms.select>
            </div>
            <div class="flex flex-col gap-4 md:flex-row">
                <x-forms.select class="flex-1" name="tahun_ajaran" label="Pilih Tahun Ajaran">
                    <option value="a4bv-7">2024/2025 (Ganjil)</option>
                    <option value="ueaz-6">2022/2023 (Genap)</option>
                    <option value="od5j-5">2022/2023 (Ganjil)</option>
                    <option value="c3v1-4">2020/2021 (Genap)</option>
                    <option value="y1vd-3">2020/2021 (Ganjil)</option>
                </x-forms.select>
                <x-forms.select class="flex-1" name="semester" label="Pilih Semester">
                    <option value="qk7w-9">1 ( 2022/2023 )</option>
                    <option value="z2i5-11">3 ( 2022/2023 )</option>
                    <option value="d24r-13">5 ( 2022/2023 )</option>
                    <option value="w58q-15">7 ( 2022/2023 )</option>
                </x-forms.select>
                <x-forms.input name="jumlah_golongan" label="Jumlah Golongan" type="number" class="flex-1" />
            </div>
            <div>
                <div class="text-right">
                    <x-buttons.outline class="mt-5 mb-5" color="purple" x-on:click="addCourseState = true">Pilih Data Mata Kuliah</x-buttons.outline>
                </div>
                <form>
                    <x-tables.datatable>
                        <thead>
                            <tr>
                                <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                                <th>Kode Matkul<i class="fa-solid fa-sort ms-2"></i></th>
                                <th>Nama Matkul<i class="fa-solid fa-sort ms-2"></i></th>
                                <th>Status<i class="fa-solid fa-sort ms-2"></i></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selectedCourses as $index => $course)
                                <tr wire:key='{{ $index }}'>
                                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $index }}</td>
                                    <td>matkul-{{ $course }}</td>
                                    <td>nama matkul - {{ $course }}</td>
                                    <td>
                                        @if (mt_rand(0, 1))
                                            <x-badges.fill color="blue" class="px-2.5 py-1.5">Aktif</x-badges.fill>
                                        @else
                                            <x-badges.fill color="yellow" class="px-2.5 py-1.5">Non Aktif</x-badges.fill>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <x-badges.outline class="px-2.5 py-1.5" title="Hapus" color="yellow"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-tables.datatable>
                </form>
            </div>
            <div class="text-center">
                <x-buttons.fill type="submit" class="w-full max-w-xs">Tambah</x-buttons.fill>
            </div>
        </div>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
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

            Alpine.data('addCourse', () => {
                return {
                    addCourseState: false,
                    courseStateChange() {
                        if (!this.addCourseState) {
                            const selectedCourse = window.table.data.data.filter((row) => {
                                return row.selected
                            }).map((selectedRow) => {
                                return selectedRow.cells[0].data[0].data //get data based on first table column
                            })

                            $wire.dispatch('setSelectedCourses', {
                                courses: selectedCourse
                            }); // this is dispatching function from this page class (pages/semester-courses/index)
                        }
                    },
                }
            })
        </script>
    @endscript
@endPushOnce
