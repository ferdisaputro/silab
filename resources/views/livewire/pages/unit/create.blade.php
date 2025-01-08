<div>
    <x-text.page-title class="mb-5">Tambah Satuan</x-text.page-title>
    {{-- x-data="tambahPegawai" x-on:submit.prevent="tambah" --}}
    <form class="space-y-4" x-data="createUnit" x-on:submit.prevent="submitHandler">
        {{-- @dump($errors->all()) --}}
        @foreach ($units as $index => $unit)
            <div class="relative flex gap-3" wire:key='{{ $index }}'>
                <x-forms.input
                    wire:model.live.debounce="units.{{ $index }}.satuan"
                    name="units.{{ $index }}.satuan"
                    key="units.{{ $index }}.satuan"
                    label="Nama Satuan"
                    class="flex-1">
                </x-forms.input>
                    @if (count($units) > 1)
                        <x-badges.fill
                            wire:click='removeUnit({{ $index }})'
                            color='red'
                            class="w-10 h-10 mt-0.5"
                            title="Hapus">
                            <i class="fa-regular fa-trash-can"></i>
                        </x-badges.fill>
                    @endif
            </div>
        @endforeach
        <div wire:click='addUnit' class="relative cursor-pointer">
            <x-forms.input label="Nama Satuan" disabled="true" />
            <x-badges.fill color='gray' class="absolute px-3 top-2 right-2 bottom-2" title="Hapus">
                <i class="fa-regular fa-trash-can"></i>
            </x-badges.fill>
            <span class="absolute top-0 bottom-0 left-0 right-0 grid place-items-center">
                <i class="fa-solid fa-plus fa-lg"></i>
            </span>
        </div>
        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Tambah Satuan</x-buttons.outline>
        </div>
    </form>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createUnit', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Tambah Unit Baru?',
                            text: 'Pastikan Data Unit Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Unit Berhasil Ditambahkan', 'success')
                                    // this.$el.closest('form').reset() // reset form
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Unit Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
