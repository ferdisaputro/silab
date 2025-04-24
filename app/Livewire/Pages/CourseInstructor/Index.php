<?php

namespace App\Livewire\Pages\CourseInstructor;

use App\Models\Staff;
use App\Models\Course;
use Livewire\Component;
use App\Models\Semester;
use App\Models\Department;
use App\Models\AcademicYear;
use App\Models\SemesterCourse;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $listeners = ['setLecturer', 'setCourse'];

    #[Validate('required|integer|exists:departments,id')]
    public $departmentId; // id of department table
    #[Validate('required|integer|exists:study_programs,id')]
    public $studyProgramId; // id of study program table
    #[Validate('required|integer|exists:academic_years,id')]
    public $academicYearId; // id of academic year table
    #[Validate('required|integer|exists:semesters,id')]
    public $semesterId; // id of semester table

    #[Validate(rule: ['semesterCoursesList.*' => 'required|integer|exists:staff,ids'])]
    public $semesterCoursesList = [
        // [
        //     'course_id' => $semesterCourse->course->id,
        //     'lecturer_id' => null,
        // ]
    ];

    public $selectedLecturer;
    public $selectedCourse;

    public function updatedDepartmentId() {
        $this->studyProgramId = null;
    }

    public function updatedAcademicYearId() {
        $this->semesterId = null;
    }

    #[Computed()]
    public function departments() {
        return Department::all();
    }

    #[Computed()]
    public function studyPrograms() {
        $department = Department::find($this->departmentId);
        return $department ? $department->studyPrograms()->get() : [];
    }

    #[Computed()]
    public function academicYears() {
        return AcademicYear::all();
    }

    #[Computed()]
    public function semesters() {
        $academicYear = AcademicYear::find($this->academicYearId);
        return $academicYear ? $academicYear->semesters()->get() : [];
    }

    public $isSemesterCoursesFetched = false;
    #[Computed()]
    public function semesterCourses() {
        $semester = Semester::find($this->semesterId);
        $semesterCourses = $semester ? $semester->semesterCourses->where('study_program_id', $this->studyProgramId)->load('course', 'courseInstructor') : [];
        return $semesterCourses;
    }

     public function edit() {
        $this->authorize('hasPermissionTo', 'setpengampu-create');
        try {
            DB::beginTransaction();
            $semesterCoursesList = collect($this->semesterCoursesList)->filter(function($data) {
                return $data !== null;
            });
            $courseIds = $semesterCoursesList
                        ->pluck('course_id')
                        ->filter();
            $semesterCourses = SemesterCourse::where('study_program_id', $this->studyProgramId)
                                            ->where('semester_id', $this->semesterId)
                                            ->whereIn('course_id', $courseIds)
                                            ->get()->load('courseInstructor');

            foreach ($semesterCoursesList as $list) {
                $semesterCourse = $semesterCourses->firstWhere('course_id', $list['course_id']);

                if (isset($semesterCourse->courseInstructor) && (!isset($list['lecturer_id']) || $list['lecturer_id'] == "")) {
                    $semesterCourse->courseInstructor->delete();
                } else if(isset($list['lecturer_id']) && $list['lecturer_id'] !== "") {
                    $semesterCourse->courseInstructor()->updateOrCreate([
                        'semester_course_id' => $semesterCourse->id,
                    ], [
                        'semester_course_id' => $semesterCourse->id,
                        'staff_id' => $list['lecturer_id'],
                        'user_id' => Auth::user()->id,
                    ]);
                }
            }
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Setting pengaturan dosen pengampu disimpan']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'setpengampu-list');
    }

    public function render()
    {
        return view('livewire.pages.course-instructor.index', [
            'lecturers' => Staff::where('status', 1)->where("staff_status_id", 1)->with('user')->get()
        ]);
    }
}
