<?php

namespace App\Livewire\Pages\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $listeners = ['initEditCourse'];
    public $id;

    #[Validate("required|unique:courses,code")]
    public $code;
    #[Validate("required|unique:courses,course")]
    public $course;

    public function resetForm() {
        $this->reset();
    }

    public function edit() {
        try {
            $course = Course::find($this->id);
            $course->code = $this->code;
            $course->course = $this->course;

            if ($course->isDirty(['code', 'course'])) {
                $course->save();
                $this->resetForm();
                return response()->json(['status' => 'success', 'message' => 'Mata kuliah berhasil diubah']);
            }

            return response()->json(['status' => 'info', 'message' => 'Tidak ada perubahan data']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function initEditCourse($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            $this->id = $decrypted;

            $course = Course::find($this->id);
            $this->code = $course->code;
            $this->course = $course->course;
        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'matakuliah-edit');
    }

    public function render()
    {
        return view('livewire.pages.course.edit');
    }
}
