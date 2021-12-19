<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AbsentStudent;
use Illuminate\Http\Request;


use App\Model\StudentWaiver;
use App\Model\Waiver;
use App\Model\WaiverType;
use App\Model\AbsentMonth;

use App\Model\FeeSetting;
use App\Model\FeeCategory;
use App\Models\Section;
use App\Models\Sessiones;
use App\Models\Classes;
use App\Models\Month;
use App\Models\Year;
use App\Models\BatchSetting;
use App\Models\StudentType;
use App\Models\Student;
use DB;
use Validator;
use App\User;

class AbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['absents'] =  AbsentStudent::where('status',1)->whereNull('deleted_at')->latest()->get();
        return view('backend.students.student_absent.index',$data);
    }



    
    /**Get Student All Data */
    public function getWaiverStudentDataByStudentId(Request $request)
    {
        $student = Student::where('id',$request->student_id)
                ->where('activate_status',1)
                ->whereNull('deleted_at')
                ->first();
        if($student)
        {
            $class          = $student->classes?$student->classes->name:NULL;
            $session        = $student->sessiones?$student->sessiones->name:NULL;
            $batch_setting  = $student->batchsetting?$student->batchsetting->batch_name:NULL;
            $Class_type     = $student->studentype?$student->studentype->name:NULL;

            $classId        = $student->class_id;
            $sessionId      = $student->session_id;
            $batchSettingId = $student->batch_setting_id;
            $studentTypeId  = $student->student_type_id;
            $section_id     = $student->section_id;

            $user_id        = $student->user_id;

            $hidden =  '<input type="hidden" name="class_id" value="'.$classId.'"/>';
            $hidden .=  '<input type="hidden" name="session_id" value="'.$sessionId.'"/>';
            $hidden .=  '<input type="hidden" name="batch_setting_id" value="'.$batchSettingId.'"/>';
            $hidden .=  '<input type="hidden" name="student_type_id" value="'.$studentTypeId.'"/>';
            $hidden .=  '<input type="hidden" name="section_id" value="'.$section_id.'"/>';
            return response()->json([
                "status"        => true,
                "hidden"        => $hidden,
                "class"         => $class,
                "session"       => $session,
                "batch_setting" => $batch_setting,
                "Class_type"    => $Class_type,
                "user_id"       => $user_id,
            ]);
        }
        return response()->json([
            "status"        => false
        ]);
    }
    /**Get Student All Data */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /**----------------------------------------------------------------------------------*/
        $getStudentId   = NULL;
        $userId         = NULL;
        if(isset($_GET['student_id']))
        {
            $getStudent     = Student::where('user_id',$_GET['student_id'])
                                    ->where('activate_status',1)
                                    ->whereNull('deleted_at')
                                    ->first();
            $getStudentId = $getStudent?$getStudent->id : NULL;
            if(empty($getStudent))
            {
                $notification = array(
                    'message' => 'Add Student Or Promotion Student First!',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);
            }
            $userId = $_GET['student_id'];
        }
        $data['get_student_id']     = $getStudentId;
        $data['student_user_id']    = $userId;

        /**----------------------------------------------------------------------------------*/
        $data['students']       = Student::where('activate_status',1)->whereNull('deleted_at')->get();

        $data['classes']        = Classes::where('status',1)->get();
        $data['sessiones']      = Sessiones::where('status',1)->get();
        $data['sectiones']      = Section::where('status',1)->get();
        $data['student_typies'] = StudentType::where('status',1)->get();
        $data['waivers']        = Waiver::where('status',1)->latest()->get();
        $data['waiverTypes']    = WaiverType::where('status',1)->latest()->get();
        $data['batch_settings'] = BatchSetting::where('status',1)->latest()->get();
        $data['fee_categories'] = FeeCategory::where('status',1)->latest()->get();
        $data['months']         = Month::get();//where('status',1)->latest()->
        return view('backend.students.student_absent.create',$data);
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
        DB::beginTransaction();
        try
        {
            $validator = Validator::make($request->all(), [
                'class_id'          => 'required',
                'session_id'        => 'required',
                'batch_setting_id'  => 'required',
                'month_id.*'        => 'required',
                'student_id'        => 'required',
                'status'            => 'required',
                //'student_type_id'   => $request->previous_admitted == "" ?'required':'nullable',
                //'activate_status'   => $request->previous_admitted == "" ?'required':'nullable',
            ]);
            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
           
        

            $data   = new AbsentStudent();
            $data->student_id           = $request->student_id;
            $data->user_id              = $request->user_id;
            $data->class_id             = $request->class_id;
            $data->session_id           = $request->session_id;
            $data->batch_setting_id     = $request->batch_setting_id;
            $data->section_id           = $request->section_id;
            $data->reason               = $request->reason;
            $data->notes                = $request->note;
            $data->status               = $request->status;
            $data->created_by           = auth()->user()->id;
            $data->save();
            
            foreach ($request->month_id as $key => $value) 
            {
                $absentMonths = new AbsentMonth();
                $absentMonths->absent_id    = $data->id;     
                $absentMonths->month_id     = $value;     
                $absentMonths->year         = date('Y');     
                $absentMonths->save();
            }
           

            DB::commit();
            $notification = array(
                'message' => 'Student Absent Added Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.absent.index')->with($notification);
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
     * @param  \App\Models\AbsentStudent  $absentStudent
     * @return \Illuminate\Http\Response
     */
    public function show(AbsentStudent $absentStudent,$id)
    {
        $data['student'] =  AbsentStudent::findOrfail($id);
        return view('backend.students.student_absent.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AbsentStudent  $absentStudent
     * @return \Illuminate\Http\Response
     */
    public function edit($id,AbsentStudent $absentStudent)
    {
        /**----------------------------------------------------------------------------------*/
        $getStudentId   = NULL;
        $userId         = NULL;
        if(isset($_GET['student_id']))
        {
            $getStudent     = Student::where('user_id',$_GET['student_id'])
                                    ->where('activate_status',1)
                                    ->whereNull('deleted_at')
                                    ->first();
            $getStudentId = $getStudent?$getStudent->id : NULL;
            if(empty($getStudent))
            {
                $notification = array(
                    'message' => 'Add Student Or Promotion Student First!',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);
            }
            $userId = $_GET['student_id'];
        }
        $data['get_student_id']     = $getStudentId;
        $data['student_user_id']    = $userId;

        /**----------------------------------------------------------------------------------*/
        $data['students']       = Student::where('activate_status',1)->whereNull('deleted_at')->get();

        $data['classes']        = Classes::where('status',1)->get();
        $data['sessiones']      = Sessiones::where('status',1)->get();
        $data['sectiones']      = Section::where('status',1)->get();
        $data['student_typies'] = StudentType::where('status',1)->get();
        $data['waivers']        = Waiver::where('status',1)->latest()->get();
        $data['waiverTypes']    = WaiverType::where('status',1)->latest()->get();
        $data['batch_settings'] = BatchSetting::where('status',1)->latest()->get();
        $data['fee_categories'] = FeeCategory::where('status',1)->latest()->get();
        $data['months']         = Month::get();//where('status',1)->latest()->

        $data['absentStudent']  = AbsentStudent::findOrfail($id);
        return view('backend.students.student_absent.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AbsentStudent  $absentStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, AbsentStudent $absentStudent)
    {
        
         //return $request;
         DB::beginTransaction();
         try
         {
             $validator = Validator::make($request->all(), [
                 'class_id'          => 'required',
                 'session_id'        => 'required',
                 'batch_setting_id'  => 'required',
                 'month_id.*'        => 'required',
                 'student_id'        => 'required',
                 'status'            => 'required',
                 //'student_type_id'   => $request->previous_admitted == "" ?'required':'nullable',
                 //'activate_status'   => $request->previous_admitted == "" ?'required':'nullable',
             ]);
             if ($validator->fails()){
                 return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
             }
            
         
 
             $data   = AbsentStudent::findOrfail($id);
             $data->student_id           = $request->student_id;
             $data->user_id              = $request->user_id;
             $data->class_id             = $request->class_id;
             $data->session_id           = $request->session_id;
             $data->batch_setting_id     = $request->batch_setting_id;
             $data->section_id           = $request->section_id;
             $data->reason               = $request->reason;
             $data->notes                = $request->note;
             $data->status               = $request->status;
             //$data->created_by           = auth()->user()->id;
             $data->save();
             
             foreach ($data->absentMonths as $key => $value)
             {
                $value->delete();
             }

             foreach ($request->month_id as $key => $value) 
             {
                $absentMonths = new AbsentMonth();
                $absentMonths->absent_id    = $data->id;     
                $absentMonths->month_id     = $value;     
                $absentMonths->year         = date('Y');     
                $absentMonths->save();
             }
            
            
             DB::commit();
             $notification = array(
                 'message' => 'Student Absent Added Successfully!',
                 'alert-type' => 'success'
             );
             return redirect()->route('admin.absent.index')->with($notification);
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AbsentStudent  $absentStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbsentStudent $absentStudent)
    {
        DB::beginTransaction();
        try
        {
            foreach ($data->absentMonths as $key => $value)
            {
               $value->status       = 2;
               $value->deleted_at   = date('Y-m-d h:i:s');
               $value->save();
            }

            $absentStudent->deleted_at  = date('Y-m-d h:i:s');
            $absentStudent->status      = 2;
            $absentStudent->save();

            DB::commit();
            $notification = array(
                'message' => 'Student Absent Deleted Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.absent.index')->with($notification);
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
}
