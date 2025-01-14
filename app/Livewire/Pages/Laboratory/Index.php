<?php

namespace App\Livewire\Pages\Laboratory;

use Livewire\Component;
use App\Models\Laboratory;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Index extends Component
{
    use WithPagination;
    // template for datatable
    public $laboratoryPerPage = 15;
    public $laboratoryFilter = null;
    public $laboratoryOrderBy = 'id';
    public $laboratoryOrderByDirection = 'asc';

    // template for datatable filter
    // public function laboratoryFilter() {
    //     $this->resetPage();
    // }

    #[Computed()]
    public function laboratories() {
        return Laboratory::where('name', 'like', "%$this->laboratoryFilter%")
                    // ->orderBy($this->laboratoryOrderBy, $this->laboratoryOrderByDirection)
                    ->when($this->laboratoryOrderBy && $this->laboratoryOrderByDirection, function ($query) {
                        $query->orderBy($this->laboratoryOrderBy, $this->laboratoryOrderByDirection);
                    })
                    ->with('members', 'members.staff', 'members.staff.user')
                    ->paginate($this->laboratoryPerPage);
    }

    public function delete($key) {
        $id = Crypt::decrypt($key);

        try {
            $laboratory = Laboratory::find($id);
            $laboratory->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Laboratorium berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data laboratorium: ' . $e->getMessage(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.laboratory.index');
    }
}
