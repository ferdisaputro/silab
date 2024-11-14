<?php

namespace App\Livewire\Pages\Department;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Detail extends Component
{
    public $id;
    public $prev_url;
    public $newStudies = [
        // "kode" => "KODE $decrypted",
        // "nama" => "Nama Program Studi  $decrypted",
        // "kaprodi" => "Ketua Program Studi  $decrypted",
    ];

    public $listeners = ['addNewStudy', 'initDetailDepartment' => 'initDetail'];

    // #[On('initDetailDepartment')]
    public function initDetail($id) {
        $this->prev_url = url()->previous();
        try {
            $decrypted = Crypt::decrypt($id);
            // $this->dispatch('initTabelDepartment', ['id' => $this->id]);

            $this->id = $decrypted;
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }
    }

    // #[On('addNewStudy')]
    public function addNewStudy($key) {
        try {
            $decrypted = Crypt::decrypt($key);

            $this->newStudies[] = [
                "kode" => "KODE $decrypted",
                "nama" => "Nama Program Studi  $decrypted",
                "kaprodi" => "Ketua Program Studi  $decrypted",
            ];
        } catch (DecryptException $e) {
            return response()->json('error');
        }
    }

    public function removeNewStudy($index) {
        unset($this->newStudies[$index]);
    }


    public function render()
    {
        return view('livewire.pages.department.detail');
    }
}
