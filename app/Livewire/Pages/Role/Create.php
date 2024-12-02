<?php

namespace App\Livewire\Pages\Role;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    #[Validate('min:1', message: 'Please select at least one permission')]
    public $selectedPermissions = [];
    #[Validate('required')]
    public $role;

    // #[Computed(persist: true)]
    // public function permissions() {
    //     return Permission::get();
    // }

    public function create() {
        $this->validate();
        try {
            DB::beginTransaction();

            $role = Role::create([
                'name' => $this->role,
            ]);

            $role->syncPermissions($this->selectedPermissions);
            DB::commit();
            $this->reset();
            return response()->json([
                'status' => 'success',
                'message' => 'Role created successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.role.create', [
            'permissions' => Permission::get()
        ]);
    }
}
