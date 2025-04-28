<?php

namespace App\Livewire\Pages\PracticumMaterialReadiness;

use App\Models\Laboratory;
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
    public $selectedLab;

    // template for datatable filter
    public function practicumMaterialReadinessFilter() {
        $this->resetPage();
    }
    public function mount() {
        $this->selectedLab = $this->laboratories()->first()? $this->laboratories()->first()->id : null;
    }

    #[Computed()]
    public function laboratories() {
        return Laboratory::whereIn('id', Auth::user()->labMembers->pluck('laboratory_id'))->get();
    }

    #[Computed()]
    public function practicumMaterialReadiness() {
        return PracticumReadiness::when($this->PMROrderBy && $this->PMROrderByDirection, function ($query) {
                        $query->orderBy($this->PMROrderBy, $this->PMROrderByDirection);
                    })
                    ->where('laboratory_id',$this->selectedLab)
                    ->with(['semesterCourse','academicWeek'])
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
        $id = Crypt::decrypt($key);
        // dd($id);
        try {
            DB::beginTransaction();

            $PracMat = PracticumReadiness::find($id);

                // foreach ($PracMat->pracMacs as $pracMatDetail) {
                //     $pracMatDetail->labItem->stock = $pracMatDetail->labItem->stock + $pracMatDetail->qty;
                //     $pracMatDetail->labItem->save();
                //     $pracMatDetail->stockCard->delete();
                // }
                // dd($pracMatDetail);

                $PracMat->delete();

                // dd($eqLoan);

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Jurusan berhasil dihapus',
                ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data jurusan: ' . $e->getMessage(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.practicum-material-readiness.index');
    }
}
