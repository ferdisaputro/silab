<?php

namespace App\Livewire\Pages\Permission;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class Create extends Component
{
    public $permissions = [
        ['name' => ''],
    ];

    public function rules () {
        return [
            'permissions.*.name' => 'required|min:5'
        ];
    }

    public function submitHandle () {
        $this->validate();
        dump($this->permissions);
    }

    public function updatedPermissions() {
        $this->validate();
    }

    public function addPermission() {
        $this->permissions[] = ['name' => ''];
    }

    public function removePermission($index) {
        unset($this->permissions[$index]);
    }
    public function render()
    {
        return view('livewire.pages.permission.create');
    }
}
