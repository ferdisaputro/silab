<?php

namespace App\Livewire\Pages\Department;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $id;
    #[Validate('required|min:3')]
    public $kode;
    #[Validate('required|min:3')]
    public $nama;
    #[Validate('required')]
    public $kajur;

    #[On('initEditDepartment')]
    public function initEditDepartment($id) {
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
            $this->kode = "kode-".$this->id;
            $this->nama = "nama ".$this->id;
            $this->kajur = "kajur-".$this->id;
        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }
    }
    public function render()
    {
        return view('livewire.pages.department.edit');
    }
}
