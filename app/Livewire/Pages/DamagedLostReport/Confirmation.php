<?php

namespace App\Livewire\Pages\DamagedLostReport;

use App\Models\ItemLossOrDamage;
use App\Models\ItemLossOrDamageDetail;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Confirmation extends Component
{
    public $listeners = ['initConfirmationDamagedLostReport'];
    public $id;
    public $lossDamageConfirmation;
    public $items = [];

    // Inisialisasi data untuk edit konfirmasi kerusakan/kehilangan
    public function initConfirmationDamagedLostReport($id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
            $this->lossDamageConfirmation = ItemLossOrDamage::find($decrypted)->load('LossDamageDetail', 'LossDamageDetail.labItem');
            $this->items = $this->lossDamageConfirmation->LossDamageDetail->map(function ($item) {
                return [
                    'id' => $item->id,
                    'status' => $item->status,
                    // jika butuh info lain, bisa tambahkan di sini
                ];
            })->toArray();
        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }
    }

    // Mengubah status item menjadi 2 (Konfirmasi Pengembalian)
    public function confirmReturnItem($index)
    {
        $damageDetail = $this->lossDamageConfirmation->LossDamageDetail[$index];

        // Mengubah status item menjadi 2
        $damageDetail->update([
            'status' => 2 // Status 2 berarti item sudah dikonfirmasi
        ]);

        $this->dispatch('success', ['message' => 'Item berhasil dikonfirmasi!']);
    }

    // Mengonfirmasi berita acara dan menyimpan perubahan status
    public function confirmReport($confirmedIndexes = [])
{
    try {
        // Update status item satu per satu
        foreach ($confirmedIndexes as $index) {
            $damageDetail = $this->lossDamageConfirmation->LossDamageDetail[$index] ?? null;
            if ($damageDetail) {
                $damageDetail->update(['status' => 2]);
            }
        }

        // Ambil ulang data terbaru dari database
        $this->lossDamageConfirmation->load('LossDamageDetail');

        // Cek apakah semua item sudah berstatus 2
        $allConfirmed = $this->lossDamageConfirmation->LossDamageDetail->every(function ($item) {
            return $item->status == 2;
        });

        // Jika semua sudah konfirmasi, update status ItemLossOrDamage
        if ($allConfirmed) {
            $this->lossDamageConfirmation->update(['status' => 2]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengubah status konfirmasi.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}



    public function render()
    {
        return view('livewire.pages.damaged-lost-report.confirmation');
    }
}
