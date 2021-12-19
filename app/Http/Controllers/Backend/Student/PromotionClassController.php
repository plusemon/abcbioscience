<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentInfo;
use App\Models\Month;
use App\Models\Year;
use App\Models\Section;
use App\Models\Sessiones;
use App\Models\Classes;
use App\User;
use App\Models\AbsentStudent;
use App\Models\Batch;
use App\Model\BatchType;
use App\Models\BatchSetting;
use App\Models\StudentType;
use DB;
use Validator;
class PromotionClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function promotionFromByAjax(Request $request)
    {
        $user_id                    = $request->user_id;
        $current_class_id           = $request->current_class_id;
        $current_session_id         = $request->current_session_id;
        $current_batch_setting_id   = $request->current_batch_setting_id;
        $current_batch_type_id      = $request->current_batch_type_id;
        $action_type                = $request->action_type;

        $data['classes']        = Classes::where('status',1)
                                    ->when($action_type == 2,function($q) use($current_class_id)
                                    {
                                        $q->whereNotIn('id',[$current_class_id]);
                                    })
                                    ->get();
        $data['sessiones']      = Sessiones::where('status',1)
                                    ->when($action_type == 2,function($q) use($current_session_id)
                                    {
                                        $q->whereNotIn('id',[$current_session_id]);
                                    })
                                    ->get();

        $data['sectiones']      = Section::where('status',1)->get();
        $data['student_typies'] = StudentType::where('status',1)->get();

        $previousStudent = Student::where('user_id',$user_id)
                            ->when($current_class_id,function($qq) use($current_class_id)
                            {
                                $qq->where('class_id',$current_class_id);
                            })
                            ->when($current_session_id,function($qt) use($current_session_id)
                            {
                                $qt->where('session_id',$current_session_id);
                            })
                            ->when($current_batch_setting_id,function($qtq) use($current_batch_setting_id)
                            {
                                $qtq->where('batch_setting_id',$current_batch_setting_id);
                            })
                            ->when($current_batch_type_id,function($qtdq) use($current_batch_type_id)
                            {
                                $qtdq->where('batch_type_id',$current_batch_type_id);
                            })
                        // ->where('class_id',$current_class_id)
                        // ->where('session_id',$current_session_id)
                        // ->where('batch_setting_id',$current_batch_setting_id)
                        // ->where('batch_type_id',$current_batch_type_id)
                        ->where('activate_status',1)
                        ->orderBy('id','DESC')
                        ->first();
        $currentStudentId         = $previousStudent?$previousStudent->id : NULL;
        $currentClassName         = $previousStudent?$previousStudent->classes ?$previousStudent->classes->name : NULL : NULL;
        $currentSessionName       = $previousStudent?$previousStudent->sessiones ?$previousStudent->sessiones->name : NULL : NULL;
        $currentBatchSettingName  = $previousStudent?$previousStudent->batchsetting ?$previousStudent->batchsetting->batch_name : NULL : NULL;
        $currentBatchTypeName     = $previousStudent?$previousStudent->batchTypes ?$previousStudent->batchTypes->name : NULL : NULL;
        
        $previousClassId         = $previousStudent?$previousStudent->class_id : NULL;
        $previousSessionId       = $previousStudent?$previousStudent->session_id : NULL;
        $previousBatchSettingId  = $previousStudent?$previousStudent->batch_setting_id : NULL;
        $previousBatchTypeId     = $previousStudent?$previousStudent->batch_type_id : NULL;
                            


        $existingHtml = ''; 
        $existingHtml .= '<h3>'. "Student's Current Data" .'</h3>';
        $existingHtml .= '<ul>';
        $existingHtml .= '<li>' . 'Class : <strong>'. $currentClassName .'</strong></li>';
        $existingHtml .= '<li>' . 'Session : <strong>'. $currentSessionName .'</strong></li>';
        $existingHtml .= '<li>' . 'Batch : <strong>'. $currentBatchSettingName .'</strong></li>';
        $existingHtml .= '<li>' . 'Batch Type: <strong>'. $currentBatchTypeName .'</strong></li>';
        $existingHtml .= '</ul>'; 

        $hiddenData =   '';
        $hiddenData .=  '<input type="hidden" class="previousUserId" name="user_id" value="'.$user_id .'"/>';
        $hiddenData .=  '<input type="hidden" class="studentId" name="previous_student_id" value="'.$currentStudentId .'"/>';
        $hiddenData .=  '<input type="hidden" class="previousClassId" name="previous_class_id" value="'.$current_class_id .'"/>';
        $hiddenData .=  '<input type="hidden" class="previousSessionId" name="previous_session_id" value="'.$current_session_id .'"/>';
        $hiddenData .=  '<input type="hidden" class="previousBatchSettingId" name="previous_batch_setting_id" value="'.$current_batch_setting_id .'"/>';
        $hiddenData .=  '<input type="hidden" class="previousBatchTypeId" name="previous_batch_type_id" value="'.$current_batch_type_id .'"/>';
        $hiddenData .=  '<input type="hidden" class="actionType" name="action_type" value="'.$action_type .'"/>';
        
        $hiddenData .=  '<input type="hidden" class="previousClass_id" name="previousClass_id" value="'.$previousClassId .'"/>';
        $hiddenData .=  '<input type="hidden" class="previousSession_id" name="previousSession_id" value="'.$previousSessionId .'"/>';
        $hiddenData .=  '<input type="hidden" class="previousBatchSetting_id" name="previousBatchSetting_id" value="'.$previousBatchSettingId .'"/>';
        $hiddenData .=  '<input type="hidden" class="previousBatchType_id" name="previousBatchType_id" value="'.$previousBatchTypeId .'"/>';
        
        
        $data['batchTypies']    = BatchType::whereNull('deleted_at')->get();
        
        $data['schoolName']      = $previousStudent?$previousStudent->school_name : NULL;
        $data['months']         = Month::get();
        $html = view('backend.students.promotion_class.promotion_form',$data)->render();
        return response()->json([
            'status'    => true,
            'html'      =>  $html,
            'existingHtml'=> $existingHtml,
            'hiddenData'=> $hiddenData,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $surrentStudent = NULL;
        $makeUrl = NULL;
        $userId = NULL;
        $fromAnotherLink = NULL;
        $onlyUser = NULL;
        if(isset($_GET['student_id']))
        {
            $data['studentGetId'] = $_GET['student_id'];
            $userId     = $data['studentGetId'];
            $makeUrl    .= "?id=".$request['student_id'];
            $fromAnotherLink =  User::where('users.id',$_GET['student_id'])->first();
        }

        $data['current_class_id']           = $request['current_class_id'] ;
        $data['current_session_id']         = $request['current_session_id'] ;
        $data['current_section_id']         = $request['current_section_id'] ;
        $data['current_batch_setting_id']   = $request['current_batch_setting_id'] ;
        $data['current_roll']               = NULL;
        $data['studentGetId']               = NULL;

        if($fromAnotherLink)
        {
            $data['current_class_id']           = $fromAnotherLink->students?$fromAnotherLink->students->class_id:NULL;
            $data['current_session_id']         = $fromAnotherLink->students?$fromAnotherLink->students->session_id:NULL;
            $data['current_section_id']         = $fromAnotherLink->students?$fromAnotherLink->students->section_id:NULL;
            $data['current_batch_setting_id']   = $fromAnotherLink->students?$fromAnotherLink->students->batch_setting_id:NULL;
            $data['current_roll']               = $fromAnotherLink->students?$fromAnotherLink->students->roll:NULL;
            $currentClassId         = $data['current_class_id'] ;
            $currentSessionId       = $data['current_session_id'] ;
            $currentSectionId       = $data['current_section_id'] ;
            $currentBatchSettingId  = $data['current_batch_setting_id'] ;
        }
        else{
            $currentClassId         = $request['current_class_id'] ;
            $currentSessionId       = $request['current_session_id'] ;
            $currentSectionId       = $request['current_section_id'] ;
            $currentBatchSettingId  = $request['current_batch_setting_id'] ;
        }
        $u = User::query();
            $u->where('users.id',$userId);
            $u->when($currentClassId,function($j) use ($currentClassId,$currentSessionId,$currentSectionId,$currentBatchSettingId){
                $j->join('students','students.user_id','=','users.id')
                ->where('students.class_id',$currentClassId)
                ->where('students.session_id',$currentSessionId)
                ->where('students.section_id',$currentSectionId)
                ->where('students.activate_status',1)
                ->where('students.batch_setting_id',$currentBatchSettingId);
            });
            $currentStdn = $u->whereNull('users.deleted_at')
                ->where('users.role_id',3)
                ->where('users.status',1)
                ->first();
            if($currentStdn)
            {
                $onlyUser = $currentStdn;
                if($currentStdn->class_id)
                {
                    $onlyUser = User::findOrFail($userId);
                }
            }

        if($currentStdn && $request['current_class_id'] && $data['studentGetId'])
        {
            $data['current_class']           = $currentStdn->students?$currentStdn->students->class_id:NULL;
            $data['current_session']         = $currentStdn->students?$currentStdn->students->session_id:NULL;
            $data['current_section']         = $currentStdn->students?$currentStdn->students->section_id:NULL;
            $data['current_batch_setting']   = $currentStdn->students?$currentStdn->students->batch_setting_id:NULL;
            $data['current_roll']            = $currentStdn->students?$currentStdn->students->roll:NULL;
        }

        $data['classes']        = Classes::where('status',1)->get();
        $data['sessiones']      = Sessiones::where('status',1)->get();
        $data['sectiones']      = Section::where('status',1)->get();
        $data['months']         = Month::get();
        $data['student_typies'] = StudentType::where('status',1)->get();


        $data['newClasses']     = Classes::where('status',1)
                                ->when($currentClassId,function($c)use($currentClassId){
                                    $c->whereNotIn('id',[$currentClassId]);
                                })
                                ->get();
        $data['newSessiones']   = Sessiones::where('status',1)
                                ->when($currentSessionId,function($s)use($currentSessionId){
                                    $s->whereNotIn('id',[$currentSessionId]);
                                })
                                ->get();

        $data['allstudents'] = User::whereNull('deleted_at')
                            ->where('role_id',3)
                            ->where('status',1)
                            ->latest()
                            ->get();
        $data['user_id'] = $userId;
        $data['currentStudent'] = $onlyUser;
        $data['batchTypes']     = BatchType::whereNull('deleted_at')->get();
        $data['batch_type_id']  = "";
        return view('backend.students.promotion_class.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $input = $request->all();
        DB::beginTransaction();
        try
        {
            $validator = Validator::make($request->all(), [
                'class_id'          => 'required',
                'session_id'        => 'required',
                'batch_setting_id'  => 'required',
                'batch_type_id'     => 'required',
                'action_type'       => 'required',

                'admission_date'    => $request->admission_date != "" ?'required':'nullable',
                'roll'              => $request->admission_date != "" ?'required':'nullable',
                'month_id'          => $request->admission_date != "" ?'required':'nullable',
                'activate_status'   => $request->admission_date != "" ?'required':'nullable',
            ]);

            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            if($request->previousClass_id == $request->class_id && 
                $request->previousSession_id == $request->session_id 
            )
            {
                if($request->previousBatchSetting_id == $request->batch_setting_id && 
                $request->previousBatchType_id == $request->batch_type_id 
                )
                {
                    $notification = array(
                        'message' => 'Student already addedd!',
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with([$notification,'error','Student already addedd!']);
                }
            }

            $student = new Student();
            $student->user_id               = $request->user_id;
            $student->class_id              = $request->class_id;
            $student->session_id            = $request->session_id;
            $student->section_id            = $request->section_id;
            $student->batch_setting_id      = $request->batch_setting_id;
            $student->batch_type_id         = $request->batch_type_id;
            $student->roll                  = $request->roll;
            $student->admission_date        = $request->admission_date;
            $student->student_type_id       = $request->student_type_id;
            $student->start_month_id        = $request->month_id;
            $student->activate_status       = $request->activate_status;
            $student->created_by            = $request->created_by;
            $student->school_name           = $request->school_name;
            $student->save();

            if($request->action_type == 2 && $request->previous_student_id)
            {
               return $previousStudent = Student::where('user_id',$user_id)
                    ->where('class_id',$request->previous_class_id)
                    ->where('session_id',$request->previous_session_id)
                    ->where('batch_setting_id',$request->previous_batch_setting_id)
                    ->where('batch_type_id',$request->previous_batch_type_id)
                    ->where('activate_status',1)
                    ->orderBy('id','DESC')
                    ->first();
                //$previousStudent = Student::findOrFail($request->previous_student_id);
                if($previousStudent)
                {
                    $previousStudent->activate_status = 2;
                    $previousStudent->save();
                }
            }
            DB::commit();
            $notification = array(
                'message' => 'Student Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->route('student.index')->with($notification);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
