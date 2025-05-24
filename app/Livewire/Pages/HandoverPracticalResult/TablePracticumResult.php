<?php

namespace App\Livewire\Pages\HandoverPracticalResult;

use App\Models\Item;
use App\Models\LabItem;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Support\Str;

class TablePracticumResult extends Component
{
    public $laboratoryId;
    public $code;

    // Data form
    public $items = [
        ['praktikum' => '', 'jumlah' => '']
    ];

    public function mount($laboratoryId)
    {
        $this->laboratoryId = $laboratoryId;
        $this->code        = Str::random(8);
    }

    public function addBahanItem()
    {
        $index = count($this->items);
        $this->items[] = ['praktikum' => '', 'jumlah' => ''];
    }

    public function removeBahanItem($index)
    {
        array_splice($this->items, $index, 1);
    }

    // Helper untuk memfilter opsi di baris ke-$index
    protected function availableItems()
    {
        $allItems = Item::where('item_type_id', 3)->get();

        // ID yang sudah dipilih di baris lain
        $selectedIds = collect($this->items)
            ->pluck('praktikum')
            ->filter()
            ->unique();

        // ID yang sudah tercatat di lab_items
        $labItemIds = LabItem::where('laboratory_id', $this->laboratoryId)
            ->pluck('item_id');

        return $allItems->values(); // reindex
    }

    public function create()
    {
        $this->validate([
            'items.*.praktikum' => 'required|exists:items,id',
            'items.*.jumlah'    => 'required|integer|min:1',
        ]);

        try {
            foreach ($this->items as $item) {
                LabItem::create([
                    'code'          => $this->code,
                    'item_id'       => $item['praktikum'],
                    'stock'         => $item['jumlah'],
                    'laboratory_id' => $this->laboratoryId,
                    'is_active'     => 1,
                ]);

                // update stok master
                $master = Item::find($item['praktikum']);
                $master->quantity += $item['jumlah'];
                $master->save();
            }

            // reset form
            $this->items = [['praktikum' => '', 'jumlah' => '']];
            $this->code = Str::random(8);

            return response()->json(['message'=>'Berhasil','status'=>'success']);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'status'=>'error']);
        }
    }

    public function render()
    {
        return view('livewire.pages.handover-practical-result.table-practicum-result', [
            'availableItems' => $this->availableItems()
        ]);
    }
}
