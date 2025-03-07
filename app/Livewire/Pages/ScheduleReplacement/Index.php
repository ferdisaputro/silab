<?php

namespace App\Livewire\Pages\ScheduleReplacement;

use App\Models\Item;
use Livewire\Component;
use App\Models\Laboratory;
use App\Models\StudyProgram;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Models\ScheduleReplacement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Index extends Component
{
    use WithPagination;
    public $schedulePerPage = 15;
    public $scheduleFilter = null;
    public $scheduleOrderBy = 'id';
    public $scheduleOrderByDirection = 'asc';

    // template for datatable filter
    public function updatedScheduleFilter() {
        $this->resetPage();
    }

    #[Computed()]
    public function Schedules() {
        return ScheduleReplacement::when($this->scheduleOrderBy && $this->scheduleOrderByDirection, function ($query) {
                        $query->orderBy($this->scheduleOrderBy, $this->scheduleOrderByDirection);
                    })
                    ->paginate($this->schedulePerPage);
    }

    // ->orderBy($this->permissionOrderBy, $this->permissionOrderByDirection)
    public function delete($key) {
        $id = Crypt::decrypt($key);

        try {
            DB::beginTransaction();

            $item = ScheduleReplacement::find($id);
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
        return view('livewire.pages.schedule-replacement.index',[
            // 'Prodis' => StudyProgram::all(),
        ]);
    }
}
