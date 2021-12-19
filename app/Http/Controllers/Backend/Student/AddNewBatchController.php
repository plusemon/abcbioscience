<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentInfo;
use App\Models\Month;
use App\Models\Year;
use App\Models\Section;
use App\Models\Sessiones;
use App\Models\Classes;
use App\User;
use App\Models\AbsentStudent;
use App\Models\Batch;
use App\Models\BatchSetting;
use App\Models\StudentType;
use DB;
use Validator;
class AddNewBatchController extends Controller
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
                                //->when($currentClassId,function($c)use($currentClassId){
                                   // $c->whereNotIn('id',[$currentClassId]);
                                //})
                                ->get();
        $data['newSessiones']   = Sessiones::where('status',1)
                                //->when($currentSessionId,function($s)use($currentSessionId){
                                    //$s->whereNotIn('id',[$currentSessionId]);
                                //})
                                ->get();

        $data['allstudents'] = User::whereNull('deleted_at')
                            ->where('role_id',3)
                            ->where('status',1)
                            ->latest()
                            ->get();
        $data['user_id'] = $userId;
        $data['currentStudent'] = $onlyUser;
        return view('backend.students.add_new_batch.create',$data);
    }



    public function getbatchsetting(Request $request)
    {
        $batch = "<option value=''> Select Batch </option>";
        $batchSettingId     = $request->batchSettingId;
        $class_id           = $request->class_id;
        $session_id         = $request->session_id;

        $findbatch = BatchSetting::where('classes_id',$class_id)
                            ->where('sessiones_id',$session_id)
                             ->when($batchSettingId,function($c)use($batchSettingId){
                                    $c->whereNotIn('id',[$batchSettingId]);
                                })
                            ->get();
        foreach ($findbatch as $key => $value) {
            $batch .= "<option value='$value->id'> $value->batch_name </option>";
        }

        if($findbatch)
        {
            return response()->json([
                'status' => true,
                'batch_setting' => $batch,
            ]);
        }
        return response()->json([
            'status' => false,
            'batch_setting' => $batch,
        ]);
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
                'section_id'        => 'required',

                'admission_date'    => $request->previous_admitted == "" ?'required':'nullable',
                'roll'              => $request->previous_admitted == "" ?'required':'nullable',
                'month_id'          => $request->previous_admitted == "" ?'required':'nullable',
                'student_type_id'   => $request->previous_admitted == "" ?'required':'nullable',
                'activate_status'   => $request->previous_admitted == "" ?'required':'nullable',
            ]);

            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            if($request->previous_admitted)
            {
                $previousStudent = Student::where('user_id',$request->student_user_id)
                            ->where('batch_setting_id',$request->batch_setting_id)
                            ->where('activate_status',1)
                            ->first();
                if($previousStudent)
                {
                    $previousStudent->activate_status = 2;
                    $previousStudent->save();
                }

                /* $previousStudent = Student::findOrFail($request->previous_student_id);
                $previousStudent->activate_status = 2;
                $previousStudent->save(); */
            }
            
            $student = new Student();
            $student->user_id               = $request->student_user_id;
            $student->class_id              = $request->class_id;
            $student->session_id            = $request->session_id;
            $student->section_id            = $request->section_id;
            $student->batch_setting_id      = $request->batch_setting_id;
            $student->roll                  = $request->roll;
            $student->admission_date        = $request->admission_date;
            $student->student_type_id       = $request->student_type_id;
            $student->start_month_id        = $request->month_id;
            $student->activate_status       = $request->activate_status;
            $student->created_by            = $request->created_by;
            $student->school_name           = $request->school_name;
            $student->save();
            
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
