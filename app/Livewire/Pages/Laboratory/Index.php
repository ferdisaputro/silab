<?php

namespace App\Livewire\Pages\Laboratory;

use App\Models\Laboratory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
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

    public function render()
    {
        return view('livewire.pages.laboratory.index');
    }
}
