<?php

namespace App\Livewire\Pages\PracticumEquipmentLoan;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Detail extends Component
{
    public $listeners = ['initDetailPracticumEquipmentLoan'];
    public $prev_url;
    
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

    public function initDetailPracticumEquipmentLoan($id) {
        $this->prev_url = url()->previous();
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.pages.practicum-equipment-loan.detail');
    }
}
