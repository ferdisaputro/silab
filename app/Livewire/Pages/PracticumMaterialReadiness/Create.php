<?php

namespace App\Livewire\Pages\PracticumMaterialReadiness;

use Livewire\Component;

class Create extends Component
{
    public $test_results = [
        [
            'bahan' => '', // bahan
            'stok' => '', // stok
            'jumlah' => '', // jumlah
            'tahun_ajaran' => '', // tahun ajaran
            'keterangan' => '', // keterangan
        ]
    ];

    // public function addTestResult($bahan, $stok, $jumlah, $tahun_ajaran, $keterangan) {
    public function addTestResult() {
        $this->test_results[] = [
            'bahan' => '',
            'stok' => '',
            'jumlah' => '',
            'tahun_ajaran' => '',
            'keterangan' => '',
        ];
    }

    public function removeTestResult($index) {
        unset($this->test_results[$index]);

        dump($this->test_results);
    }

    public function render()
    {
        return view('livewire.pages.practicum-material-readiness.create');
    }
}
