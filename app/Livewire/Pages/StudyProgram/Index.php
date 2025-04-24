<?php

namespace App\Livewire\Pages\StudyProgram;

use Livewire\Component;
use App\Models\StudyProgram;
use Livewire\Attributes\Computed;

class Index extends Component
{
    public function mount() {
        $this->authorize('hasPermissionTo', 'jurusan-list|jurusan-create|jurusan-edit|jurusan-delete');
    }

    public function render()
    {
        return view('livewire.pages.study-program.index');
    }
}
