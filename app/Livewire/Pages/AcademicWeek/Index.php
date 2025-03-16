<?php

namespace App\Livewire\Pages\AcademicWeek;

use Livewire\Component;
use App\Models\AcademicWeek;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;

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
        $this->authorize('hasPermissionTo', 'minggu-delete');

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

    public function mount() {
        $this->authorize('hasPermissionTo', 'minggu-list|minggu-create|minggu-edit|minggu-delete');
    }

    public function render()
    {
        return view('livewire.pages.academic-week.index');
    }
}
