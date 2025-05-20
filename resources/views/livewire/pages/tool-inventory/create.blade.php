<div>
    <x-text.page-title class="mb-5">Tambah Alat Laboratorium</x-text.page-title>
    <form x-data="createLabTool" x-on:submit.prevent="submitHandler" class="space-y-4">
        <div class="flex gap-4">
            {{-- <x-forms.select class="flex-1"
                name="tool_id"
                label="Pilih Alat"
                key="tool_id"
                wire:model.live.debounce="tool_id">
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ ucfirst($item->item_name) }}</option>
                @endforeach
            </x-forms.select> --}}
            <x-forms.select-advanced 
                class="flex-1 md:min-w-[20rem] md:max-w-lg" 
                model="tool_id" 
                name="tool_id" 
                label="Pilih Alat">
                @foreach ($items as $item)
                    <option value="{{ $item->id {{-- this is staff id --}} }}" {{ $item->id == $tool_id? "selected" : '' }}>{{ $item->item_name }}</option>
                @endforeach
            </x-forms.select-advanced>

            <x-forms.input class="w-full max-w-40"
                name="jumlah"
                label="Jumlah"
                wire:model.live.debounce="jumlah"/>
        </div>
        <div class="text-center">
            <x-buttons.fill type="submit" class="w-full max-w-xs">Tambah</x-buttons.fill>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createLabTool', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Tambah Alat Baru?',
                            text: 'Pastikan Data Alat Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create();
                                this.$el.closest('form').reset(); // reset form
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Alat Berhasil Ditambahkan', 'success');
                                    $wire.$parent.$refresh()
                                } else {
                                    swal.fire('Gagal', 'Data Alat Gagal Ditambahkan: ' + result.original.message, 'error');
                                }
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
