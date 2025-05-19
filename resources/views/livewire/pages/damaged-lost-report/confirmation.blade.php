<form x-on:submit.prevent="submitHandler" x-data="lossDamageConfirmation()" class="space-y-10">
    <div class="flex items-center justify-between">
        <x-text.page-title>
            Konfirmasi Berita Acara Kerusakan/Kehilangan {{ $id }}
        </x-text.page-title>
    </div>

    <div>
        <x-alerts.outline class="mb-5" color="purple" message="Saya yang bertanda tangan dibawah ini: " />
        <div class="px-5 space-y-5">
            <div class="flex flex-col flex-wrap justify-center gap-4 md:flex-row">
                <x-forms.input disabled value="{{ $this->lossDamageConfirmation->nim?? '' }}" class="flex-1 md:min-w-[20rem]" name="nim" label="NIM" />
                <x-forms.input disabled value="{{ $this->lossDamageConfirmation->name?? '' }}" class="flex-1 md:min-w-[20rem]" name="nama" label="Nama" />
                <x-forms.input disabled value="{{ $this->lossDamageConfirmation->group_class?? '' }}" class="flex-1 md:min-w-[20rem]" name="golongan_kelompok" label="Golongan/Kelompok" />
                <x-forms.input disabled value="{{ $this->lossDamageConfirmation->date_replace_agreement?? '' }}" class="flex-1 md:min-w-[20rem]" name="tanggal_penggantian" label="Tanggal Kesanggupan Mengganti" type="datepicker" />
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <x-alerts.outline class="mb-5" color="green" message="Barang yang rusak sebagai berikut: " />

        <div class="px-5 space-y-4">
            @if ($this->lossDamageConfirmation)
                @foreach ($this->lossDamageConfirmation->LossDamageDetail->load('labItem','labItem.item') as $index => $damageDetail)
                    <div class="flex flex-col flex-wrap gap-4 md:flex-row">
                        <x-forms.input disabled value="{{ $damageDetail->labItem->item->item_name }}" class="flex-1 min-w-24" label="Barang" />
                        <x-forms.input disabled value="{{ $damageDetail->amount_loss_damaged }}" class="flex-1 min-w-24" label="Keterangan" />

                            <x-buttons.outline
                                type="button"
                                title="Konfirmasi Pengembalian"
                                x-bind:class="isConfirmed({{ $index }}) ? 'bg-teal-400 text-white transition' : 'transition'"
                                x-on:click="toggleConfirm({{ $index }})">
                                Konfirmasi
                            </x-buttons.outline>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="text-center">
        <x-buttons.fill type="submit" class="w-full max-w-xs" wire:click="confirmReport">
            Konfirmasi Berita Acara
        </x-buttons.fill>
    </div>
</form>
@pushOnce('scripts')
    @script
        <script>
            Alpine.data('lossDamageConfirmation', () => ({
                confirmedIndexes: [],

                isConfirmed(index) {
                    index = Number(index); // pastikan index selalu angka
                    return this.confirmedIndexes.includes(index);
                },

                toggleConfirm(index) {
                    index = Number(index);
                    if (this.isConfirmed(index)) {
                        this.confirmedIndexes = this.confirmedIndexes.filter(i => i !== index);
                    } else {
                        this.confirmedIndexes.push(index);
                    }
                },

                async submitHandler() {
                    swal.fire({
                        title: 'Konfirmasi Berita Acara?',
                        text: 'Apakah Anda yakin ingin menyimpan data ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal',
                    }).then(async res => {
                        if (res.isConfirmed) {
                            const result = await $wire.confirmReport(this.confirmedIndexes)
                            if (result.original.status == 'success') {
                                swal.fire('Berhasil', 'Data berhasil dikonfirmasi', 'success')
                                $wire.$parent.$refresh()
                            } else {
                                swal.fire('Gagal', 'Gagal menyimpan data: ' + result.original.message, 'error')
                            }
                        }
                    });
                }
            }))
        </script>
    @endscript
@endPushOnce

