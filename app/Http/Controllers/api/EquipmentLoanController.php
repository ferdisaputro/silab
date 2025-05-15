<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\EquipmentLoan;
use Illuminate\Http\Request;

class EquipmentLoanController extends Controller
{
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipmentLoan $equipmentLoan)
    {
        //
    }
}
