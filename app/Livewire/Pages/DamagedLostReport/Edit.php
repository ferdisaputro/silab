<?php

namespace App\Livewire\Pages\DamagedLostReport;

use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $listeners = ['initEditDamagedLostReport'];

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

    public function initEditDamagedLostReport($id) {
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }
    }

    public function render()
    {
        return view('livewire.pages.damaged-lost-report.edit');
    }
}
