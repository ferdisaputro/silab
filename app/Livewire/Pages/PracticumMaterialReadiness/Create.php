<?php

namespace App\Livewire\Pages\PracticumMaterialReadiness;

use App\Models\AcademicWeek;
use App\Models\AcademicYear;
use App\Models\Course;
use App\Models\Department;
use App\Models\Item;
use App\Models\StudyProgram;
use App\Models\Unit;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $test_results = [];
    public $Items;
    // public $test_results = [
    //     [
    //         'bahan' => '', // bahan
    //         'stok' => '', // stok
    //         'jumlah' => '', // jumlah
    //         'tahun_ajaran' => '', // tahun ajaran
    //         'keterangan' => '', // keterangan
    //     ]
    // ];

    public function mount()
    {
        // Ambil data Items dari database
        $this->Items = Item::all();

        // Inisialisasi test_results
        $this->test_results = [
            ['bahan' => null, 'stok' => null],
        ];
    }

    public function handleItemChange($index, $itemId)
{
    $item = Item::find($itemId);
    $this->test_results[$index]['stok'] = $item ? $item->quantity : null;
}

    // public $Items = [
    //     ['item_name' => ''],
    //     ];


    // public function addTestResult($bahan, $stok, $jumlah, $tahun_ajaran, $keterangan) {
    public function addTestResult() {
        $this->test_results[] = [
            'bahan' => '',
            'stok' => '',
            'jumlah' => '',
            'tahun_ajaran' => '',
            'keterangan' => '',
        ];
    }
    // public function addItems() {
    //     $this->addItems[] = ['item_name' => ''];
    //     }


    public function removeTestResult($index) {
        unset($this->test_results[$index]);

        dump($this->test_results);
    }

    public function render()
    {
        // dd('Items:', $this->Items->toArray());
        // dd($this->test_results);
        return view('livewire.pages.practicum-material-readiness.create',[
            'Items' => Item::all(),
            'Units' => Unit::all(),
            'Prodis' => Department::all(),
            'Courses' => Course::all(),
            'Matkuls' => StudyProgram::all(),
            'Dosens' => User::all(),
            'Weeks' => AcademicWeek::all(),
            "Years" => AcademicYear::all(),
        ]);
    }
}
