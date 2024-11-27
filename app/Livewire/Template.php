<?php

namespace App\Livewire;

use Livewire\Component;

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

    public function render()
    {
        return view('livewire.template');
    }
}
