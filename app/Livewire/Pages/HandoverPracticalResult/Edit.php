<?php

namespace App\Livewire\Pages\HandoverPracticalResult;

use App\Models\AcademicWeek;
use App\Models\AcademicYear;
use App\Models\LabItem;
use App\Models\Laboratory;
use App\Models\practicumLeftOver;
use App\Models\PracticumResult;
use App\Models\PracticumResultHandover;
use App\Models\Semester;
use App\Models\SemesterCourse;
use App\Models\Staff;
use App\Models\StockCard;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public $code;
    public $practicum_event;
    public $borrowingDate;
    public $handOver;

    public $laboratoryId;
    public $id;

    public $selectedStudyProgram;
    #[Computed()]
    public function studyPrograms() {
        $department = Laboratory::find($this->laboratoryId)->department;
        return $department ? $department->studyPrograms : collect();
    }
    public $selectedAcademicYear;
    #[Computed()]
    public function academicYears(){
        return AcademicYear::all();
    }
    public $selectedAcademicWeek;
    #[Computed()]
    public function academicWeeks(){
        return AcademicWeek::where('academic_year_id',$this->selectedAcademicYear)->get();
    }
    public $selectedSemester;
    #[computed()]
    public function semesters() {
        return Semester::where('academic_year_id', $this->selectedAcademicYear)->get();
    }
    public $selectedCourse;
    #[computed()]
    public function Courses() {
        return SemesterCourse::where('semester_id',$this->selectedSemester)
                        ->where('study_program_id',$this->selectedStudyProgram)
                        ->get()->load('course')->pluck('course');
    }
    public $selectedCourseInstructor;
    #[Computed()]
    public function courseInstructor(){
        // return Staff::where("status", 1)->where('staff_status_id', 1)->get()->load('user');
        return SemesterCourse::firstWhere([
            'semester_id' => $this->selectedSemester,
            'study_program_id' => $this->selectedStudyProgram,
            'course_id' => $this->selectedCourse
        ])?->load('courseInstructor.staff.user')->courseInstructor?? null;
    }

    #[Computed()]
    public function LabMaterials(){
        return Laboratory::find($this->laboratoryId ?? null)
            ->labItems
            ->load('item')
            ->filter(function ($labItem) {
                return $labItem->item->item_type_id == 2;
            });
    }
    #[Computed()]
    public function LabPracticums(){
        return Laboratory::find($this->laboratoryId ?? null)
            ->labItems
            ->load('item')
            ->filter(function ($labItem) {
                return $labItem->item->item_type_id == 3;
            });
    }
    public function mount($id) {
        try {
            $this->id= Crypt::decrypt($id);
            $handOver = PracticumResultHandover::find($this->id)->load('courseInstructor.semesterCourse.studyProgram');
            $this->laboratoryId = $handOver->laboratory_id;
            $this->selectedStudyProgram = $handOver->courseInstructor->semesterCourse->study_program_id;
            $this->selectedAcademicYear = $handOver->courseInstructor->semesterCourse->semester->academic_year_id;
            $this->selectedSemester = $handOver->courseInstructor->semesterCourse->semester_id;
            $this->selectedCourse = $handOver->courseInstructor->semesterCourse->course_id;
            $this->selectedCourseInstructor = $handOver->courseInstructor->id;
            $this->selectedAcademicWeek = $handOver->academic_week_id;
            $this->borrowingDate = Carbon::parse($handOver->date)->format('d/m/Y');
            $this->practicum_handOver_leftOver_Result = $handOver;
            $this->practicum_event = $handOver->practicum_event;
            $this->code = Str::random(8);

            $this->materialItems = $this->practicum_handOver_leftOver_Result->practicumResultLeftOver->map(function($bahanItem) {
                return [
                    // 'id' => $item->id,
                    'material' => $bahanItem->lab_item_id,
                    'qty' => $bahanItem->qty,
                    'unit' => $bahanItem->unit_id,
                ];
            })->toArray();

            $this->practicumResults = $this->practicum_handOver_leftOver_Result->practicumResult->map(function($practicumItem){
                return[
                    'pracRes' => $practicumItem->lab_item_id,
                    'qty' => $practicumItem->qty
                ];
            })->toArray();

        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }
    }
    protected function getSemesterCourse(){
        $semesterCourse = SemesterCourse::firstWhere([
            'semester_id' => $this->selectedSemester,
            'study_program_id' => $this->selectedStudyProgram,
            'course_id' => $this->selectedCourse
        ]);
        return $semesterCourse;
    }
    public $practicum_handOver_leftOver_Result;

    // public function ddData() {
    //     dd(true);
    // }

    public function edit() {
        $this->practicum_handOver_leftOver_Result->update([
            'practicum_event' => $this->practicum_event,
            'date' => Carbon::createFromFormat('d/m/Y', $this->borrowingDate)->format('Y-m-d'),
            'academic_week_id' => $this->selectedAcademicWeek,
            'course_instructor_id' => $this->getSemesterCourse()->courseInstructor->id,
        ]);

        try {
            DB::beginTransaction();

            // dd($this->deletepracticumList);

            // dd($this->handleDeletions($this->deletepracticumList, 'practicumResult'));
            $this->handleDeletions($this->deletepracticumList, 'practicumResult', 'pracRes');
            $this->handleDeletions($this->deletedMaterialItems, 'practicumResultLeftOver', 'material');

            // dd($this->materialItems);
            // Handle updates and creations
            $this->handleUpdatesAndCreations($this->practicumResults, 'practicumResult');
            $this->handleUpdatesAndCreations($this->materialItems, 'practicumResultLeftOver');

            DB::commit();

            return response()->json([
                'status' => "success",
                'message' => "Laporan Serah Terima berhasil diubah"
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => "error",
                'message' => $e->getMessage()
            ]);
        }
    }

    private function handleDeletions($items, $relation, $keyName) {
        $this->practicum_handOver_leftOver_Result->load([
            'practicumResult',
            'practicumResultLeftOver'
        ]);
        try {
            if (count($items) > 0) {
                $deletedItems = LabItem::whereIn('id', collect($items)->pluck($keyName))->get()->load('item');
                foreach ($deletedItems as $deletedItem) {
                    $detail = $this->practicum_handOver_leftOver_Result->$relation->firstWhere('lab_item_id', $deletedItem->id);
                    if ($detail) {
                        // Kurangi stok lab item berdasarkan qty sebelum delete
                        $detail->labItem->update([
                            'stock' => $detail->labItem->stock - $detail->qty
                        ]);

                        // Hapus stock card dan detailnya
                        if ($detail->stockCard) {
                            $detail->stockCard->delete();
                        }

                        $detail->delete();
                    }
                }
            }
        } catch (\exception $th) {
            DB::rollback();
            return response()->json([
                'status' => "error",
                'message' => $th->getMessage()
            ]);
        }

    }

    private function handleUpdatesAndCreations($items, $relation) {
        foreach ($items as $item) {
            $existingDetail = $this->practicum_handOver_leftOver_Result->$relation->firstWhere('lab_item_id', $item['material'] ?? $item['pracRes']);
            $labItemId = $item['material'] ?? $item['pracRes'];
            $qty = $item['qty'];

            if ($existingDetail) {
                $existingDetail->update([
                    'qty' => $qty,
                    'description' => "update"
                ]);
                $existingDetail->labItem->update([
                    'stock' => $existingDetail->stockCard->stock + $qty
                ]);
            } else {
                $stockCard = StockCard::create([
                    'qty' => $qty,
                    'stock' => LabItem::find($labItemId)->stock,
                    'is_stock_in' => 1,
                    'description' => "N/A",
                    'lab_item_id' => $labItemId,
                    'lab_member_id' => Auth::user()->labMembers->firstWhere('laboratory_id', $this->practicum_handOver_leftOver_Result->laboratory_id)->id,
                ]);

                $relationModel = $relation === 'practicumResult' ? PracticumResult::class : practicumLeftOver::class;
                $createdDetail = $relationModel::create([
                    'code' => $this->code,
                    'qty' => $qty,
                    'description' => "N/A",
                    'practicum_result_leftover_handover_id' => $this->practicum_handOver_leftOver_Result->id,
                    'lab_item_id' => $labItemId,
                    'stock_card_id' => $stockCard->id,
                    'unit_id' => LabItem::find($labItemId)->item->unit_id,
                ]);

                $createdDetail->labItem->update([
                    'stock' => $createdDetail->labItem->stock + $qty
                ]);
            }
        }
    }



    public $deletepracticumList = [];

    #[Validate([
        'practicumResults.*.pracRes' => 'required|min:0',
        'practicumResults.*.qty' => 'required|min:0',
    ])]
    public $practicumResults = [
        [
            'pracRes' => '', // material
            'qty' => '', // qty
        ]
    ];

    public function addPracticumResult() {
        $this->practicumResults[] = [
            'pracRes' => '',
            'qty' => '',
            'is_praktikum_new' => '' //new

        ];
    }
    public function removePracticumResult($index) {
        $this->deletepracticumList[] = $this->practicumResults[$index];
        unset($this->practicumResults[$index]);
        if (count($this->practicumResults) == 0) {
            $this->practicumResults = [];
            $this->addPracticumResult();
        }
    }
    public $deletedMaterialItems = [];
    #[Validate([
        'materialItems.*.pracRes' => 'required|min:0',
        'materialItems.*.qty' => 'required|min:0',
    ])]
    public $materialItems = [
        [
            'material' => '', // material
            'qty' => '', // qty
            'unit' => '', // tahun ajaran
        ]
    ];
    public function addMaterialItem() {
        $this->materialItems[] = [
            'material' => '',
            'qty' => '',
            'unit' => '',
            'is_material_new' => '' //new
        ];
    }
    public function removeMaterialItem($index) {
        $this->deletedMaterialItems[] = $this->materialItems[$index];
        unset($this->materialItems[$index]);
        if (count($this->materialItems) == 0) {
            $this->materialItems = [];
            $this->addMaterialItem();
        }
        // $this->selectedItems = array_values($this->selectedItems); // reindex biar rapi
    }


    // public function updatedItems($value, $key)
    // {
    //     // contoh $key = "0.material"
    //     if (Str::endsWith($key, 'material')) {
    //         $index = explode('.', $key)[0];
    //         $labItemId = $value;

    //         $labItem = LabItem::with('item.unit')->find($labItemId);
    //         $unitId = $labItem?->item?->unit?->id;

    //         // Simpan unit_id (unit) ke dalam field unit
    //         if ($unitId) {
    //             $this->items[$index]['unit'] = $unitId;
    //         }
    //     }
    // }
    public function redirectToIndex() {
        $this->redirectRoute('handover-practical-result', navigate: true);
    }



    public function render()
    {
        return view('livewire.pages.handover-practical-result.edit');
    }
}
