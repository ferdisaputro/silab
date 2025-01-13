<div>
    <x-text.page-title class="mb-5">Tambah Bahan Laboratorium </x-text.page-title>

{{-- x-data="tambahPegawai" x-on:submit.prevent="tambah" --}}
    <form x-data="createLabItem" x-on:submit.prevent="submitHandler" class="space-y-4">
        <div class="flex gap-4">
            {{-- <x-forms.input class="flex-1" name="kode_jurusan" label="Kode Jurusan" /> --}}
            <x-forms.select class="flex-1"
                name="item_id"
                label="Pilih Bahan"
                key="item_id"
                wire:model.live.debounce="item_id">
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ ucfirst($item->item_name) }}</option>
                @endforeach
            </x-forms.select>
            <x-forms.input class="w-full max-w-40"
                name="jumlah"
                label="Jumlah"
                key="jumlah"
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
            Alpine.data('createLabItem', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Tambah Bahan Baru?',
                            text: 'Pastikan Data Bahan Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Bahan Berhasil Ditambahkan', 'success')
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Item Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
