<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\EquipmentLoan;
use App\Models\Staff;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $staff = Staff::get();
        $equipmentLoans = EquipmentLoan::get();

        $dashboardData = [
            'total_staff_active' => $staff->where('status', 1)->count(),
            'total_staff_nonactive' => $staff->where('status', 0)->count(),
            'equipment_loans' => $equipmentLoans,
        ];
        return response()->json($dashboardData);
    }
}
