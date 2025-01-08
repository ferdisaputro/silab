<?php

namespace App\Livewire\Pages\AcademicWeek;

use App\Models\AcademicWeek;
use App\Models\AcademicYear;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate('required|exists:academic_years,id')]
    public $academic_year;
    #[Validate('required|date')]
    public $start_date;
    #[Validate('required|date|after_or_equal:start_date')]
    public $end_date;
    // #[Validate("required|integer|min:1")]
    public $week_number;
    #[Validate('required|string|min:3|max:255')]
    public $description;

    public function rules()
    {
        $rules = [
            'academic_year' => 'required|exists:academic_years,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'week_number' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('academic_weeks', 'week_number') // Table and column
                    ->where('academic_year_id', $this->academic_year), // Additional condition
            ],
            'description' => 'required|string|min:3|max:255',
        ];
                
        return $rules;
    }

    public function create() {
        $this->validate();
        try {
            AcademicWeek::create([
                'academic_year_id' => $this->academic_year,
                'start_date' => Carbon::createFromFormat('d/m/Y', $this->start_date)->toDateTimeString(),
                'end_date' => Carbon::createFromFormat('d/m/Y', $this->end_date)->toDateTimeString(),
                'week_number' => $this->week_number,
                'description' => $this->description,
            ]);
            $this->reset();
            return response()->json(['status' => 'success', 'message' => 'Minggu akademik berhasil dibuat']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function render()
    {
        return view('livewire.pages.academic-week.create', [
            'academic_years' => AcademicYear::all()
        ]);
    }
}
