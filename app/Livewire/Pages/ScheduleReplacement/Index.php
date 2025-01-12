<?php

namespace App\Livewire\Pages\ScheduleReplacement;

use App\Models\Item;
use App\Models\ScheduleReplacement;
use App\Models\StudyProgram;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

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
