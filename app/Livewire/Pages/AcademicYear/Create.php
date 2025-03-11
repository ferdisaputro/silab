<?php

namespace App\Livewire\Pages\AcademicYear;

use Livewire\Component;
use App\Models\AcademicYear;
use Livewire\Attributes\Validate;

class Create extends Component
{
    #[Validate('required|min:4|max:4')]
    public $startYear;
    #[Validate('required|min:4|max:4')]
    public $endYear;
    #[Validate('required|between:0,1')]
    public $isEven; // is it odd or even semester

    public function updatedStartYear()
    {
        $this->endYear = $this->startYear+1;
    }

    public function resetForm()
    {
        $this->reset();
    }

    public function create()
    {
        $this->validate();

        try {
            AcademicYear::create([
                'start_year' => $this->startYear,
                'end_year' => $this->endYear,
                'is_even' => $this->isEven,
                'is_active' => 1
            ]);
            $this->resetForm();
            return response()->json([
                'status' => 'success',
                'message' => 'Academic year created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'tahunajaran-create');
    }

    public function render()
    {
        return view('livewire.pages.academic-year.create');
    }
}
