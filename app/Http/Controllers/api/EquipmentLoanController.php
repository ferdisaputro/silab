<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\StockCard;
use Illuminate\Http\Request;
use App\Models\EquipmentLoan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class EquipmentLoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'update']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(EquipmentLoan::with('staffBorrower', 'staffReturner', 'loanDetails')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EquipmentLoan $equipmentLoan)
    {
        return response()->json([
            'equipment_loan' => $equipmentLoan->load('loanDetails', 'memberBorrow.staff.user', 'memberReturn.staff.user', 'mentor.user', 'staffBorrower.user', 'staffReturner.user')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EquipmentLoan $equipmentLoan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EquipmentLoan $equipmentLoan)
    {
        // return response()->json([
        //     $equipmentLoan->load('loanDetails'),
        //     $request->all,
        //     Auth::user()->labMembers
        // ]);
        try {
            DB::beginTransaction();
            if ($request->is_staff) {
                $equipmentLoan->is_returner_staff = 1;
                $equipmentLoan->staff_id_returner = $request->staffReturner;
            } else {
                $equipmentLoan->is_returner_staff = 0;
                $equipmentLoan->returner_nim = $request->returnerNim;
                $equipmentLoan->returner_name = $request->returnerName;
                $equipmentLoan->returner_group_class = $request->returnerGroupClass;
            }
            $equipmentLoan->return_date = Carbon::createFromFormat('d/m/Y H:i', $request->return_date." ".$request->return_time)->toDateTimeString();
            $equipmentLoan->lab_member_id_return = Auth::user()->id;
            $equipmentLoan->status = 2;

            // $equipmentLoan->save();

            $returnStockCards = [];

            $loanDetailItems = collect($request->loan_detail_items);
            foreach ($equipmentLoan->loanDetails as $loanDetail) {
                // dump($loanDetailItems->firstWhere('loanDetailId', $loanDetail->id));
                $returnStockCard = StockCard::create([
                    'qty' => $loanDetail->qty,
                    'stock' => $loanDetail->labItem->stock,
                    'is_stock_in' => 1,
                    'description' => $loanDetail->description,
                    'system_description' => "Return stock from PracticumEquipmentLoan",
                    'lab_item_id' => $loanDetail->lab_item_id,
                    'lab_member_id' => Auth::user()->labMembers->firstWhere('laboratory_id', $equipmentLoan->laboratory_id)->id,
                ]);

                $returnStockCards[] = $returnStockCard;

                $loanDetail->return_qty = $loanDetailItems->firstWhere('loanDetailId', $loanDetail->id)['returnQty'];
                $loanDetail->stock_card_id_return = $returnStockCard->id;
                $loanDetail->status = $loanDetailItems->firstWhere('loanDetailId', $loanDetail->id)['returnQty'] < $loanDetail->qty? 2 : 1;
                $loanDetail->save();

                $loanDetail->labItem->stock = $loanDetail->labItem->stock + $loanDetail->return_qty;
                $loanDetail->labItem->save();
            }

            return response()->json([
                $equipmentLoan->load('loanDetails'),
                $request->all,
                Auth::user()
            ]);

            // dd($this->equipmentLoan);

            // DB::commit();
            // return response()->json([
            //     'status' => "success",
            //     'message' => "Laporan peminjaman alat praktikum berhasil diubah"
            // ]);
            DB::rollback();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return response()->json([
                'status' => "error",
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipmentLoan $equipmentLoan)
    {
        //
    }
}
