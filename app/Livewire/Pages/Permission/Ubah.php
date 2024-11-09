<?php

namespace App\Livewire\Pages\Permission;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Crypt;

class Ubah extends Component
{
    public $id;
    public $permission = ['name' => ''];

    public function submitHandle() {
        dump($this->id);
    }

    #[On('initUpdate')]
    public function initUpdate($id) {
        $this->id = Crypt::decrypt($id);
    }

    public function render()
    {
        return view('livewire.pages.permission.ubah');
    }
}
