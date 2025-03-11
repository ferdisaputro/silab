<?php

namespace App\Livewire\Pages\Permission;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $permission;
    public $id;

    #[Validate('required|min:3')]
    public $editPermissionName;

    #[On('initEditPermission')]
    public function initEditPermission($key) {
        try {
            $this->id = Crypt::decrypt($key);
        } catch (DecryptException $de) {
            echo "<script>alert('Failed to decrypt key');</script>";
        }

        try {
            if ($this->id) {
                $permission = Permission::findOrFail($this->id);
                $this->editPermissionName = $permission->name;
            }
        } catch (DecryptException $de) {
            echo "<script>alert('Failed to receive data');</script>";
        }
    }

    public function edit() {
        $this->validate();
        try {
            $permission = Permission::findOrFail($this->id);
            $permission->name = $this->editPermissionName;
            if ($permission->isDirty('name')) {
                $permission->update();
                return response()->json(['status' => 'success', 'message' => 'Data Permission Berhasil Diubah']);
            }
            return response()->json(['status' => 'info', 'message' => 'Tidak Ada Perubahan Data']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'permission-edit');
    }

    public function render()
    {
        return view('livewire.pages.permission.edit');
    }
}
