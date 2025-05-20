<?php

namespace App\Livewire\Pages\DamagedLostReport;

use App\Models\ItemLossOrDamage;
use App\Models\Laboratory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $lossOrDamagePerPage = 15;
    public $lossOrDamageFilter = null;
    public $lossOrDamageOrderBy = 'id';
    public $lossOrDamageOrderByDirection = 'asc';
    public $selectedLab;

    // template for datatable filter
    public function updatedLossDamagFilter() {
        $this->resetPage();
    }
    // public function mount() {
    //     $this->selectedLab = $this->laboratories()->first()? $this->laboratories()->first()->id : null;
    // }
    public function updatedSelectedLab(){
        $this->dispatch('initCreateDamagedLostReport',$this-> selectedLab);
    }
    #[Computed()]
    public function laboratories() {
        return Laboratory::onlyActiveUserMember()->get();
    }

    #[Computed()]
    public function lossOrDamage() {
        return ItemLossOrDamage::where('name', 'like', "%$this->lossOrDamageFilter%")
                    ->when($this->lossOrDamageOrderBy && $this->lossOrDamageOrderByDirection, function ($query) {
                        $query->orderBy($this->lossOrDamageOrderBy, $this->lossOrDamageOrderByDirection);
                    })
                    ->where('laboratory_id',$this->selectedLab)
                    // ->with('labItems')
                    ->paginate($this->lossOrDamagePerPage);
    }

    public function delete($key) {
        $id = null;
        try {
            $id = Crypt::decrypt($key);
            // dd($id);
        } catch (DecryptException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode Enkripsi Tidak Valid'
            ]);
        }

        try {
            DB::beginTransaction();

            $item = ItemLossOrDamage::find($id);
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
        if (Gate::allows('isNotALabMember', Auth::user())) {
            return view('components.not-a-lab-member-exception');
        }
        return view('livewire.pages.damaged-lost-report.index');
    }
}
