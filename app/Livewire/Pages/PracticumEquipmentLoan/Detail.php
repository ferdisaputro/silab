<?php

namespace App\Livewire\Pages\PracticumEquipmentLoan;

use App\Models\Staff;
use Livewire\Component;
use App\Models\EquipmentLoan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Detail extends Component
{
    public $listeners = ['initDetailPracticumEquipmentLoan'];

    public $id;
    public $items = [
        [
            'bahan' => '', // bahan
            'stok' => '', // stok
            'jumlah' => '', // jumlah
            'tahun_ajaran' => '', // tahun ajaran
            'keterangan' => '', // keterangan
        ]
    ];

    public $equipmentLoan;

    public function initDetailPracticumEquipmentLoan($id) {
        try {
            $decrypted = Crypt::decrypt($id);
            // $this->id = $decrypted;
            $this->equipmentLoan = EquipmentLoan::find($decrypted)->load('loanDetails', 'loanDetails.labItem');
        } catch (DecryptException $e) {
            return $this->redirect($this->prev_url, navigate: true);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'bonalat-list');
    }

    public function render()
    {
        return view('livewire.pages.practicum-equipment-loan.detail', [
            'lecturers' => Staff::with('user')->where('staff_status_id', 1)->get(), //dosen
            'staffs' => Staff::with('user')->get(), //staff
        ]);
    }
}
