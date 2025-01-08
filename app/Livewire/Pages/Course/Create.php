<?php

namespace App\Livewire\Pages\Course;

use App\Models\Course;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate("required|unique:courses,code")]
    public $code;
    #[Validate("required|unique:courses,course")]
    public $course;

    public function resetForm() {
        $this->reset();
    }

    public function create() {
        $this->validate();
        try {
            Course::create([
                'code' => $this->code,
                'course' => $this->course,
                'is_active' => 1
            ]);
            $this->resetForm();
            return response()->json(['status' => 'success', 'message' => 'Mata kuliah berhasil dibuat']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function render()
    {
        return view('livewire.pages.course.create');
    }
}
