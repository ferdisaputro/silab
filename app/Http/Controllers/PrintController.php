<?php

namespace App\Http\Controllers;

use App\Models\EquipmentLoan;
use App\Models\ItemLossOrDamage;
use App\Models\LabMember;
use App\Models\LbsUsagePermit;
use App\Models\ScheduleReplacement;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PrintController extends Controller
{   
    public function __construct() {
        Carbon::setLocale('id_ID');
    }

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

    public function scheduleReplacement($key) {
        $schedule = ScheduleReplacement::findOrFail(decrypt($key))->load('lecturer.user', 'headOfStudyProgram.staff.user');
        $schedule->real_date = Carbon::parse($schedule->real_schedule)->translatedFormat('l, d F Y');
        $schedule->real_hour = Carbon::parse($schedule->real_schedule)->translatedFormat("H:i");
        $schedule->replacement_date = Carbon::parse($schedule->replacement_schedule)->translatedFormat('l, d F Y');
        $schedule->replacement_hour = Carbon::parse($schedule->replacement_schedule)->translatedFormat("H:i");

        $date = date('YmdHis');

        $pdf = Pdf::loadView('print.schedule-replacement', ['schedule' => $schedule])->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->download($date."#penggantian-jadwal#".$schedule->labMember->user->name."#".$schedule->course->course.".pdf");
    }

    public function damagedLossReport($key) {
        $report = ItemLossOrDamage::findOrFail(decrypt($key));
        $report->return_day = Carbon::parse($report->date_replace_agreement)->translatedFormat('l');
        $report->return_date = Carbon::parse($report->date_replace_agreement)->translatedFormat('d F Y');
 
        $date = date('YmdHis');

        $pdf = Pdf::loadView('print.damaged-loss-report', ['report' => $report])->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->download($date."#BAPKehilangan#".$report->name.".pdf");
    }

    public function lbsUsagePermit($key) {
        $permit = LbsUsagePermit::findOrFail(decrypt($key));
        $permit->start = Carbon::parse($permit->start_date)->translatedFormat('d F Y');
        $permit->end = Carbon::parse($permit->end_date)->translatedFormat('d F Y');
        $permit->headOfDepartmentName = $permit->laboratory->department->headOfDepartments->firstWhere('is_active', 1)->staff->user->name;
        $permit->headOfDepartmentCode = $permit->laboratory->department->headOfDepartments->firstWhere('is_active', 1)->staff->user->code;

        $date = date('YmdHis');

        $data = [
            'name' => $permit->is_staff? $permit->staffBorrower->user->name : $permit->name,
            'code' => $permit->is_staff? $permit->staffBorrower->user->code: $permit->nim,
            'permit' => $permit
        ];

        // dd($data);

        $pdf = Pdf::loadView('print.lbs-usage-permit', $data)->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->download($date."#IjinPenggunaanLBS#".$permit->name.".pdf");
    }
}
