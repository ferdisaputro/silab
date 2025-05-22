<?php

namespace App\Http\Controllers;

use App\Models\EquipmentLoan;
use App\Models\LabMember;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PrintController extends Controller
{
    public function equipmentLoan($key) {
        $equipmentLoan = EquipmentLoan::find(Crypt::decrypt($key));
        $labMember = LabMember::firstWhere('staff_id', Auth::user()->staff->id);

        $name = null;
        $code = null;
        $returnerName = null;
        $returnerCode = null;

        if ($equipmentLoan->is_staff == 1) {
            $name = $equipmentLoan->staffBorrower->user->name;
            $code = "NIP.".$equipmentLoan->staffBorrower->user->code;
        } else {
            $name = $equipmentLoan->name;
            $code = "NIM.".$equipmentLoan->nim;
        }

        if ($equipmentLoan->is_returner_staff == 1) {
            $returnerName = $equipmentLoan->staffReturner->user->name;
            $returnerCode = "NIP.".$equipmentLoan->staffReturner->user->code;
        } else {
            $returnerName = $equipmentLoan->returner_name;
            $returnerCode = "NIM.".$equipmentLoan->returner_nim;
        }

        $data = [
            'department' => $labMember->laboratory->department->name,
            'name' => $name,
            'code' => $code,
            'equipmentLoan' => $equipmentLoan,
            'returnerName' => $returnerName,
            'returnerCode' => $returnerCode,
        ];

        $date = date('YmdHis');

        $pdf = Pdf::loadView('print.equipment-loan', $data)->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->download($date."#peminjaman-alat#".$name.".pdf");
    }
}
