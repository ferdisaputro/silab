<?php

namespace App\Livewire\Pages\Item;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

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
                    ->with('labItems')
                    ->paginate($this->itemPerPage);
    }

    public function delete($key) {
        $this->authorize('hasPermissionTo', 'barang-delete');

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

    public function mount() {
        $this->authorize('hasPermissionTo', 'barang-list|barang-create|barang-edit|barang-delete');
    }

    public function render()
    {
        return view('livewire.pages.item.index');
    }
}
