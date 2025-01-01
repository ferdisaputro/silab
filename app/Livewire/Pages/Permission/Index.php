<?php

namespace App\Livewire\Pages\Permission;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    use WithPagination;
    // template for datatable
    public $permissionPerPage = 15;
    public $permissionFilter = null;
    public $permissionOrderBy = 'id';
    public $permissionOrderByDirection = 'asc';

    // template for datatable filter
    public function updatedPermissionFilter() {
        $this->resetPage();
    }

    #[Computed()]
    public function permissions() {
        return Permission::where('name', 'like', "%$this->permissionFilter%")
                    // ->orderBy($this->permissionOrderBy, $this->permissionOrderByDirection)
                    ->when($this->permissionOrderBy && $this->permissionOrderByDirection, function ($query) {
                        $query->orderBy($this->permissionOrderBy, $this->permissionOrderByDirection);
                    })
                    ->paginate($this->permissionPerPage);
    }

    public function delete($key) {
        $id = null;
        try {
            $id = Crypt::decrypt($key);
        } catch (DecryptException $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Kode Enkripsi Tidak Valid'
            ]);
        }

        try {
            DB::beginTransaction();

            $permission = Permission::find($id);
            $permission->delete();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Permission deleted successfully',
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
        return view('livewire.pages.permission.index');
    }
}
