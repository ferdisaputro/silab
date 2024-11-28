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

                <div class="flex flex-col gap-4 mt-3 md:col-span-2 md:flex-row">
                    <div class="flex flex-col justify-end flex-1 md:col-span-2">
                        <h5 class="mb-2 font-semibold ms-2">
                            Pilih Matakuliah
                        </h5>
                        <x-forms.input value="{{ $selectedCourse }}" name="matkul" label="Matakuliah" readonly="true" height="h-14">
                            <x-buttons.outline x-on:click="selectCourseState = true" color="purple" height="" class="absolute w-fit right-1.5 top-1.5 bottom-1.5">Pilih</x-buttons.outline>
                        </x-forms.input>
                    </div>
                    <div class="flex flex-col justify-end flex-1 md:col-span-2">
                        <h5 class="mb-2 font-semibold ms-2">
                            Pilih Dosen
                        </h5>
                        <x-forms.input value="{{ $selectedLecturer }}" name="dosen" label="Dosen" readonly="true" height="h-14">
                            <x-buttons.outline x-on:click="selectLecturerState = true" color="purple" height="" class="absolute w-fit right-1.5 top-1.5 bottom-1.5">Pilih</x-buttons.outline>
                        </x-forms.input>
                    </div>
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
