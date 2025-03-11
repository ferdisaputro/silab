<?php

namespace App\Livewire\Pages\Unit;

use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Index extends Component
{
    use WithPagination;
    public $unitPerPage = 15;
    public $unitFilter = null;
    public $unitOrderBy = 'id';
    public $unitOrderByDirection = 'asc';

    // template for datatable filter
    // public function updatedFolderNameFilter() {
    //     $this->resetPage();
    // }

    #[Computed()]
    public function units() {
        return Unit::where('satuan', 'like', "%$this->unitFilter%")
                    // ->orderBy($this->folderNameOrderBy, $this->folderNameOrderByDirection)
                    ->when($this->unitOrderBy && $this->unitOrderByDirection, function ($query) {
                        $query->orderBy($this->unitOrderBy, $this->unitOrderByDirection);
                    })
                    ->paginate($this->unitPerPage);
    }

    public function delete($key){
        $this->authorize('hasPermissionTo', 'satuan-delete');

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

            $permission = Unit::find($id);
            $permission->delete();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'unit deleted successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'satuan-list|satuan-create|satuan-edit|satuan-delete');
    }

    public function render()
    {
        return view('livewire.pages.unit.index');
    }
}
