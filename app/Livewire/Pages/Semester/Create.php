<?php

namespace App\Livewire\Pages\Semester;

use Livewire\Component;
use App\Models\Semester;
use App\Models\AcademicYear;
use Livewire\Attributes\Validate;

class Create extends Component
{
    #[Validate('required|exists:academic_years,id')]
    public $academic_year;
    #[Validate('required|integer')]
    public $semester;

    public function create()
    {
        $this->validate();

        try {
            $isExist = Semester::where('academic_year_id', $this->academic_year)
                                ->where('semester', $this->semester)
                                ->get();

            if ($isExist->count() == 0) {
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
            }

            return response()->json([
                'status' => 'error',
                'message' => "Data sudah ada"
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
