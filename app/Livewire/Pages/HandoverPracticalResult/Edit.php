<?php

namespace App\Livewire\Pages\HandoverPracticalResult;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Edit extends Component
{
    public $id;
    public $bahanItems = [
        [
            'bahan' => '', // bahan
            'sisa' => '', // sisa
            'satuan' => '', // tahun ajaran
        ]
    ];

    public $practicumResults = [
        [
            'hasil_praktikum' => '', // bahan
            'jumlah' => '', // sisa
        ]
    ];

    // public function addBahanItem($bahan, $sisa, $satuan) {
    public function addBahanItem() {
        $this->bahanItems[] = [
            'bahan' => '',
            'sisa' => '',
            'satuan' => '',
        ];
    }
    public function removeBahanItem($index) {
        unset($this->bahanItems[$index]);
    }

    // public function addBahanItem($bahan, $sisa, $satuan) {
    public function addPracticumResult() {
        $this->practicumResults[] = [
            'bahan' => '',
            'sisa' => '',
            'satuan' => '',
        ];
    }
    public function removePracticumResult($index) {
        unset($this->practicumResults[$index]);
    }

    public function mount($id) {
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }
    }

    public function render()
    {
        return view('livewire.pages.handover-practical-result.edit');
    }
}
