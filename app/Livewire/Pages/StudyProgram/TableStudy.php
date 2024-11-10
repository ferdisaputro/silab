<?php

namespace App\Livewire\Pages\StudyProgram;

use Livewire\Component;
use Livewire\Attributes\On;

class TableStudy extends Component
{
    public $isSelectable = false;
    public $identifier = false;
    public $dataCount = 0;

    #[On('initTableStudy')]
    public function initTableStudy($isSelectable = false, $identifier = false) {
        $this->isSelectable = $isSelectable?? false;
        $this->identifier = $identifier;
        $this->dataCount = 5;
    }

    public function render()
    {
        return view('livewire.pages.study-program.table-study');
    }
}
