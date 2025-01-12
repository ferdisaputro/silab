{{-- <x-container x-data="Object.assign({createPracMatReadyState: false}, detailPracMatReady(), editPracMatReady())"> --}}
    {{-- <div>
        <x-modals.modal identifier="createPracMatReadyState" max_width="max-w-xl">
            <livewire:pages.practicum-material-readiness.create />
        </x-modals.modal>

        <x-modals.modal identifier="editPracMatReadyState" max_width="max-w-xl">
            <livewire:pages.practicum-material-readiness.edit />
        </x-modals.modal>

        <x-modals.modal identifier="detailPracMatReadyState" max_width="max-w-4xl">
            <livewire:pages.practicum-material-readiness.detail />
        </x-modals.modal>
    </div> --}}
<x-container>
    <form>
        <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <x-text.page-title>
                    Buat Penggantian Jadwal
                </x-text.page-title>
            </div>

            <div class="space-y-5">
                <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row">
                    <x-forms.select class="flex-1 md:min-w-56" name="prodi" label="Pilih Prodi">
                        @foreach ($Prodis as $prodi )
                            <option value="{{ $prodi->study_program }}">{{ $prodi->study_program }}</option>
                        @endforeach
                        {{-- @foreach ($this->schedules as $index=>$schedule )
                            <option value="{{ $schedule->id }}">{{ $schedule->head_of_study_program->studyProgram->study_program }}</option>
                        @endforeach --}}
                    </x-forms.select>
                    <x-forms.select class="flex-1 md:min-w-56" name="tahun_ajaran" label="Pilih Tahun Ajaran">
                        <option value="key1">test1</option>
                        <option value="key2">test2</option>
                        <option value="key3">test3</option>
                        <option value="key4">test4</option>
                    </x-forms.select>
                    <x-forms.select class="flex-1 md:min-w-56" name="semester" label="Pilih Semester">
                        <option value="key1">test1</option>
                        <option value="key2">test2</option>
                        <option value="key3">test3</option>
                        <option value="key4">test4</option>
                    </x-forms.select>

                    <x-forms.select class="flex-1 md:min-w-56" name="mata_kuliah" label="Pilih Mata Kuliah">
                        @foreach ($courses as $course )
                            <option value="{{ $course->course }}">{{ $course->course }}</option>
                        @endforeach
                    </x-forms.select>
                    <x-forms.select class="flex-1 md:min-w-56" name="dosen" label="Pilih Dosen">
                        @foreach ($dosens as $dosen)
                            <option value="{{ $dosen->name }}"></option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="grid flex-1 grid-cols-1 gap-4 md:grid-cols-2">
                    <x-forms.input name="jadwal_asli" label="Jadwal Asli" type="datepicker" />
                    <x-forms.input name="jadwal_pengganti" label="Jadwal Pengganti" type="datepicker" />
                </div>

                <x-forms.textarea class="min-h-32" name="acara_praktikum" label="Acara Praktikum"></x-forms.textarea>

                <div class="text-center">
                    <x-buttons.fill class="w-full max-w-xs">Buat Penggantian Jadwal</x-buttons.fill>
                </div>
            </div>
        </div>
    </form>
</x-container>


{{-- @pushOnce('scripts')
    @script
        <script>
            Alpine.data('detailPracMatReady', () => {
                return {
                    detailPracMatReadyState: false,
                    showDetailPracMatReady (id) {
                        $wire.dispatch('initDetailPracMatReady', {id: id});
                        this.detailPracMatReadyState = true;
                    }
                }
            })

            Alpine.data('editPracMatReady', () => {
                return {
                    editPracMatReadyState: false,
                    showEditPracMatReady (id) {
                        $wire.dispatch('initEditPracMatReady', {id: id});
                        this.editPracMatReadyState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce --}}
