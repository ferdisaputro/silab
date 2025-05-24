<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laboratories = Laboratory::get()->load( 'members', 'members.staff.user', 'labItems');
        $laboratories = $laboratories->each(function ($laboratory) {
            $laboratory->formatedHeadOfLab = $laboratory->members->map(function ($member) {
                return [
                    'id' => $member->id,
                    'is_lab_leader' => $member->is_lab_leader,
                    'staff_id' => $member->staff_id,
                    'laboratory_id' => $member->laboratory_id,
                    'name' => $member->staff->user->name,
                ];
            });
        });
        return response()->json($laboratories);
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
    public function show(Laboratory $laboratory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laboratory $laboratory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laboratory $laboratory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laboratory $laboratory)
    {
        //
    }
}
