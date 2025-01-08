<?php

namespace App\Livewire\Pages\AcademicWeek;

use App\Models\AcademicWeek;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // template for datatable
    public $academicWeekPerPage = 15;
    public $academicWeekFilter = null;
    public $academicWeekOrderBy = 'id';
    public $academicWeekOrderByDirection = 'asc';

    #[Computed()]
    public function academicWeeks() {
        return AcademicWeek::when($this->academicWeekOrderBy && $this->academicWeekOrderByDirection, function ($query) {
                        $query->orderBy($this->academicWeekOrderBy, $this->academicWeekOrderByDirection);
                    })
                    ->with("academicYear")
                    ->paginate($this->academicWeekPerPage);
    }

    public function delete($key) {
        $id = null;
        try {
            $id = Crypt::decrypt($key);
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }

        try {
            $role = AcademicWeek::find($id);
            $role->delete();

            $this->reset();
            return response()->json([
                'status' => 'success',
                'message' => 'Minggu Ajaran Berhasil Dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
    
    public function render()
    {
        return view('livewire.pages.academic-week.index');
    }
}
