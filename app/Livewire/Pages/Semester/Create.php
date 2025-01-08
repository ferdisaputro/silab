<?php

namespace App\Livewire\Pages\Semester;

use App\Models\AcademicYear;
use App\Models\Semester;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate('required|exists:academic_years,id')]
    public $academic_year;
    #[Validate('required|integer|between:1,8|digits:1')]
    public $semester;

    public function create()
    {
        $this->validate();

        try {
            Semester::create([
                'academic_year_id' => $this->academic_year,
                'semester' => $this->semester,
                'is_even' => $this->semester % 2 == 0? 1 : 0 
            ]);
            $this->reset();
            return response()->json([
                'status' => 'success',
                'message' => 'Semester berhasil dibuat'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
    
    public function render()
    {
        return view('livewire.pages.semester.create', [
            'academic_years' => AcademicYear::all()
        ]);
    }
}
