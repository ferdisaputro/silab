<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studyPrograms = StudyProgram::get()->load( 'headOfStudyPrograms','headOfStudyPrograms.staff.user','department');
        $studyPrograms = $studyPrograms->each(function ($studyProgram) {
            $studyProgram->formatedHeadOfStudyPrograms = $studyProgram->headOfStudyPrograms->map(function ($headOfStudyProgram) {
                return [
                    'id' => $headOfStudyProgram->id,
                    'staff_id' => $headOfStudyProgram->staff_id,
                    'study_program_id' => $headOfStudyProgram->study_program_id,
                    'name' => $headOfStudyProgram->staff->user->name,
                ];
            });
        });
        return response()->json($studyPrograms);
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
    public function show(StudyProgram $studyProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudyProgram $studyProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudyProgram $studyProgram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyProgram $studyProgram)
    {
        //
    }
}
