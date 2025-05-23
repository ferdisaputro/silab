<?php

namespace App\Livewire\Pages\HandoverPracticalResult;

use App\Models\LabItem;
use App\Models\Laboratory;
use App\Models\PracticumResultHandover;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Support\Str;


class Index extends Component
{
    public $handOverPerPage = 15;
    public $handOverFilter = null;
    public $handOverOrderBy = 'id';
    public $handOverOrderByDirection = 'asc';
    public $selectedLab;


    #[Computed()]
    public function handOvers() {
        return PracticumResultHandover::when($this->handOverOrderBy && $this->handOverOrderByDirection, function ($query) {
                        $query->orderBy($this->handOverOrderBy, $this->handOverOrderByDirection);
                    })
                    ->where('laboratory_id', $this->selectedLab)
                    ->with('courseInstructor','courseInstructor.semesterCourse','courseInstructor.staff.user')
                    ->paginate($this->handOverPerPage);
    }

    #[Computed()]
    public function laboratories() {
        return Laboratory::whereIn('id', Auth::user()->labMembers->pluck('laboratory_id'))->get();
    }

    public function mount(){
        $this->selectedLab = $this->laboratories()->first()? $this->laboratories()->first()->id : null;

    }
    public function delete($key) {
        $id = Crypt::decrypt($key);
        try {
            DB::beginTransaction();

            $handOver = PracticumResultHandover::with(['practicumResult.labItem', 'practicumResult.stockCard', 'practicumResultLeftOver.labItem', 'practicumResultLeftOver.stockCard'])->find($id);

            foreach (array_merge($handOver->practicumResult->all(), $handOver->practicumResultLeftOver->all()) as $item) {
                $item->labItem->decrement('stock', $item->qty);
                $item->stockCard->delete();
                $item->delete();
            }

            $handOver->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data Serah Terima Berhasil di Hapus',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal Menghapus Data Serah Terima : ' . $e->getMessage(),
            ]);
        }
    }
    public function render()
    {
        if (Gate::allows('isNotALabMember', Auth::user())) {
            return view('components.not-a-lab-member-exception');
        }
        return view('livewire.pages.handover-practical-result.index');
    }
}
