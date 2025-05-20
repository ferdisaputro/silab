<?php

namespace App\Livewire\Pages\ToolInventory;

use App\Models\LabItem;
use Livewire\Component;
use App\Models\Laboratory;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Gate;

class Index extends Component
{
    use WithPagination;
    public $labToolPerPage = 15;
    public $labToolFilter = null;
    public $labToolOrderBy = 'id';
    public $labToolOrderByDirection = 'asc';
    public $lab_id;

    // template for datatable filter
    public function updatedLabToolFilter() {
        $this->resetPage();
    }

    #[Computed()]
    public function labTools() {
        return LabItem::when($this->labToolOrderBy && $this->labToolOrderByDirection, function ($query) {
                        $query->orderBy($this->labToolOrderBy, $this->labToolOrderByDirection);
                    })
                    ->whereHas('item', function($query) {
                        $query->where('item_type_id', 1);
                    })
                    ->where('laboratory_id', $this->lab_id)
                    ->paginate($this->labToolPerPage);
    }

    #[Computed()]
    public function laboratories(){
        $laboratories = Laboratory::onlyActiveUserMember()->get();
        return $laboratories;
    }

    public function delete($key) {
        $this->authorize('hasPermissionTo', 'inventaris-alat-delete');

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
        $this->authorize('hasPermissionTo', 'inventaris-alat-list|inventaris-alat-create|inventaris-alat-edit|inventaris-alat-delete');
    }

    public function render()
    {
        if (Gate::allows('isNotALabMember', Auth::user())) {
            return view('components.not-a-lab-member-exception');
        }
        return view('livewire.pages.tool-inventory.index');
    }
}
