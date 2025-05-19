<?php

namespace App\Livewire\Pages\DamagedLostReport;

use App\Models\Item;
use App\Models\ItemLossOrDamage;
use App\Models\LabItem;
use App\Models\Laboratory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Volt\Compilers\Mount;
use Illuminate\Support\Str;
use Throwable;

class Create extends Component
{
    public $listeners = ['initCreateDamagedLostReport'];
    #[Validate('required|integer|exists:laboratories,id')]
    public $selectedLab;
    #[Validate('required')]
    public $nim;
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $group;
    #[Validate('required')]
    public $borrowingDate;
    public $status = 1;
    public $code1 ;
    public $code2 ;
    public $code ;

    public function create()
    {
        $this->validate();
        $data = [];
        $data['code'] = $this->code;
        $data['name'] = $this->name;
        $data['nim'] = $this->nim;
        $data['group_class'] = $this->group;
        $data['status'] = $this->status;
        $data['date_replace_agreement'] = Carbon::createFromFormat('d/m/Y', $this->borrowingDate)->toDateTimeString();
        $data['laboratory_id'] = $this->selectedLab;
        $data['lab_member_id'] = Auth::user()->labMembers->firstWhere('laboratory_id', $this->selectedLab)->id;

        try {
            DB::beginTransaction();

            $itemLossOrDamageId = ItemLossOrDamage::create($data);
            $loss_damage_detail = collect($this->items)->map(function($item) use ($itemLossOrDamageId) {
                return [
                    'code' => $this->code,
                    'amount_loss_damaged' => $item['jumlah'],
                    'status' => $this->status,
                    'item_loss_or_damage_id' => $itemLossOrDamageId->id, //  just temp data
                    'lab_item_id' => $item['bahan'],
                ];
            });
            $this->reset();
            // dd($itemLossOrDamageId);

            $itemLossOrDamageId->LossDamageDetail()->createMany($loss_damage_detail);

            // foreach ($this->items as $item) {
            //     $labItem = LabItem::find($item['item']);
            //     $labItem->stock -= $item['qty'];
            //     $labItem->save();
            // }

            // dump($stockCardsResult, $equipmentLoan, $eqLoanDetailResult);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Peminjaman alat praktikum berhasil dibuat'
            ]);

        } catch (Throwable $th) {
            DB::rollback();
            // dump($th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
    #[Computed()]
    public function labItems()
    {
        $laboratory = Laboratory::with('labItems.item')->find($this->selectedLab);

        return $laboratory ? $laboratory->labItems : collect([]);
    }

    // public function labItems(){
    //     $laboratory = Laboratory::find(id: $this->selectedLab);
    //     return isset($laboratory)? $laboratory->labItems->load('item') : [];
    // }

    public function initCreateDamagedLostReport($data){
        $this->selectedLab = $data;
        $this->code1 = Str::random(12);
        $this->code2 = Str::random(12);
        $this->code = Str::random(12);
    }
    public $items = [
        [
            'bahan' => '', // bahan
            'jumlah' => ''
        ]
    ];

    // public function addItem($bahan, $stok, $jumlah, $tahun_ajaran, $keterangan) {
    public function addItem() {
        $this->items[] = [
            'bahan' => '',
            'jumlah' => ''
        ];
    }

    public function removeItem($index) {
        unset($this->items[$index]);
    }

    public function render()
    {
        return view('livewire.pages.damaged-lost-report.create');
    }
}
