<?php

namespace App\Livewire\Pages\Semester;

use Livewire\Component;
use App\Models\Semester;
use Livewire\Attributes\On;
use App\Models\AcademicYear;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $id;
    #[Validate('required|exists:academic_years,id')]
    public $academic_year;
    #[Validate('required|integer')]
    public $semester;

    public function edit()
    {
        $this->validate();

        try {
            $isExist = Semester::where('academic_year_id', $this->academic_year)
                                ->where('semester', $this->semester)
                                ->get();

            if ($isExist->count() == 0) {
                $semester = Semester::find($this->id);
                $semester->academic_year_id = $this->academic_year;
                $semester->semester = $this->semester;

                if ($semester->isDirty(['academic_year_id', 'semester'])) {
                    $semester->save();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Semester berhasil diubah'
                    ]);
                }
                return response()->json([
                    'status' => 'info',
                    'message' => 'Tidak ada perubahan data'
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

    #[On('initEditSemester')]
    public function initEditSemester($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            $this->id = $decrypted;

            $semester = Semester::find($this->id);
            $this->academic_year = $semester->academic_year_id;
            $this->semester = $semester->semester;
        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }
    }
    public function render()
    {
        return view('livewire.pages.semester.edit', [
            'academic_years' => AcademicYear::all()
        ]);
    }
}
