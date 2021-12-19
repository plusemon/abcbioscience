<?php

namespace App\Http\Controllers\Backend\Sheet;

use App\Http\Controllers\Controller;
use App\Model\StudentSheetSetting;
use App\Model\SheetSetting;
use App\Models\Sheet;
use Illuminate\Http\Request;


use App\Model\StudentQuestionSetting;
use App\Model\Mcqsheetting;
use App\Model\sheetting;


use App\Model\FeeAmountSetting;
use App\Model\FeeSetting;

use App\Model\FeeCategory;
use App\Model\FeeActionType;

use App\Models\Section;
use App\Models\Sessiones;
use App\Models\Classes;
use App\Models\Batch;

use App\Model\McqQuestionSubject;
use App\Model\PayTime;
use App\Model\BatchType;
use App\Models\BatchSetting;
use App\Models\StudentType;
use App\Models\Student;
use DB;
use Validator;
use Auth;

class StudentSheetSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sheets'] = StudentSheetSetting::whereNull('deleted_at')
        ->where('download_capability',1)
        ->select('*',DB::raw('COUNT(id) as totalApprovedStudenForExam'))
        ->latest()
        ->groupBy(['batch_setting_id','batch_type_id','fee_cat_id','sheet_type_id',
            'class_id' , 'session_id'
        ])
        ->where('fee_cat_id',6)
        ->paginate(100);
        return view('backend.sheet.student_setting.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /*though it is not using, but maybe will be uses */
        $data['classes']            = Classes::where('status',1)->get();
        $data['sessiones']          = Sessiones::where('status',1)->get();
        /*though it is not using, but maybe will be uses */

        $data['batchTypies']        = BatchType::where('status',1)->get();
        $data['payTimes']           = PayTime::where('status',1)->get();

        $sSetting                           = SheetSetting::find($request->sid);
        
        
        
        

        $sheet                              = Sheet::find($sSetting?$sSetting->sheet_id:NULL);
        $data['subjectName']                = $sheet?$sheet->subjects?$sheet->subjects->name:NULL:NULL;
        $data['subject_id']                 = $sheet?$sheet->subject_id:NULL;

        $data['sheet_id']                   = $sSetting->sheet_id;
        $data['sheetName']                  = $sheet?$sheet->sheet_no:NULL;

        $data['class_id']                   = $sheet?$sheet->class_id:NULL;
        $data['className']                  = $sheet?$sheet->classes?$sheet->classes->name:NULL:NULL;
        $data['session_id']                 = $sheet?$sheet->session_id:NULL;
        $data['sessionName']                = $sheet?$sheet->sessiones?$sheet->sessiones->name:NULL:NULL;

        $data['sheet_type_id']              = $sheet?$sheet->sheet_type_id:NULL;
        $data['sheetTypeName']              = $sheet?$sheet->sheetTypes?$sheet->sheetTypes->name:NULL:NULL;

        $data['batchSettingName']           = $sSetting?$sSetting->batchsetting?$sSetting->batchsetting->batch_name:NULL:NULL;
        $data['batchSettingId']             = $sSetting?$sSetting->batch_setting_id:NULL;

        $data['batchTypeName']              = $sSetting?$sSetting->batchTypies?$sSetting->batchTypies->name:NULL:NULL;
        $data['batchTypeId']                = $sSetting?$sSetting->batch_type_id:NULL;

        $data['sheet_stting']               = $sSetting ;


        /**Batch Setting by class and session id */
        $data['batches'] = BatchSetting::where('status',1)
                ->where('sessiones_id',$data['session_id'])
                ->where('classes_id',$data['class_id'])
                ->latest()
                ->get();
        /**Batch Setting by class and session id */
        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
                                ->where('fee_category_type_id',2)
                                ->where('status',1)
                                //->latest()
                                ->get();

        //$data['examination_type_id']        = $sheet?$sheet->examination_type_id:NULL;
        return view('backend.sheet.student_setting.create',$data);
    }




    public function sheetStudentSettingCreateStudentList(Request $request)
    {
        $request->class_id;
        $request->session_id;
        $request->batch_setting_id;
        $request->batch_type_id;
        $request->sheet_id;
        $data['sheet_type_id'] = $request->sheet_type_id;

        $data['students'] = Student::where('activate_status',1)
                ->where('batch_setting_id',$request->batch_setting_id)//
                ->where('class_id',$request->class_id)
                ->where('session_id',$request->session_id)
                ->where('batch_type_id',$request->batch_type_id)
                ->get();

        $data['exam_setting_id'] = $request->exam_setting_id;
        $html = view('backend.sheet.student_setting.ajax_student_list',$data)->render();
        if($data['students'])
        {
            return response()->json([
                'status'    => true,
                'html'      => $html
            ]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $existdata = StudentSheetSetting::whereNull('deleted_at')
                ->where('subject_id',$request->subject_id)
                ->where('class_id',$request->class_id)
                ->where('session_id',$request->session_id)
                ->where('batch_setting_id',$request->batch_setting_id)
                ->where('batch_type_id',$request->batch_type_id)
                ->where('sheet_id',$request->sheet_id)
                ->where('fee_cat_id',$request->fee_cat_id)
                ->where('fee_amount_setting_id',$request->fee_amount_setting_id)
                ->where('sheet_setting_id',$request->sheet_setting_id)
                ->where('sheet_type_id',$request->sheet_type_id)
                ->where('student_id',$request->student_id)
                ->first();

            if($existdata)
            {
                if($request->action_type == 'in_active' && $existdata->download_capability == 1)
                {
                    $existdata->download_capability = NULL;
                    $capability = "Inactive";
                }else{
                    $existdata->download_capability = 1;
                    $capability = "active";
                }
                $existdata->save();
            }
            else{
                $studentQSet = new StudentSheetSetting();
                $studentQSet->class_id              =   $request->class_id;
                $studentQSet->session_id            =   $request->session_id;
                $studentQSet->batch_setting_id      =   $request->batch_setting_id;
                $studentQSet->batch_type_id         =   $request->batch_type_id;
                $studentQSet->fee_cat_id            =   $request->fee_cat_id;
                $studentQSet->fee_amount_setting_id =   $request->fee_amount_setting_id;
                $studentQSet->sheet_id              =   $request->sheet_id;
                $studentQSet->sheet_type_id         =   $request->sheet_type_id;
                $studentQSet->subject_id            =   $request->subject_id;
                $studentQSet->sheet_setting_id      =   $request->sheet_setting_id;
                $studentQSet->student_id            =   $request->student_id;
                $studentQSet->download_capability   =   1;
                $studentQSet->created_by            =   Auth::user()->id;
                $studentQSet->save();
                $capability  = "active";
            }
            DB::commit();

            return response()->json([
                'status'    => true,
                'capability' => $capability
            ]);
        }
        catch(\Exception $e) {
            DB::rollback();
            if($e->getMessage())
            {
                // $message = "Something went wrong! Please Try again";
                $message = $e->getMessage();
            }
            $notification = array(
                'message' => 'Failed to Submit Student Info!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($message);
        }
    }




    public function bulkstore(Request $request)
    {
         
         $input = $request->all();



 
    
        if($request->has('active')){

            if(!empty($input['student_batch_id']))
            {


                    $checkdata = StudentSheetSetting::whereNull('deleted_at')
                                    ->where('subject_id',$request->subject_id)
                                    ->where('class_id',$request->class_id)
                                    ->where('session_id',$request->session_id)
                                    ->where('batch_setting_id',$request->batch_setting_id)
                                    ->where('batch_type_id',$request->batch_type_id)
                                    ->where('sheet_id',$request->sheet_id)
                                    ->where('fee_cat_id',$request->fee_cat_id)
                                    ->where('fee_amount_setting_id',$request->fee_amount_setting_id)
                                    ->where('sheet_setting_id',$request->sheet_setting_id)
                                    ->where('sheet_type_id',$request->sheet_type_id)
                                    ->where('student_id',$request->student_batch_id)
                                    ->count();


                   if($checkdata>0){
 
                        $notification = array(
                                'message' => 'Student Permission Already Inserted!',
                                'alert-type' => 'error'
                        );
                        return redirect()->back()->with($notification);
                   }
                   else{
                     foreach ($input['student_batch_id'] as $key => $value) {
                    

                        $studentQSet = new StudentSheetSetting();
                        $studentQSet->class_id              =   $request->class_id;
                        $studentQSet->session_id            =   $request->session_id;
                        $studentQSet->batch_setting_id      =   $request->batch_setting_id;
                        $studentQSet->batch_type_id         =   $request->batch_type_id;
                        $studentQSet->fee_cat_id            =   $request->fee_cat_id;
                        $studentQSet->fee_amount_setting_id =   $request->fee_amount_setting_id;
                        $studentQSet->sheet_id              =   $request->sheet_id;
                        $studentQSet->sheet_type_id         =   $request->sheet_type_id;
                        $studentQSet->subject_id            =   $request->subject_id;
                        $studentQSet->sheet_setting_id      =   $request->sheet_setting_id;
                        $studentQSet->student_id            =   $input['student_batch_id'][$key];
                        $studentQSet->download_capability   =   1;
                        $studentQSet->created_by            =   Auth::user()->id;
                        $studentQSet->save();
                       }

                }
             }

        }
        elseif ($request->has('inactive')) {

            if(!empty($input['student_batch_id']))
            {
 
                    foreach ($input['student_batch_id'] as $key => $value) {

                          $updatedata = StudentSheetSetting::whereNull('deleted_at')
                            ->where('subject_id',$request->subject_id)
                            ->where('class_id',$request->class_id)
                            ->where('session_id',$request->session_id)
                            ->where('batch_setting_id',$request->batch_setting_id)
                            ->where('batch_type_id',$request->batch_type_id)
                            ->where('sheet_id',$request->sheet_id)
                            ->where('fee_cat_id',$request->fee_cat_id)
                            ->where('fee_amount_setting_id',$request->fee_amount_setting_id)
                            ->where('sheet_setting_id',$request->sheet_setting_id)
                            ->where('sheet_type_id',$request->sheet_type_id)
                            ->where('student_id',$input['student_batch_id'][$key])
                            ->first();
            
                            $updatedata->download_capability       =   NULL;
                            $updatedata->created_by            =   Auth::user()->id;
                            $updatedata->save(); 

                    }
             }

  

        }


        $notification = array(
                'message' => 'Student Permission Successfully Completed!',
                'alert-type' => 'success'
            );
        return redirect()->back()->with($notification);



    }














    /**
     * Display the specified resource.
     *
     * @param  \App\Model\StudentSheetSetting  $studentSheetSetting
     * @return \Illuminate\Http\Response
     */
    public function show(StudentSheetSetting $studentSheetSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\StudentSheetSetting  $studentSheetSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentSheetSetting $studentSheetSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\StudentSheetSetting  $studentSheetSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentSheetSetting $studentSheetSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\StudentSheetSetting  $studentSheetSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentSheetSetting $studentSheetSetting)
    {
        //
    }
}
