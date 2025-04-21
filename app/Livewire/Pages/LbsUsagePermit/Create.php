<?php

namespace App\Livewire\Pages\LbsUsagePermit;

use Livewire\Component;
use App\Models\Staff;
use App\Models\AcademicYear;


class Create extends Component
{
    public $items = [
        [
            'bahan' => '', // bahan
            'stok' => '', // stok
            'jumlah' => '', // jumlah
            'tahun_ajaran' => '', // tahun ajaran
            'keterangan' => '', // keterangan
        ]
    ];

    public $staffList = []; // Tambahkan ini
    public $lecturerList = [];
    public $academicYearList = [];


    public function mount()
    {
        // Ambil semua staff dengan relasi user (untuk ambil nama dari tabel users)
        $this->staffList = Staff::with('user')->get();

        // Ambil semua staff yang statusnya 1 dan relasi dengan user-nya
        $this->lecturerList = Staff::with('user')
            ->where('staff_status_id', 1)
            ->get();

        // Ambil data academic year dan format tahun ajaran
        $this->academicYearList = AcademicYear::all()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'label' => $item->start_year . ' / ' . $item->end_year
                ];
            })->toArray();
    }

    // public function addItem($bahan, $stok, $jumlah, $tahun_ajaran, $keterangan) {
    public function addItem() {
        $this->items[] = [
            'bahan' => '',
            'stok' => '',
            'jumlah' => '',
            'tahun_ajaran' => '',
            'keterangan' => '',
        ];
    }

    public function removeItem($index) {
        unset($this->items[$index]);

        dump($this->items);
    }

    public function render()
    {
        return view('livewire.pages.lbs-usage-permit.create');
    }
}
