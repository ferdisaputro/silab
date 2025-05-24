<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\StockCard;
use Illuminate\Http\Request;
use App\Models\EquipmentLoan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EquipmentLoanDetail;
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
        return response()->json(EquipmentLoan::with('staffBorrower.user', 'staffReturner.user', 'loanDetails')->get());
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
        return response()->json($equipmentLoan->load('loanDetails.labItem.item', 'memberBorrow.staff.user', 'memberReturn.staff.user', 'mentor.user', 'staffBorrower.user', 'staffReturner.user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EquipmentLoan $equipmentLoan)
    {
        //
    }



    // how to send data into update function. (example)

    // http url
    // localhost:8000/api/peminjaman/16

    // http header
    // headers: {
    //   'Authorization': 'Bearer $token', // you need to add the bearer token. to get the $token, you can reference into flutter "AuthProvider". You sould found "token" variables. that variable store authorization token that you could use to access this function.
    //   'Accept': 'application/json',
    // },

    // http body
    // {
    //     // only if the returner is staff
    //         "is_staff": true,
    //         "staffReturner": 5,
    //         "return_date": "16/05/2025", //d/m/Y
    //         "return_time": "14:30" //H:i

    //     // if the returner is student
    //         "is_staff": false,
    //         "returnerNim": "220411100123",
    //         "returnerName": "Ahmad Fajar",
    //         "returnerGroupClass": "TI-3B",
    //         "return_date": "16/05/2025", //d/m/Y
    //         "return_time": "14:30", //H:i
    //         "loan_detail_items": [
    //             {
    //                 "loanDetailId": 60,
    //                 "returnQty": 3
    //             },
    //             {
    //                 "loanDetailId": 61,
    //                 "returnQty": 3
    //             }
    //         ]
    //     }

//     public function update(Request $request, EquipmentLoan $equipment_loan)
// {
//     try {
//         DB::beginTransaction();

//         // Update data pengembalian utama
//         $equipment_loan->update([
//             'returned_at' => $request->input('returned_at'),
//             'status' => 'returned',
//             'staff_returner_id' => $request->input('staff_returner_id'),
//             'nim' => $request->input('nim'),
//             'nama' => $request->input('nama'),
//             'kelompok' => $request->input('kelompok'),
//         ]);

//         // Proses detail pengembalian
//         foreach ($request->input('details', []) as $detail) {
//             EquipmentLoanDetail::where('id', $detail['loan_detail_id'])
//                 ->update([
//                     'return_qty' => $detail['return_qty'],
//                 ]);
//         }

//         DB::commit();

//         return response()->json([
//             'message' => 'Pengembalian berhasil disimpan',
//             'data' => $equipment_loan->load('equipmentLoanDetails')
//         ]);
//     } catch (\Exception $e) {
//         DB::rollBack();
//         return response()->json([
//             'error' => 'Gagal menyimpan pengembalian',
//             'message' => $e->getMessage()
//         ], 500);
//     }
// }
public function update(Request $request, EquipmentLoan $equipmentLoan)
{
    if (!$request->has('loan_detail_items')) {
        return response()->json([
            'status' => 'error',
            'message' => 'loan_detail_items tidak ditemukan dalam request'
        ], 400);
    }

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

        // Format tanggal pengembalian
        $equipmentLoan->return_date = Carbon::createFromFormat('d/m/Y H:i', $request->return_date." ".$request->return_time)->toDateTimeString();

        // Cari lab member yang sesuai
        $labMember = Auth::user()->labMembers->firstWhere('laboratory_id', $equipmentLoan->laboratory_id);
        if (!$labMember) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Lab member tidak ditemukan untuk user ini'
            ], 400);
        }

        $equipmentLoan->lab_member_id_return = $labMember->id;
        $equipmentLoan->status = 2;
        $equipmentLoan->save();

        $loanDetailItems = collect($request->loan_detail_items);

        foreach ($equipmentLoan->loanDetails as $loanDetail) {
            $matchedDetail = $loanDetailItems->firstWhere('loanDetailId', $loanDetail->id);
            if (!$matchedDetail) continue;

            $returnQty = $matchedDetail['returnQty'];

            $returnStockCard = StockCard::create([
                'qty' => $returnQty,
                'stock' => $loanDetail->labItem->stock,
                'is_stock_in' => 1,
                'description' => $loanDetail->description,
                'system_description' => "Return stock from PracticumEquipmentLoan",
                'lab_item_id' => $loanDetail->lab_item_id,
                'lab_member_id' => $labMember->id,
            ]);

            $loanDetail->return_qty = $returnQty;
            $loanDetail->stock_card_id_return = $returnStockCard->id;
            $loanDetail->status = ($returnQty < $loanDetail->qty) ? 2 : 1;
            $loanDetail->save();

            $loanDetail->labItem->stock += $returnQty;
            $loanDetail->labItem->save();
        }

        DB::commit();

        return response()->json([
            'status' => "success",
            'message' => "Laporan peminjaman alat praktikum berhasil diubah"
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status' => "error",
            'message' => $e->getMessage()
        ], 500);
    }
}


    // public function update(Request $request, EquipmentLoan $equipmentLoan)
    // {

    //     if (!$request->has('loan_detail_items')) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'loan_detail_items tidak ditemukan dalam request'
    //         ], 400);
    //     }

    //     // dd($request->all());

    //     try {
    //         DB::beginTransaction();
    //         if ($request->is_staff) {
    //             $equipmentLoan->is_returner_staff = 1;
    //             $equipmentLoan->staff_id_returner = $request->staffReturner;
    //         } else {
    //             $equipmentLoan->is_returner_staff = 0;
    //             $equipmentLoan->returner_nim = $request->returnerNim;
    //             $equipmentLoan->returner_name = $request->returnerName;
    //             $equipmentLoan->returner_group_class = $request->returnerGroupClass;
    //         }
    //         $equipmentLoan->return_date = Carbon::createFromFormat('d/m/Y H:i', $request->return_date." ".$request->return_time)->toDateTimeString();
    //         $equipmentLoan->lab_member_id_return = Auth::user()->labMembers->firstWhere('laboratory_id', $equipmentLoan->laboratory_id)->id;
    //         $equipmentLoan->status = 2;

    //         $equipmentLoan->save();

    //         $returnStockCards = [];

    //         $loanDetailItems = collect($request->loan_detail_items);
    //         foreach ($equipmentLoan->loanDetails as $loanDetail) {
    //             $returnStockCard = StockCard::create([
    //                 'qty' => $loanDetailItems->firstWhere('loanDetailId', $loanDetail->id)['returnQty'],
    //                 'stock' => $loanDetail->labItem->stock,
    //                 'is_stock_in' => 1,
    //                 'description' => $loanDetail->description,
    //                 'system_description' => "Return stock from PracticumEquipmentLoan",
    //                 'lab_item_id' => $loanDetail->lab_item_id,
    //                 'lab_member_id' => Auth::user()->labMembers->firstWhere('laboratory_id', $equipmentLoan->laboratory_id)->id,
    //             ]);

    //             $returnStockCards[] = $returnStockCard;

    //             $loanDetail->return_qty = $loanDetailItems->firstWhere('loanDetailId', $loanDetail->id)['returnQty'];
    //             $loanDetail->stock_card_id_return = $returnStockCard->id;
    //             $loanDetail->status = $loanDetailItems->firstWhere('loanDetailId', $loanDetail->id)['returnQty'] < $loanDetail->qty? 2 : 1;
    //             $loanDetail->save();

    //             $loanDetail->labItem->stock = $loanDetail->labItem->stock + $loanDetail->return_qty;
    //             $loanDetail->labItem->save();
    //         }

    //         DB::commit();
    //         return response()->json([
    //             'status' => "success",
    //             'message' => "Laporan peminjaman alat praktikum berhasil diubah"
    //         ]);
    //         // DB::rollback();
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         dd($e->getMessage());
    //         return response()->json([
    //             'status' => "error",
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(EquipmentLoan $equipmentLoan)
    // {
    //     //
    // }
}
// return response()->json([
        //     $equipmentLoan->load('loanDetails'),
        //     $request->all,
        //     Auth::user()->labMembers
        // ]);
// return response()->json([
            //     $equipmentLoan->load('loanDetails'),
            //     $request->all,
            //     $returnStockCards,
            //     Auth::user(),
            // ]);

            // dd($this->equipmentLoan);
