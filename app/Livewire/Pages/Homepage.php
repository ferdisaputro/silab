<?php

namespace App\Livewire\Pages;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\ItemType;
use App\Models\Laboratory;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Homepage extends Component
{

    // #[Computed()]
    // public function laboratories() {
    //     if (Gate::check('dashboard-all-lab')) {
    //         return Laboratory::all();
    //     }
    //     $labMember = Auth::user()->labMembers->pluck('laboratory_id');
    //     dd($labMember);
    //     return Laboratory::whereIn('id', )->get();
    // }

    // #[Computed()]
    // public function itemTypes() {
    //     return ItemType::with('items')->all();
    // }

    public function render()
    {
        $laboratories = null;
        $labMembers = Auth::user()->labMembers;
        $itemTypes = ItemType::with('items', 'items.labItems')->withCount('items')->get();

        $month = Carbon::now()->month; // Retrieves the current month as an integer
        $year = Carbon::now()->year;   // Retrieves the current year as an integer
        $laboratories = Laboratory::withCount(['equipmentLoans' => function($query) use ($year, $month) {
            $query->whereYear('created_at', $year)
                ->whereMonth('created_at', $month);
        }]);

        if (Auth::user()->roles->first()->hasPermissionTo('dashboard-all-lab')) {
            $laboratories = $laboratories->get();
        } else {
            $laboratories = $laboratories->whereIn('id', $labMembers->pluck('laboratory_id'))->get();
        }

        return view('livewire.pages.homepage', [
            'labMembers' => $labMembers,
            'laboratories' => $laboratories,
            'itemTypes' => $itemTypes
        ]);
    }
}
