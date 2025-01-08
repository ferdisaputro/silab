<?php

namespace App\Livewire\Pages\AcademicYear;

use App\Models\AcademicYear;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $listeners = ['initEditAcademicYear'];
    public $id;
    #[Validate('required|min:4|max:4')]
    public $editStartYear;
    #[Validate('required|min:4|max:4')]
    public $editEndYear;
    #[Validate('required|between:0,1')]
    public $editIsEven; // is it odd or even semester

    public function initEditAcademicYear($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }

        $academicYear = AcademicYear::findOrFail($this->id);
        $this->editStartYear = $academicYear->start_year;
        $this->editEndYear = $academicYear->end_year;
        $this->editIsEven = $academicYear->is_even;
    }

    public function edit() {
        $this->validate();
        try {
            $academicYear = AcademicYear::findOrFail($this->id);
            $academicYear->start_year = $this->editStartYear;
            $academicYear->end_year = $this->editEndYear;
            $academicYear->is_even = $this->editIsEven;

            if ($academicYear->isDirty('start_year', 'end_year', 'is_even')) {
                $academicYear->update();
                return response()->json(['status' => 'success', 'message' => 'Data Tahun Ajaran Berhasil Diubah']);
            }
            return response()->json(['status' => 'info', 'message' => 'Tidak Ada Perubahan Data']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function render()
    {
        return view('livewire.pages.academic-year.edit');
    }
}
