<?php

namespace App\Livewire\Pages\Semester;

use Livewire\Component;
use App\Models\Semester;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Crypt;

class Index extends Component
{
    use WithPagination;
    // template for datatable
    public $semesterPerPage = 15;
    public $semesterFilter = null;
    public $semesterOrderBy = 'id';
    public $semesterOrderByDirection = 'asc';

    // template for datatable filter
    // public function updatedSemesterFilter() {
    //     $this->resetPage();
    // }

    #[Computed()]
    public function semesters() {
        return Semester::
                    // where('columnName', 'like', "%$this->semesterFilter%")
                    // ->orderBy($this->semesterOrderBy, $this->semesterOrderByDirection)
                    when($this->semesterOrderBy && $this->semesterOrderByDirection, function ($query) {
                        $query->orderBy($this->semesterOrderBy, $this->semesterOrderByDirection);
                    })
                    ->with('academicYear')
                    ->paginate($this->semesterPerPage);
    }

    public function delete($key) {
        $this->authorize('hasPermissionTo', 'semester-delete');
        $id = Crypt::decrypt($key);

        try {
            $role = Semester::find($id);
            $role->delete();

            $this->reset();
            return response()->json([
                'status' => 'success',
                'message' => 'Semester Berhasil Dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'semester-list|semester-create|semester-edit|semester-delete');
    }

    public function render()
    {
        return view('livewire.pages.semester.index');
    }
}
