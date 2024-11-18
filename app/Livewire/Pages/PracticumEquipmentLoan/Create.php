<?php

namespace App\Livewire\Pages\PracticumEquipmentLoan;

use Livewire\Component;

class Create extends Component
{
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

    public function render()
    {
        return view('livewire.pages.practicum-equipment-loan.create');
    }
}
