<?php

namespace App\Livewire\Pages\Role;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Index extends Component
{
    use WithPagination;

    public $id;
    // template for datatable
    public $rolePerPage = 15;
    public $roleFilter = null;
    public $roleOrderBy = 'id';
    public $roleOrderByDirection = 'asc';

    // template for datatable filter
    public function roleFilter() {
        $this->resetPage();
    }

    #[Computed()]
    public function roles() {
        return Role::where('name', 'like', "%$this->roleFilter%")
                    ->when($this->roleOrderBy && $this->roleOrderByDirection, function ($query) {
                        $query->orderBy($this->roleOrderBy, $this->roleOrderByDirection);
                    })
                    ->paginate($this->rolePerPage);
    }

    public function delete($key) {
        $id = null;
        try {
            $id = Crypt::decrypt($key);
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }

        try {
            DB::beginTransaction();

            $role = Role::find($id);
            // $role->permissions()->detach();
            $role->delete();

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
        return view('livewire.pages.role.index');
    }
}
