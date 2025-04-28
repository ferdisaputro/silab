<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\EquipmentLoan;
use App\Models\Staff;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return response()->json([
            'technicians' => Staff::where('staff_status_id', 3)->get(),
            'lecturers' => Staff::where('staff_status_id', 1)->get(),
            'administrators' => Staff::where('staff_status_id', 2)->get(),
            'active_staff' => Staff::where('status', 1)->count(),
            'equipment_loan' => EquipmentLoan::get(),
        ]);
    }
}
