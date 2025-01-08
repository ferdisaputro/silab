<?php

namespace App\Livewire\Pages\Item;

use App\Models\Item;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $itemPerPage = 15;
    public $itemFilter = null;
    public $itemOrderBy = 'id';
    public $itemOrderByDirection = 'asc';

    // template for datatable filter
    public function updateditemFilter() {
        $this->resetPage();
    }

    #[Computed()]
    public function items() {
        return Item::where('item_name', 'like', "%$this->itemFilter%")
                    // ->orderBy($this->permissionOrderBy, $this->permissionOrderByDirection)
                    ->when($this->itemOrderBy && $this->itemOrderByDirection, function ($query) {
                        $query->orderBy($this->itemOrderBy, $this->itemOrderByDirection);
                    })
                    ->paginate($this->itemPerPage);
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

            $item = Item::find($id);
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

    public function render()
    {
        return view('livewire..pages.item.index');
    }
}
// public $showCreate = false;

    // public function setShowCreate() {
    //     $this->showCreate = true;
    // }
