<?php

namespace App\Livewire\Pages\Semester;

use App\Models\Semester;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

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

    public function render()
    {
        return view('livewire.pages.semester.index');
    }
}
