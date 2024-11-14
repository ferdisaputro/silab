<?php

namespace App\Livewire\Pages\Laboratory;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Detail extends Component
{
    public $id;
    public $newTechnicians = [
        // 'foto' => '',
        // 'nama' => '',
    ];

    public $listeners = [
        'initDetailLaboratory',
        'addNewTechnician'
    ];

    public function addNewTechnician($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            $this->newTechnicians[] = [
                'foto' => "foto-$decrypted.png",
                'nama' => "nama $decrypted",
            ];
            // dump($this->newTechnicians);
        } catch (DecryptException $e) {
            return response()->json('error');
        }
    }

    public function initDetailLaboratory($id) {
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            return response()->json('error');
        }
    }

    public function render()
    {
        return view('livewire.pages.laboratory.detail');
    }
}
