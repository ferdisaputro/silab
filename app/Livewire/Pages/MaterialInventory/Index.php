<?php

namespace App\Livewire\Pages\MaterialInventory;

use App\Models\Item;
use App\Models\LabItem;
use App\Models\Laboratory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $labItemPerPage = 15;
    public $labItemFilter = null;
    public $labItemOrderBy = 'id';
    public $labItemOrderByDirection = 'asc';
    public $lab_id;

    // template for datatable filter
    public function updatedLabItemFilter() {
        $this->resetPage();
    }

    #[Computed()]
    public function labItems() {
        return LabItem::when($this->labItemOrderBy && $this->labItemOrderByDirection, function ($query) {
                        $query->orderBy($this->labItemOrderBy, $this->labItemOrderByDirection);
                    })
                    ->whereHas('item', function($query) {
                        $query->where('item_type_id', 2);
                    })
                    ->where('laboratory_id', $this->lab_id)
                    ->paginate($this->labItemPerPage);
    }

    #[Computed()]
    public function laboratories(){
        $laboratories = Laboratory::onlyActiveUserMember()->get();
        return $laboratories;
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

            $item = LabItem::find($id);
            $item->delete();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'item deleted successfully',
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
        $this->authorize('hasPermissionTo', 'inventaris-bahan-list|inventaris-bahan-cetak|inventaris-kartu-stok');
    }

    public function render()
    {
        if (Gate::allows('isNotALabMember', Auth::user())) {
            return view('components.not-a-lab-member-exception');
        }
        return view('livewire.pages.material-inventory.index');
    }
}
