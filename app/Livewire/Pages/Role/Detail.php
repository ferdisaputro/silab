<?php

namespace App\Livewire\Pages\Role;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Detail extends Component
{
    public $id;

    #[Computed()]
    public function role() {
        return Role::find($this->id);
    }

    #[On('initDetailRole')]
    public function initDetailRole($key) {
        try {
            $this->id = Crypt::decrypt($key);
        } catch (DecryptException $e) {
            dd($e);
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }
    }

    public function render()
    {
        return view('livewire.pages.role.detail');
    }
}
