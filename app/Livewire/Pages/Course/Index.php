<?php

namespace App\Livewire\Pages\Course;

use App\Models\Course;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    // template for datatable
    public $coursePerPage = 15;
    public $courseFilter = null;
    public $courseOrderBy = 'id';
    public $courseOrderByDirection = 'asc';

    // template for datatable filter
    // public function updatedCourseFilter() {
    //     $this->resetPage();
    // }

    #[Computed()]
    public function courses() {
        return Course::where('course', 'like', "%$this->courseFilter%")
                    // ->orderBy($this->courseOrderBy, $this->courseOrderByDirection)
                    ->when($this->courseOrderBy && $this->courseOrderByDirection, function ($query) {
                        $query->orderBy($this->courseOrderBy, $this->courseOrderByDirection);
                    })
                    ->paginate($this->coursePerPage);
    }

    public function updateStatus($key, $status) 
    {
        $id = null;
        try {
            $id = Crypt::decrypt($key);
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }

        $course = Course::find($id);
        $course->update([
            "is_active" => $status
        ]);
    }

    public function render()
    {
        return view('livewire.pages.course.index');
    }
}
