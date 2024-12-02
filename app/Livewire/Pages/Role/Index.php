<?php

namespace App\Livewire\Pages\Role;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    // template for datatable
    public $rolePerPage = 15;
    public $roleFilter = null;
    public $roleOrderBy = 'id';
    public $roleOrderByDirection = 'asc';

    // template for datatable filter
    public function roleFilter() {
        $this->resetPage();
    }

    #[Computed()]
    public function roles() {
        return Role::when($this->roleOrderBy && $this->roleOrderByDirection, function ($query) {
                        $query->orderBy($this->roleOrderBy, $this->roleOrderByDirection);
                    })
                    ->paginate($this->rolePerPage);
    }

    public function render()
    {
        return view('livewire.pages.role.index');
    }
}
