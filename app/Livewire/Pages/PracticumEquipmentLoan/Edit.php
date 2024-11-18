<?php

namespace App\Livewire\Pages\PracticumEquipmentLoan;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Edit extends Component
{
    public $id;
    public $type;

    public $items = [
        [
            'bahan' => '', // bahan
            'stok' => '', // stok
            'jumlah' => '', // jumlah
            'tahun_ajaran' => '', // tahun ajaran
            'keterangan' => '', // keterangan
        ]
    ];

    // public function addItem($bahan, $stok, $jumlah, $tahun_ajaran, $keterangan) {
    public function addItem() {
        $this->items[] = [
            'bahan' => '',
            'stok' => '',
            'jumlah' => '',
            'tahun_ajaran' => '',
            'keterangan' => '',
        ];
    }

    public function removeItem($index) {
        unset($this->items[$index]);
        dump($this->items);
    }
    
    public function mount($id, $type = "edit") {
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
            $this->type = $type;
        } catch (DecryptException $e) {
            return response()->json("error");
        }
    }

    public function render()
    {
        return view('livewire.pages.practicum-equipment-loan.edit');
    }
}
