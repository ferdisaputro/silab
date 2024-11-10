<?php

namespace App\Livewire\Pages\Unit;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $id;
    public $prev_url;
    public $satuanData;

    public function submitHandle() {
        dump($this->id);
    }

    #[On('initEditUnit')]
    public function initEdit($id) {
        $this->prev_url = url()->previous();
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
            $this->satuanData = ['name' => "value-$this->id"];
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.pages.unit.edit');
    }
}
