<?php

namespace App\Http\Controllers\Backend\Waiver;

use App\Http\Controllers\Controller;
use App\Model\StudentWaiver;
use Illuminate\Http\Request;
use App\Model\Waiver;
use App\Model\WaiverType;

use App\Model\BatchType;
use App\Model\FeeAmountSetting;
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
class StudentWaiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['classes']        = Classes::where('status',1)->get();
        $data['sessiones']      = Sessiones::where('status',1)->get();
        $data['sectiones']      = Section::where('status',1)->get();
        $data['student_typies'] = StudentType::where('status',1)->get();
        $data['waivers']        = Waiver::where('status',1)->latest()->get();
        $data['waiverTypes']    = WaiverType::where('status',1)->latest()->get();
        $data['batch_settings'] = BatchSetting::where('status',1)->latest()->get();
        $data['fee_categories'] = FeeCategory::where('status',1)->latest()->get();
        $data['months']         = Month::get();//where('status',1)->latest()->

       
        return view('backend.waiver.student_waiver.index',$data);
    }




    public function ajaxindex(Request $request)
    {
        $pagination = $request->pagination;



        $query = StudentWaiver::query();


        if ($request->student_id) {
            $data['student_id'] = $request->student_id;
            $findusercount = User::where('id', $request->student_id)->count();
            if ($findusercount > 0) {
                $finduser = User::where('id', $request->student_id)->first();
                $query->where('user_id', $finduser->id);
            }
           
        }
 

        if ($request->class_id) {
            $data['class_id']   = $request->class_id;
            $query->where('class_id', $request->class_id);
        }

        if ($request->session_id) {
            $data['session_id'] = $request->session_id;
            $query->where('session_id', $request->session_id);
        }

        if ($request->batch_setting_id) {
            $data['batch_setting_id']   = $request->batch_setting_id;
            $query->where('batch_setting_id', $request->batch_setting_id);
        }

        if($pagination == 'all_data')
        {
            $pagination = $query->orderBy('id', 'DESC')->count();
        }else{
            $pagination = $pagination;
        }

 
        $data['waiverStudents'] = $query->where('activate_status',1)->latest()->paginate($pagination);


        return view('backend.waiver.student_waiver.ajax_index',$data);
    }

















    /**Get Student All Data */
    public function getWaiverStudentDataByStudentId(Request $request)
    {
        $student = Student::where('user_id',$request->user_id)
                ->where('activate_status',1)
                ->whereNull('deleted_at')
                ->where('batch_setting_id',$request->batch_setting_id)
                ->where('batch_type_id',$request->batch_type_id)
                ->first();
        if($student)
        {
            $class          = $student->classes?$student->classes->name:NULL;
            $session        = $student->sessiones?$student->sessiones->name:NULL;
            $Class_type     = $student->studentype?$student->studentype->name:NULL;

            $classId        = $student->class_id;
            $sessionId      = $student->session_id;
            $studentTypeId  = $student->student_type_id;
            $section_id     = $student->section_id;

            $user_id        = $student->user_id;
            $student_id     = $student->id;

            $hidden =  '<input type="hidden" name="class_id" value="'.$classId.'"/>';
            $hidden .=  '<input type="hidden" name="session_id" value="'.$sessionId.'"/>';
            $hidden .=  '<input type="hidden" name="student_type_id" value="'.$studentTypeId.'"/>';
            $hidden .=  '<input type="hidden" name="section_id" value="'.$section_id.'"/>';
            $hidden .=  '<input type="hidden" name="student_id" value="'.$student_id.'"/>';
            return response()->json([
                "status"        => true,
                "hidden"        => $hidden,
                "class"         => $class,
                "session"       => $session,
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
        return view('backend.waiver.student_waiver.create',$data);
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
            $validator = Validator::make($request->all(), [
                'class_id'          => 'required',
                'session_id'        => 'required',
                'batch_setting_id'  => 'required',
                'batch_type_id'     => 'required',
                'start_month_id'    => 'required',
                'end_month_id'      => 'required',
                'waiver_id'         => 'required',
                'fee_cat_id'        => 'required',
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
           $feeCat = FeeAmountSetting::where('fee_cat_id',$request->fee_cat_id)
                ->where('class_id',$request->class_id)
                ->where('session_id',$request->session_id)
                //->where('student_type_id',$request->student_type_id)
                ->where('batch_setting_id',$request->batch_setting_id)
                ->where('batch_type_id',$request->batch_type_id)
                ->where('status',1)
                ->whereNull('deleted_at')
                ->first();
            if(!$feeCat || empty($feeCat))
            {
                $notification = array(
                    'message' => 'Please Set Fee Setting First!',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);  
            }
            $waiver     =    Waiver::find($request->waiver_id);
        

            $data   = new StudentWaiver();
            $data->waiver_id            = $request->waiver_id;
            $data->fee_cat_id           = $request->fee_cat_id;
            $data->student_id           = $request->student_id;
            $data->user_id              = $request->user_id;
            $data->class_id             = $request->class_id;
            $data->session_id           = $request->session_id;
            $data->batch_setting_id     = $request->batch_setting_id;
            $data->batch_type_id        = $request->batch_type_id;
            $data->section_id           = $request->section_id;

            $data->waiver_type_id       = $waiver?$waiver->waiver_type_id:NULL;
            $data->waiver_value         = $waiver?$waiver->amount:NULL;
            //$data->waiver_amount        = $waiver?$waiver->waiver_type_id:NULL;
            $data->fee_amount_setting_id  = $feeCat?$feeCat->id:NULL;
            //$data->fee_setting_amount   = $request->fee_setting_amount;
            $data->start_month_id       = $request->start_month_id;
            $data->end_month_id         = $request->end_month_id;
            $data->activate_status      = $request->status;
            $data->created_by           = auth()->user()->id;
            $data->save();
 
            DB::commit();
            $notification = array(
                'message' => 'Student Waiver Added Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.student-waiver.index')->with($notification);
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
     * @param  \App\Model\StudentWaiver  $studentWaiver
     * @return \Illuminate\Http\Response
     */
    public function show(StudentWaiver $studentWaiver)
    {
        $data['student'] =  $studentWaiver;
        return view('backend.waiver.student_waiver.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\StudentWaiver  $studentWaiver
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentWaiver $studentWaiver,Request $request)
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
        $data['batchTypies']    = BatchType::where('status',1)->latest()->get();
        $data['fee_categories'] = FeeCategory::where('status',1)->latest()->get();
        $data['months']         = Month::get();//where('status',1)->latest()->

        $data['studentWaiver'] = $studentWaiver;
        return view('backend.waiver.student_waiver.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\StudentWaiver  $studentWaiver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentWaiver $studentWaiver)
    {
        DB::beginTransaction();
        try
        {
            $validator = Validator::make($request->all(), [
                'class_id'          => 'required',
                'session_id'        => 'required',
                'batch_setting_id'  => 'required',
                'batch_type_id'  => 'required',
                'start_month_id'    => 'required',
                'end_month_id'      => 'required',
                'waiver_id'         => 'required',
                'fee_cat_id'        => 'required',
                'student_id'        => 'required',
                'status'            => 'required',
            ]);
            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
           $feeCat = FeeAmountSetting::where('fee_cat_id',$request->fee_cat_id)
                ->where('class_id',$request->class_id)
                ->where('session_id',$request->session_id)
                //->where('student_type_id',$request->student_type_id)
                ->where('batch_setting_id',$request->batch_setting_id)
                ->where('batch_type_id',$request->batch_type_id)
                ->where('status',1)
                ->whereNull('deleted_at')
                ->first();
            if(!$feeCat || empty($feeCat))
            {
                $notification = array(
                    'message' => 'Please Set Fee Setting First!',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);  
            }
            $waiver     =    Waiver::find($request->waiver_id);
          
            $studentWaiver->waiver_id            = $request->waiver_id;
            $studentWaiver->fee_cat_id           = $request->fee_cat_id;
            $studentWaiver->student_id           = $request->student_id;
            $studentWaiver->user_id              = $request->user_id;
            $studentWaiver->class_id             = $request->class_id;
            $studentWaiver->session_id           = $request->session_id;
            $studentWaiver->batch_setting_id     = $request->batch_setting_id;
            $studentWaiver->batch_type_id        = $request->batch_setting_id;
            $studentWaiver->section_id           = $request->section_id;

            $studentWaiver->waiver_type_id       = $waiver?$waiver->waiver_type_id:NULL;
            $studentWaiver->waiver_value         = $waiver?$waiver->amount:NULL;
            //$data->waiver_amount        = $waiver?$waiver->waiver_type_id:NULL;
            $studentWaiver->fee_amount_setting_id = $feeCat?$feeCat->id:NULL;
            //$data->fee_setting_amount   = $request->fee_setting_amount;
            $studentWaiver->start_month_id       = $request->start_month_id;
            $studentWaiver->end_month_id         = $request->end_month_id;
            $studentWaiver->activate_status      = $request->status;
            //$studentWaiver->created_by           = auth()->user()->id;
            $studentWaiver->save();

            DB::commit();
            $notification = array(
                'message' => 'Student Waiver Updated Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.student-waiver.index')->with($notification);
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
     * @param  \App\Model\StudentWaiver  $studentWaiver
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentWaiver $studentWaiver)
    {
        $studentWaiver->deleted_at      = date("Y-m-d h:i:s");
        $studentWaiver->activate_status = 2;
        $studentWaiver->save();
        $notification = array(
            'message' => 'Student Waiver Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);  
    }
}
