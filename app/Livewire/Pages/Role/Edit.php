<?php

namespace App\Livewire\Pages\Role;

use Livewire\Component;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $prev_url;

    #[Locked]
    public $id;
    #[Validate('required')]
    public $role;
    #[Validate('min:1', message: 'Please select at least one permission')]
    public $selectedPermissions = [];

    public function edit() {
        $this->validate();
        try {
            DB::beginTransaction();

            $role = Role::find($this->id);

            $role->update([
                'name' => $this->role,
            ]);

            $role->syncPermissions($this->selectedPermissions);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Role updated successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function mount($key) {
        $this->authorize('hasPermissionTo', 'role-edit');

        $this->prev_url = url()->previous();
        try {
            $id = Crypt::decrypt($key);
            $role = Role::find($id);
            $this->id = $role->id;
            $this->role = $role->name;
            $this->selectedPermissions = $role->permissions->pluck('name');
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.pages.role.edit', [
            'permissions' => Permission::all(),
        ]);
    }
}
