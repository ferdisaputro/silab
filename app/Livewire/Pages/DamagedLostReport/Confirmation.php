<?php

namespace App\Livewire\Pages\DamagedLostReport;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Confirmation extends Component
{
    public $listeners = ['initConfirmationDamagedLostReport'];

    public $id;
    public $items = [
        [
            'bahan' => '', // bahan
            'stok' => '', // stok
            'jumlah' => '', // jumlah
            'tahun_ajaran' => '', // tahun ajaran
            'keterangan' => '', // keterangan
        ]
    ];

    public function initConfirmationDamagedLostReport($id) {
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }
    }

    public function render()
    {
        return view('livewire.pages.damaged-lost-report.confirmation');
    }
}
