<?php

namespace App\Livewire\Pages\HandoverPracticalResult;

use Livewire\Component;

class Create extends Component
{
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


    public function render()
    {
        return view('livewire.pages.handover-practical-result.create');
    }
}
