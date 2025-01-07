<?php

namespace App\Livewire\Pages\StudyProgram;

use App\Models\StudyProgram;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class TableStudy extends Component
{
    use WithPagination;
    
    public $isSelectable = false;
    public $identifier = false;
    public $dataCount = 0;

    // template for datatable
    public $studyProgramPerPage = 15;
    public $studyProgramFilter = null;
    public $studyProgramOrderBy = 'id';
    public $studyProgramOrderByDirection = 'asc';

    // template for datatable filter
    // public function updatedStudyProgramFilter() {
    //     $this->resetPage();
    // }

    #[Computed()]
    public function studyPrograms() {
        return StudyProgram::where('study_program', 'like', "%$this->studyProgramFilter%")
                    ->orWhere('code', 'like', "%$this->studyProgramFilter%")
                    // ->orderBy($this->studyProgramOrderBy, $this->studyProgramOrderByDirection)
                    ->when($this->studyProgramOrderBy && $this->studyProgramOrderByDirection, function ($query) {
                        $query->orderBy($this->studyProgramOrderBy, $this->studyProgramOrderByDirection);
                    })
                    ->with('headOfStudyPrograms', 'headOfStudyPrograms.staff', 'headOfStudyPrograms.staff.user')
                    ->paginate($this->studyProgramPerPage);
    }

    #[On('initTableStudy')]
    public function initTableStudy($isSelectable = false, $identifier = false) {
        $this->isSelectable = $isSelectable?? false;
        $this->identifier = $identifier;
        $this->dataCount = 5;
    }

    public function delete($key) {
        $id = null;
        try {
            $id = Crypt::decrypt($key);
        } catch (DecryptException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode Enkripsi Tidak Valid'
            ]);
        }

        try {
            $studyProgram = StudyProgram::find($id);
            $studyProgram->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Program studi berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data program studi: ' . $e->getMessage(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.study-program.table-study');
    }
}
