<?php

namespace App\Livewire\Pages\LbsUsagePermit;

use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $code;
    public $selectedLab;
    // public $id;
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

        // dump($this->items);
    }
    public function mount($id){
        $decrypted = Crypt::decrypt($id);
        $this->selectedLab = $decrypted;
        // $this->labMemberIdBorrow = Auth::user()->staff->id;
        $this->code = Str::random(8);
    }


    public function render()
    {
        return view('livewire.pages.lbs-usage-permit.create');
    }
}
