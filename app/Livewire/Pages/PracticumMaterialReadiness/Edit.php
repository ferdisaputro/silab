<?php

namespace App\Livewire\Pages\PracticumMaterialReadiness;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Edit extends Component
{
    public $id;
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

    public function mount($id) {
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.pages.practicum-material-readiness.edit');
    }
}
