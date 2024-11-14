<x-container x-data="addSubject()">
    <div>
        <x-modals.modal max_width="max-w-4xl" identifier="addSubjectState">
            <x-tables.datatable>`~~
                <thead>
                    <tr>
                        <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Kode Matkul<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Nama Matkul<i class="fa-solid fa-sort ms-2"></i></th>
                        <th data-sortable="false">
                            <x-forms.checkbox></x-forms.checkbox>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 30; $i++)
                        <tr wire:key='{{ $i }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>{{ Str::random(5) }}</td>
                            <td>{{ Str::random(5) }}</td>
                            <td>
                                <x-forms.checkbox x-on:click="$store.selectedSubject.addRemoveSubject({{ $i }}, $event.target.checked)"></x-forms.checkbox>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </x-tables.datatable>
        </x-modals.modal>
    </div>
    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Data Mata Kuliah Semester
            </x-text.page-title>
        </div>
        <div class="space-y-5">
            <div class="flex flex-col gap-4 md:flex-row">Jurusan Peternakan</option>
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
                <x-forms.input name="jumlah_golongan" label="Jumlah Golongan" type="number" class="flex-1"></x-forms.input>
            </div>
            <div>
                <div class="text-right">
                    <x-buttons.fill class="mt-5 mb-5" x-on:click="addSubjectState = true">Pilih Data Mata Kuliah</x-buttons.fill>
                </div>
                <x-tables.datatable id="tabel-role">
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
                        @for ($i = 0; $i < 1; $i++)
                            <tr wire:key='{{ $i }}'>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                                <td>{{ Str::random(5) }}</td>
                                <td>{{ Str::random(5) }}</td>
                                <td>
                                    @if (mt_rand(0, 1))
                                        <x-badges.fill color="blue" class="px-2.5 py-1.5"
                                            x-on:click="changeToNonActive">Aktif</x-badges.fill>
                                    @else
                                        <x-badges.fill color="yellow" class="px-2.5 py-1.5"
                                            x-on:click="changeToActive">Non Aktif</x-badges.fill>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <x-badges.outline class="px-2.5 py-1.5" title="Hapus" color="yellow"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </x-tables.datatable>
            </div>
        </div>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('addSubject', () => {
                return {
                    addSubjectState: false
                }
            })

            Alpine.store('selectedSubject', {
                selectedSubjects: [],  // Store checked values here

                // Method to add or remove item based on checked state
                addRemoveSubject(id, isChecked) {
                    if (isChecked) {
                        this.selectedSubjects.push(id);  // Add item if checked
                    } else {
                        this.selectedSubjects = this.selectedSubjects.filter(i => i !== id);  // Remove if unchecked
                    }
                    console.log(this.selectedSubjects);
                }
            })
        </script>
    @endscript
@endPushOnce
