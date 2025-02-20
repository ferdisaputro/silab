<?php

namespace App\Livewire\Pages\PracticumMaterialReadiness;

use App\Models\PracticumReadiness;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $PMRPerPage = 15;
    public $PMRFilter = null;
    public $PMROrderBy = 'id';
    public $PMROrderByDirection = 'asc';
    public $PMR_id;

    // template for datatable filter
    public function practicumMaterialReadinessFilter() {
        $this->resetPage();
    }


    #[Computed()]
    public function practicumMaterialReadiness() {
        return PracticumReadiness::when($this->PMROrderBy && $this->PMROrderByDirection, function ($query) {
                        $query->orderBy($this->PMROrderBy, $this->PMROrderByDirection);
                    })
                    ->with(['semesterCourse'])
                    ->paginate($this->PMRPerPage);
                    // ->orderBy($this->permissionOrderBy, $this->permissionOrderByDirection)
    }
    // where('recomendation', 'like', "%$this->practicumMaterialReadinessFilter()%")

    // #[Computed()]
    // public function laboratories(){
    //     $laboratories = PracticumReadiness::whereIn("id", Auth::user()->labMembers->pluck('laboratory_id'))->get();
    //     return $laboratories;
    // }

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

            $item = PracticumReadiness::find($id);
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
