<?php

namespace App\Livewire\Pages\Item;

use Livewire\Component;

class Create extends Component
{
    public $unitItems = [
        [
            'satuan' => '',
            'quantity' => 0,
        ]
    ];

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
        return view('livewire.pages.item.create');
    }
}
