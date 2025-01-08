<?php

namespace App\Livewire\Pages\Permission;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    #[Validate(rule: ['permissions.*.name' => 'required|min:3'], message: 'Permission name is required and must be at least 5 characters')]
    public $permissions = [
        ['name' => ''],
        ];

    public function updatedPermissions() {
        $this->validate();
    }

    public function addPermission() {
        $this->permissions[] = ['name' => ''];
    }

    public function removePermission($index) {
        unset($this->permissions[$index]);
    }

    public function create() {
        $this->validate();
        try {
            $permissions = array_map(function($permission) { $permission['guard_name'] = 'web'; return $permission; }, $this->permissions);
            Permission::insert($permissions);
            $this->reset();
            return response()->json(['message' => 'Izin berhasil dibuat!', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }

    public function render()
    {
        return view('livewire.pages.permission.create');
    }
}
