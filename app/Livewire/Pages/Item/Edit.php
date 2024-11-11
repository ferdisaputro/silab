<?php

namespace App\Livewire\Pages\Item;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $id;
    public $unitItems = [
        [
            'satuan' => '',
            'quantity' => 0,
        ]
    ];

    #[On('initEditItem')]
    public function initEditItem($id) {
        $this->reset();
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
            $units = ['rim', 'pcs', 'pack'];
            $unitItems = [];
            for ($i= 1; $i <= $decrypted + 1; $i++) {
                $unitItems[$i] = [
                    'satuan' => $units[mt_rand(0, 2)],
                    'quantity' => $i,
                ];
            }
            $this->unitItems = $unitItems;
            // dump($decrypted, $this->unitItems);
        } catch (DecryptException $e) {
            return response()->json('error');
        }
    }

    public function addUnitItem() {
        $this->unitItems[] = [
            'satuan' => '',
            'quantity' => 0,
        ];
    }

    public function removeUnitItem($index) {
        unset($this->unitItems[$index]);
    }

    public function resetForm() {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.item.edit');
    }
}
