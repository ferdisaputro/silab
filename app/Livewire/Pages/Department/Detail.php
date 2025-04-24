<?php

namespace App\Livewire\Pages\Department;

use App\Models\Department;
use App\Models\StudyProgram;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Livewire\Attributes\Computed;

class Detail extends Component
{
    public $id;
    public $prev_url;
    public $newStudies = [
        // "kode" => "KODE $decrypted",
        // "nama" => "Nama Program Studi  $decrypted",
        // "kaprodi" => "Ketua Program Studi  $decrypted",
    ];

    public $listeners = ['addNewStudy', 'initDetailDepartment' => 'initDetail'];

    // #[Computed()]
    // public function studyPrograms() {
    //     $department = Department::find($this->id);
    //     return $department? $department->studyPrograms : null;
    // }

    #[Computed()]
    public function department() {
        return Department::find($this->id)->load('studyPrograms');
    }

    public function initDetail($key) {
        $this->reset();
        try {
            $decrypted = Crypt::decrypt($key);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }
    }

    public function addNewStudy($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            $studyProgram = StudyProgram::find($decrypted);
            $this->newStudies[] = $studyProgram;
        } catch (DecryptException $e) {
            return response()->json('error');
        }
    }

    public function removeNewStudy($index) {
        unset($this->newStudies[$index]);
    }

    public function removeStudyProgram($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            StudyProgram::find($decrypted)->update([
                'department_id' => null
            ]);
            return response()->json(['status' => 'success', 'message' => 'Program Studi Berhasil Dihapus.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus prodi. Error: '.$th->getMessage()]);
        }
    }

    public function edit() {
        try {
            $department = Department::find($this->id);
            if ($department) {
                foreach ($this->newStudies as $newStudy) {
                    $newStudy->update([
                        'department_id' => $department->id
                    ]);
                }
                $this->newStudies = [];
                return response()->json(['status' => 'success', 'message' => 'Program Studi Berhasil Ditambahkan.']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Error dalam mengambil data, refresh dan coba lagi.']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menambahkan prodi. Error: '.$th->getMessage()]);
        }
    }


    public function render()
    {
        return view('livewire.pages.department.detail');
    }
}
