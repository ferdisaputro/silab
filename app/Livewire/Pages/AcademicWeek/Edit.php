<?php

namespace App\Livewire\Pages\AcademicWeek;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\AcademicWeek;
use App\Models\AcademicYear;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $id;
    public $academic_year;
    #[Validate('required')]
    public $start_date;
    #[Validate('required')]
    public $end_date;
    // #[Validate("required|integer|min:1")]
    public $week_number;
    #[Validate('required|string|min:3|max:255')]
    public $description;

    #[On('initEditAcademicWeek')]
    public function initEditAcademicWeek($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }

        $academic_week = AcademicWeek::find($this->id);
        $this->academic_year = $academic_week->academic_year_id;
        $this->start_date = Carbon::parse($academic_week->start_date)->format('d/m/Y');
        $this->end_date = Carbon::parse($academic_week->end_date)->format('d/m/Y');
        $this->week_number = $academic_week->week_number;
        $this->description = $academic_week->description;
    }

    public function rules()
    {
        $rules = [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'required|string|min:3|max:255',
        ];

        return $rules;
    }

    public function update() {
        // dump($this->start_date, $this->end_date);
        $this->validate();
        try {
            $academic_week = AcademicWeek::find($this->id);
            $academic_week->start_date = Carbon::createFromFormat('d/m/Y', $this->start_date)->toDateTimeString();
            $academic_week->end_date = Carbon::createFromFormat('d/m/Y', $this->end_date)->toDateTimeString();
            $academic_week->description = $this->description;
            if ($academic_week->isDirty('start_date', 'end_date', 'description')) {
                $academic_week->save();
                // $this->start_date = null;
                // $this->end_date = null;
                return response()->json(['status' => 'success', 'message' => 'Minggu akademik berhasil dibuat']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function render()
    {
        return view('livewire.pages.academic-week.edit', [
            'academic_years' => AcademicYear::all()
        ]);
    }
}
