<?php

namespace App\Livewire\Pages\Employee;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Can;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Index extends Component
{
    use WithPagination;

    public $employeePerPage = 15;
    public $employeeFilter = null;
    public $employeeOrderBy = 'id';
    public $employeeOrderByDirection = 'desc';

    #[Computed()]
    public function users() {
        return User::where('name', 'like', "%$this->employeeFilter%")
                    // ->orderBy($this->employeeOrderBy, $this->employeeOrderByDirection)
                    ->when($this->employeeOrderBy && $this->employeeOrderByDirection, function ($query) {
                        $query->orderBy($this->employeeOrderBy, $this->employeeOrderByDirection);
                    })
                    ->paginate($this->employeePerPage);
    }

    public function delete($key) {
        $this->authorize('hasPermissionTo', 'staff-delete');

        try {
            $id = Crypt::decrypt($key);
        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }

        try {
            if (User::destroy($id)) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data pegawai berhasil dihapus',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data pegawai: '. $e->getMessage(),
            ]);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'staff-list|staff-create|staff-edit|staff-delete');
    }

    public function render()
    {
        return view('livewire.pages.employee.index');
    }
}
