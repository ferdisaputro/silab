<?php

namespace App\Livewire\Pages\AcademicYear;

use Livewire\Component;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Index extends Component
{
    public function delete($key) {
        $this->authorize('hasPermissionTo', 'tahunajaran-delete');

        $id = null;
        try {
            $id = Crypt::decrypt($key);
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }

        try {
            $role = AcademicYear::find($id);
            $role->delete();

            $this->reset();
            return response()->json([
                'status' => 'success',
                'message' => 'Tahun Ajaran Berhasil Dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function updateStatus($key, $status)
    {
        $this->authorize('hasPermissionTo', 'tahunajaran-edit');

        $id = null;
        try {
            $id = Crypt::decrypt($key);
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }

        try {
            $role = AcademicYear::find($id);
            $role->update([
                "is_active" => $status
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Tahun Ajaran Berhasil Diubah',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function mount() {
        // $this->authorize('hasPermissionTo', 'tahunajaran-list|tahunajaran-create|tahunajaran-edit|tahunajaran-delete');
    }

    public function render()
    {
        return view('livewire.pages.academic-year.index', [
            'academicYears' => AcademicYear::get()
        ]);
    }
}
