<?php

namespace App\Livewire\Pages\DamagedLostReport;

use App\Models\ItemLossOrDamage;
use App\Models\ItemLossOrDamageDetail;
use App\Models\Laboratory;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Illuminate\Support\Str;


class Edit extends Component
{
    // public $listeners = ['initEditDamagedLostReport'];
    public $nim, $name, $group_class, $code;
    public $status = 1;
    public $borrowingDate;
    public $selectedLab;
    public $lossDamageEdit;
    public $id;
    public $availableItems = [];

    #[Computed()]
    public function labItems()
    {
        $laboratory = Laboratory::with('labItems.item')->find($this->selectedLab);

        return $laboratory ? $laboratory->labItems : collect([]);
    }

    public function edit()
{
    $this->validate([
        'nim' => 'required|string|max:20',
        'name' => 'required|string|max:100',
        'group_class' => 'required|string|max:100',
        'borrowingDate' => 'required|date',
        'items.*.jumlah' => 'required|numeric|min:1',
    ]);

    DB::beginTransaction();
    try {
        $this->lossDamageEdit->update([
            'nim' => $this->nim,
            'name' => $this->name,
            'group_class' => $this->group_class,
            'date_replace_agreement' => $this->borrowingDate,
        ]);

        foreach ($this->items as $item) {
            if (!empty($item['is_new']) && !empty($item['bahan'])) {
                ItemLossOrDamageDetail::create([
                    'code' => $this->code,
                    'status' => $this->status,
                    'item_loss_or_damage_id' => $this->lossDamageEdit->id,
                    'lab_item_id' => $item['bahan'],
                    'amount_loss_damaged' => $item['jumlah'],
                ]);
            } elseif (!empty($item['id'])) {
                $detail = ItemLossOrDamageDetail::find($item['id']);
                if ($detail) {
                    $detail->update([
                        'amount_loss_damaged' => $item['jumlah'],
                    ]);
                }
            }
        }
        $this->reset();
        DB::commit();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengubah berita acara.'
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage() // bisa diganti jadi pesan custom jika tidak ingin menampilkan error asli
        ]);
    }
}

public function resetForm()
{
    $this->reset();
}



    // public function addItem($bahan, $stok, $jumlah, $tahun_ajaran, $keterangan) {
    public function addItem() {
        $this->items[] = [
            'bahan' => '',
            'jumlah' => '',
            'is_new' => true
        ];
    }
    public $items = [
        [
            'bahan' => '', // bahan
            'jumlah' => '' // jumlah
        ]
    ];

    public function removeItem($index)
{
    // Ambil id dari item yang akan dihapus
    $item = $this->items[$index];

    // Jika item sudah ada di database (berdasarkan ID), hapus data dari database
    if (!empty($item['id'])) {
        $detail = ItemLossOrDamageDetail::find($item['id']);
        if ($detail) {
            // Hapus entri terkait di database
            $detail->delete();
        }
    }

    // Hapus item dari array
    unset($this->items[$index]);
    $this->items = array_values($this->items); // Reindex array agar tidak ada indeks kosong
}


    #[On('initEditDamagedLostReport')]
    public function initEditDamagedLostReport($id) {
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
            $this->lossDamageEdit = ItemLossOrDamage::find($decrypted)->load('LossDamageDetail','LossDamageDetail.labItem');
            $this->selectedLab = $this->lossDamageEdit->laboratory_id;
            $this->nim = $this-> lossDamageEdit->nim;
            $this->name = $this->lossDamageEdit->name;
            $this->group_class = $this->lossDamageEdit->group_class;
            $this->code = str::random(12);
            $this->items = $this->lossDamageEdit->lossDamageDetail->map(function ($detail) {
                return [
                    'id' => $detail->id,
                    'item_name' => $detail->labItem->item->item_name ?? '-',
                    'jumlah' => $detail->amount_loss_damaged,
                    'is_new' => false
                ];
            })->toArray();

            $this->borrowingDate = optional($this->lossDamageEdit)->date_replace_agreement
                ? date('Y-m-d', strtotime($this->lossDamageEdit->date_replace_agreement))
                : now()->format('Y-m-d');

        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }
    }

    public function render()
    {
        return view('livewire.pages.damaged-lost-report.edit');
    }
}
