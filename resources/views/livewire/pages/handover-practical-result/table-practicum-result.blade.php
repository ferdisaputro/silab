<div>
    <form x-data="createPracticum" x-on:submit.prevent="submitHandler">
        <div x-data="Object.assign({itemMasterState: false})">
            <div>
                <x-modals.modal max_width="max-w-3xl" identifier="itemMasterState">
                    <livewire:pages.handover-practical-result.create-item />
                </x-modals.modal>
            </div>
            <div class="flex items-center justify-between mb-6">
                <x-text.page-title>
                    Tambah Data Hasil Praktikum
                </x-text.page-title>
                <div>
                    <x-buttons.fill x-on:click="itemMasterState = true" color="purple">Tambah Data Master</x-buttons.fill>
                </div>
            </div>
            <div class="flex flex-col flex-1 space-y-5">
                <x-alerts.outline message="Tambah Hasil Praktikum " icon="fa-caret-right" />
                <div class="space-y-4">
                    @foreach($items as $index => $item)
                        <div class="flex flex-col flex-wrap gap-4 md:flex-row" wire:key="row-{{ $index }}">
                            <x-forms.select
                                class="flex-1 w-full max-w-full"
                                wire:model.live.debounce="items.{{ $index }}.praktikum"
                                name="items.{{ $index }}.praktikum"
                                label="Pilih Hasil Praktikum"
                            >
                                @foreach($availableItems as $availableItem)
                                    <option value="{{ $availableItem->id }}" {{ collect($items)->firstWhere('praktikum', $availableItem->id)? "disabled" : '' }}>
                                        {{ $availableItem->item_name }}
                                    </option>
                                @endforeach
                            </x-forms.select>

                            <x-forms.input
                                class="flex-1 w-full max-w-28"
                                wire:model.live.debounce="items.{{ $index }}.jumlah"
                                name="items.{{ $index }}.jumlah"
                                label="Jumlah"
                                type="number"
                            />

                            <div class="flex justify-end gap-2">
                                @if(count($items) > 1)
                                    <x-buttons.outline wire:click="removeBahanItem({{ $index }})" color="yellow">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </x-buttons.outline>
                                @endif
                                @if($loop->first)
                                    <x-buttons.outline wire:click="addBahanItem" color="blue">
                                        <i class="fa-solid fa-plus"></i>
                                    </x-buttons.outline>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <x-buttons.fill
                    type="submit" class="hidden w-full md:inline-block">
                        Tambah Barang
                </x-buttons.fill>
            </div>
        </div>
    </form>
</div>
@pushOnce('scripts')
    @script
        <script>
            Alpine.data('createPracticum', () => {
                return {
                    submitHandler() {
                        swal.fire({
                            title: 'Tambah Hasil Praktikum Baru?',
                            text: 'Pastikan Data Hasil Praktikum Sudah Benar',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.create()
                                if (result.original.status == 'success') {
                                    swal.fire('Berhasil', 'Data Hasil Praktikum Berhasil Ditambahkan', 'success')
                                    // this.$el.closest('form').reset() // reset form
                                    $wire.$parent.$refresh()
                                } else
                                    swal.fire('Gagal', 'Data Hasil Praktikum Gagal Ditambahkan :'+ result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce

