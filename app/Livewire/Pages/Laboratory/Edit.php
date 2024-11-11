<?php

namespace App\Livewire\Pages\Laboratory;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $id;

    #[On('initEditLaboratory')]
    public function initEditLaboratory($id) {
        $this->reset();
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            return response()->json('error');
        }
    }

    public function render()
    {
        return view('livewire.pages.laboratory.edit');
    }
}
