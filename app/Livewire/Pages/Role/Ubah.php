<?php

namespace App\Livewire\Pages\Role;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Ubah extends Component
{
    public $prev_url;

    #[Computed(persist: true)]
    public function permissions() {
        return DB::table('permissions')->get();
    }

    public function mount($id) {
        $this->prev_url = url()->previous();
        try {
            $decrypted = Crypt::decrypt($id);
            dump($decrypted);
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.pages.role.ubah');
    }
}
