<?php

namespace App\Livewire\Pages\PracticumMaterialReadiness;

use App\Models\Item;
use App\Models\PracticumReadiness;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $PracticumReadPerPage = 15;
    public $PracticumReadFilter = null;
    public $PracticumReadOrderBy = 'id';
    public $PracticumReadOrderByDirection = 'asc';

    // template for datatable filter
    public function updatedPracticumReadFilter() {
        $this->resetPage();
    }

    #[Computed()]
    public function practicumReads() {
        return PracticumReadiness::when($this->PracticumReadOrderBy && $this->PracticumReadOrderByDirection, function ($query) {
                        $query->orderBy($this->PracticumReadOrderBy, $this->PracticumReadOrderByDirection);
                    })
                    ->paginate($this->PracticumReadPerPage);
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
        return view('livewire.pages.practicum-material-readiness.index');
    }
}
