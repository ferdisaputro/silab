<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Database\Eloquent\Model;

class Template extends Component
{
    // template for datatable
    public $folderNamePerPage = 15;
    public $folderNameFilter = null;
    public $folderNameOrderBy = 'id';
    public $folderNameOrderByDirection = 'asc';

    // template for datatable filter
    public function updatedFolderNameFilter() {
        $this->resetPage();
    }

    #[Computed()]
    public function users() {
        return Model::where('columnName', 'like', "%$this->folderNameFilter%")
                    // ->orderBy($this->folderNameOrderBy, $this->folderNameOrderByDirection)
                    ->when($this->folderNameOrderBy && $this->folderNameOrderByDirection, function ($query) {
                        $query->orderBy($this->folderNameOrderBy, $this->folderNameOrderByDirection);
                    })
                    ->paginate($this->folderNamePerPage);
    }

    public function render()
    {
        return view('livewire.template');
    }
}
