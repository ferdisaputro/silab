<?php

namespace App\Livewire\Pages\StudyProgram;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StudyProgram;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

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
    public function studyPrograms()
    {
        return StudyProgram::where('study_program', 'like', "%$this->studyProgramFilter%")
            ->orWhere('code', 'like', "%$this->studyProgramFilter%")
            ->when($this->isSelectable, function ($query) {
                $query->orderByRaw('department_id IS NULL DESC, department_id ASC');
            })
            ->when($this->studyProgramOrderBy && $this->studyProgramOrderByDirection, function ($query) {
                $query->orderBy($this->studyProgramOrderBy, $this->studyProgramOrderByDirection);
            })
            ->with('department', 'headOfStudyPrograms', 'headOfStudyPrograms.staff', 'headOfStudyPrograms.staff.user')
            ->paginate($this->studyProgramPerPage);
    }

    #[On('initTableStudy')]
    public function initTableStudy($isSelectable = false, $identifier = false) {
        $this->isSelectable = $isSelectable?? false;
        $this->identifier = $identifier;
        $this->dataCount = 5;
    }

    public function delete($key) {
        $this->authorize('hasPermissionTo', 'jurusan-delete');

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
