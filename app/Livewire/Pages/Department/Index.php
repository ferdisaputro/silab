<?php

namespace App\Livewire\Pages\Department;

use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Index extends Component
{
    use WithPagination;

    public $departmentPerPage = 15;
    public $departmentFilter = null;
    public $departmentOrderBy = 'id';
    public $departmentOrderByDirection = 'asc';

    #[Computed()]
    public function departments() {
        return Department::where('department', 'like', "%$this->departmentFilter%")
                    // ->orderBy($this->departmentOrderBy, $this->departmentOrderByDirection)
                    ->when($this->departmentOrderBy && $this->departmentOrderByDirection, function ($query) {
                        $query->orderBy($this->departmentOrderBy, $this->departmentOrderByDirection);
                    })
                    ->with('headOfDepartments', 'headOfDepartments.staff', 'headOfDepartments.staff.user')
                    ->paginate($this->departmentPerPage);
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
            $department = Department::find($id);
            $department->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Jurusan berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data jurusan: ' . $e->getMessage(),
            ]);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'jurusan-list|jurusan-create|jurusan-edit|jurusan-delete');
    }

    public function render()
    {
        return view('livewire.pages.department.index');
    }
}
