<?php

namespace App\Livewire\Pages\Unit;

use Livewire\Component;

class Create extends Component
{
    public $satuan = [
        ['name' => ''],
    ];

    public function rules () {
        return [
            'satuan.*.name' => 'required|min:5'
        ];
    }

    public function submitHandle () {
        $this->validate();
        dump($this->satuan);
    }

    public function updatedUnit() {
        $this->validate();
    }

    public function addUnit() {
        $this->satuan[] = ['name' => ''];
    }

    public function removeUnit($index) {
        unset($this->satuan[$index]);
    }
    public function render()
    {
        return view('livewire.pages.unit.create');
    }
}
