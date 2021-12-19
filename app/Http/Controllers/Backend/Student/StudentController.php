<?php

namespace App\Http\Controllers\Backend\Student;

use App\User;
use App\Models\Month;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use App\Model\BatchType;
use App\Models\Sessiones;
use App\Jobs\MatchSendSms;
use App\Models\SmsHistroy;
use App\Models\StudentInfo;
use App\Models\StudentType;
use App\Models\BatchSetting;
use Illuminate\Http\Request;
use App\Model\PaymentHistory;
use App\Exports\StudentExport;
use App\Models\WrittenExamResult;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\McqExamStudentAnsSummary;
use App\Models\AttendanceDetail;
use App\Models\Batch;
use Excel;
use Validator;
use Auth;
use App\Models\HomeWorkDetail;
use App\Model\McqExamStudentAnswer;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
          
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();

        $data['batchTypes']     = BatchType::whereNull('deleted_at')->get();
  
    
        $data['totalstudent'] = Student::count();
 

        return view('backend.students.view', $data);
    }




    public function indexajax(Request $request)
    {
          
        $pagination = $request->pagination;

        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
        $data['batchTypes']     = BatchType::whereNull('deleted_at')->get();


        $query = Student::query();


        if ($request->student_id) {
            $data['student_id'] = $request->student_id;
            $findusercount = User::where('id', $request->student_id)->count();
            if ($findusercount > 0) {
                $finduser = User::where('id', $request->student_id)->first();
                $query->where('user_id', $finduser->id);
            }
           
        }


        if ($request->mobile) {
            $data['mobile'] = $request->mobile;

            $findusercount = User::where('mobile', $request->mobile)->count();
            if ($findusercount > 0) {
                $finduser = User::where('mobile', $request->mobile)->first();
            $query->where('user_id', $finduser->id);
            }
        }


        if ($request->class_id) {
            $data['class_id']   = $request->class_id;
            $query->where('students.class_id', $request->class_id);
        }

        if ($request->session_id) {
            $data['session_id'] = $request->session_id;
            $query->where('session_id', $request->session_id);
        }

        if ($request->batch_setting_id) {
            $data['batch_setting_id']   = $request->batch_setting_id;
            $query->where('batch_setting_id', $request->batch_setting_id);
        }

        if ($request->month_id) {
            $data['month_id']   = $request->month_id;
            $query->where('month_id', $request->month_id);
        }
        if ($request->student_type_id) {

            $data['student_type_id']    = $request->student_type_id;
            $query->where('student_type_id', $request->student_type_id);
        }


        if($pagination == 'all_data')
        {
            $pagination = $query->orderBy('id', 'DESC')->count();
        }else{
            $pagination = $pagination;
        }
        

        $data['allstudents']  = $query
                ->leftJoin('users', 'students.user_id', 'users.id')
                ->leftJoin('classes', 'students.class_id', 'classes.id')
                ->leftJoin('sessiones', 'students.session_id', 'sessiones.id')
                ->leftJoin('batch_settings', 'students.batch_setting_id', 'batch_settings.id')
                ->leftJoin('batch_typies', 'students.batch_type_id', 'batch_typies.id')
                ->select('users.*', 'classes.name as cl_name', 'students.*', 'sessiones.name as ses_name', 'batch_settings.batch_name as bs_name', 'batch_typies.name as bt_name')
                ->orderBy('users.name', 'ASC')
                ->where('activate_status',1)
                ->paginate($pagination);

            
        $data['totalstudent'] = Student::count();

 

        return view('backend.students.view_ajax', $data);

    }




     public function exportstudents(Request $request)
    {

        

        $query = Student::query();


        if ($request->student_id) {
            $data['student_id'] = $request->student_id;
            $findusercount = User::where('id', $request->student_id)->count();
            if ($findusercount > 0) {
                $finduser = User::where('id', $request->student_id)->first();
                $query->where('user_id', $finduser->id);
            }
           
        }


        if ($request->mobile) {
            $data['mobile'] = $request->mobile;

            $findusercount = User::where('mobile', $request->mobile)->count();
            if ($findusercount > 0) {
                $finduser = User::where('mobile', $request->mobile)->first();
            $query->where('user_id', $finduser->id);
            }
        }


        if ($request->class_id) {
            $data['class_id']   = $request->class_id;
            $query->where('students.class_id', $request->class_id);
        }

        if ($request->session_id) {
            $data['session_id'] = $request->session_id;
            $query->where('session_id', $request->session_id);
        }

        if ($request->batch_setting_id) {
            $data['batch_setting_id']   = $request->batch_setting_id;
            $query->where('batch_setting_id', $request->batch_setting_id);
        }

        if ($request->month_id) {
            $data['month_id']   = $request->month_id;
            $query->where('month_id', $request->month_id);
        }
        if ($request->student_type_id) {

            $data['student_type_id']    = $request->student_type_id;
            $query->where('student_type_id', $request->student_type_id);
        }


        $allstudents  = $query
                ->leftJoin('users', 'students.user_id', 'users.id')
                ->leftJoin('classes', 'students.class_id', 'classes.id')
                ->leftJoin('sessiones', 'students.session_id', 'sessiones.id')
                ->leftJoin('batch_settings', 'students.batch_setting_id', 'batch_settings.id')
                ->leftJoin('batch_typies', 'students.batch_type_id', 'batch_typies.id')
                ->select('users.*', 'classes.name as cl_name', 'students.*', 'sessiones.name as ses_name', 'batch_settings.batch_name as bs_name', 'batch_typies.name as bt_name')
                ->orderBy('users.name', 'ASC')
                ->where('activate_status',1)
                ->get();

         
        if ($request->has('excel')) {

            return  Excel::download(new StudentExport($allstudents), 'student_list.xlsx');
        } else if ($request->has('pdf')) {


            return  Excel::download(new StudentExport($allstudents), 'student_list.pdf');
        }
    }



    
    
    //for student login 


    public function studentuserdashboard($id)
    {
 
            $finduser  = User::find($id);
 
            Auth::logout();

            Auth::login($finduser);
 
 
            return redirect()->route('student.dashboard');

    }








    public function pendingstudent(Request $request)
    {
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();

        $data['batchTypes']     = BatchType::whereNull('deleted_at')->get();


        $query = Student::query();
        if ($request->class_id) {
            $data['class_id']   = $request->class_id;
            $query              = $query->where('class_id', $request->class_id);
        }

        if ($request->session_id) {
            $data['session_id'] = $request->session_id;
            $query              = $query->where('session_id', $request->session_id);
        }

        if ($request->batch_setting_id) {
            $data['batch_setting_id']   = $request->batch_setting_id;
            $query                      = $query->where('batch_setting_id', $request->batch_setting_id);
        }

        if ($request->month_id) {
            $data['month_id']   = $request->month_id;
            $query              = $query->where('month_id', $request->month_id);
        }
        if ($request->student_type_id) {

            $data['student_type_id']    = $request->student_type_id;
            $query                      = $query->where('student_type_id', $request->student_type_id);
        }

        $data['allstudents'] = $query->orderBy('id', 'DESC')->whereIn('activate_status', [3])->paginate(50);

        return view('backend.students.pendingview', $data);
    }







    public function activestudent(Request $request, $id)
    {

        $student = Student::find($id);
        $student->activate_status = 1;
        $student->status = 1;
        $student->save();


        $data['message']  = 'Congratulations!
You have successfully completed your enrolment.
AbcBioScience';


        $finduser = User::where('id', $student->user_id)->first();

        $data['number']  = $finduser->mobile;


        try {

            $data['number'] = $student->user->mobile;

            $smsJob = new MatchSendSms($data['number'], $data['message']);

            dispatch($smsJob);

            $smshistory = new SmsHistroy();
            $smshistory->user_id    = $student->user_id;
            $smshistory->student_id = $student->id;
            $smshistory->message    = $data['message'];
            $smshistory->status     = 1;
            $smshistory->save();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


        $notification = array(
            'message' => 'Student Successfully Actived!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['classes']        = Classes::all();
        $data['batchTypes']     = BatchType::whereNull('deleted_at')->get();
        $data['sessiones']      = Sessiones::all();
        $data['sectiones']      = Section::all();
        $data['months']         = Month::all();
        $data['student_typies']   = StudentType::all();
        return view('backend.students.add', $data);
    }



    public function studentuser(Request $request)
    {

        $query = User::query();


        if ($request->user_id) {
            $query = $query->where('id', $request->user_id);
        }

        if ($request->mobile) {
            $query = $query->where('mobile', $request->mobile);
        }


        $data['studentusers'] = $query->where('role_id', 3)->orderBy('name', 'ASC')->paginate(30);

        return view('backend.students.studentuser', $data);
    }

    
    
    
    public function nonenrolleruser(Request $request)
    {



        $query = User::query();


        if ($request->user_id) {
            $query = $query->where('id', $request->user_id);
        }

        if ($request->mobile) {
            $query = $query->where('mobile', $request->mobile);
        }


        $data['studentusers'] = $query->where('role_id', 3)->orderBy('name', 'ASC')->get();

         return view('backend.students.studentnonenrolluser', $data);
    }

    
    public function studentuserajax(Request $request)
    {

         $pagination = $request->pagination;

         
        $query = User::query();

        if ($request->student_id) {
            $query = $query->where('id', $request->student_id);
        }

        if ($request->mobile) {
            $query = $query->where('mobile', $request->mobile);
        }   


        if($pagination == 'all_data')
        {
            $pagination = $query->orderBy('id', 'DESC')->count();
        }else{
            $pagination = $pagination;
        }


        $data['studentusers'] = $query->where('role_id',3)->orderBy('name', 'ASC')->get();

        return view('backend.students.student_user_ajax', $data);
    }














    public function user_show(User $user)
    {

        $data['user'] = $user;
        $data['batches'] = $user->students;

        return view('backend.users.show', $data);
    }












    public function getbatchstudentforsms(Request $request)
    {
        $outputstudent = "";

        $class_id           = $request->class_id;
        $session_id         = $request->session_id;
        $batch_setting_id   = $request->batch_setting_id;


        $findbatchstudent = Student::where('class_id', $class_id)
            ->where('session_id', $session_id)
            ->where('batch_setting_id', $batch_setting_id)
            ->where('activate_status', 1)
            ->get();

        if ($findbatchstudent) {
            $i = 1;

            foreach ($findbatchstudent as $student) {
                $outputstudent .= "<tr> 
                                        <td> 
                                             <input class='checkSingle' type='checkbox' name='user_id[]' value='" . $student->user_id . "'/> 
                                             <input type='hidden' name='student_id[]' value='" . $student->id . "'/>
                                        </td>
                                        <td> " . $i++ . "</td>
                                        <td> " . $student->user->useruid . " </td>
                                        <td> " . $student->user->name . " </td>
                                        <td> " . $student->user->mobile . " </td>
                                    </tr>
                                 ";
            }
        }

        return $outputstudent;
    }






    public function getbatchsetting(Request $request)
    {
        $batch = "<option value=''> Select Batch </option>";
        $class_id     = $request->class_id;
        $session_id   = $request->session_id;
        $findbatch = BatchSetting::where('classes_id', $class_id)->where('sessiones_id', $session_id)->get();
        foreach ($findbatch as $key => $value) {
            $batch .= "<option value='$value->id'> $value->batch_name </option>";
        }

        if ($findbatch) {
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

    public function getClassTypeByBatchSetting(Request $request)
    {
        $class_id           = $request->class_id;
        $session_id         = $request->session_id;
        $batch_setting_id   = $request->batch_setting_id;
        $findbatch = BatchSetting::where('classes_id', $class_id)
            ->where('sessiones_id', $session_id)
            ->where('id', $batch_setting_id)
            ->where('status', 1)
            ->first();
        if ($findbatch) {
            $val = StudentType::findOrFail($findbatch->class_type_id);
            $batch = "<option value='$val->id'> $val->name </option>";
            return response()->json([
                'status' => true,
                'class_type' => $batch
            ]);
        }
        return response()->json([
            'status' => false,
            'class_type' => "<option value=''> Select Batch First </option>",
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
        try {
            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'mobile'        => $request->email == NULL ? 'required|min:10|max:16' : 'nullable' . '|unique:users,mobile',
                'email'         => $request->mobile == NULL  ? 'required|email' : 'nullable' . '|unique:users,email',
                'guardianmobile'    => 'required|min:10|max:16',
                'class_id'    => $request->class_id ? 'required' : 'nullable',
                'session_id'  => $request->class_id ? 'required' : 'nullable',
                'batch_setting_id' => $request->class_id ? 'required' : 'nullable',
                'batch_type_id' => $request->class_id ? 'required' : 'nullable',
                //'section_id'=> $request->class_id ?'required':'nullable',
                //'student_type_id'=> $request->class_id ?'required':'nullable',
                'admission_date' => $request->class_id ? 'required' : 'nullable',
                'month_id'      => $request->class_id ? 'required' : 'nullable',
                'status'        => $request->class_id ? 'required' : 'nullable',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $existingUser       = User::query();
            $countdata          = $existingUser->count();
            $lastdata           = $existingUser->latest()->first(); //User::orderBy('id','DESC')->first();
            $findbatchdata      = BatchSetting::find($request->batch_setting_id);

            $user = new User();
            if ($countdata > 0) {
                $user->useruid = $lastdata->useruid + 1;
            } else {
                $user->useruid = "2021001";
            }

            $user->name         = $request->name;
            $user->mobile       = $request->mobile;
            $user->email        = $request->email;
            $user->password     = bcrypt(123456789);
            $user->role_id      = 3;
            $user->status       = 1;
            $user->save();

            if ($request->class_id) {
                $student = new Student();
                $student->user_id           = $user->id;
                $student->class_id          = $request->class_id;
                $student->session_id        = $request->session_id;
                $student->section_id        = $request->section_id;
                $student->batch_setting_id  = $request->batch_setting_id;
                $student->batch_type_id     = $request->batch_type_id;
                $student->roll              = $request->roll;
                $student->admission_date    = $request->admission_date;
                $student->start_month_id    = $request->month_id;
                $student->activate_status   = $request->status;
                $student->school_name       = $request->school_name;
                $student->save();
            }

            $studentinfo = new StudentInfo();
            $studentinfo->user_id           = $user->id;
            $studentinfo->father            = $request->father;
            $studentinfo->mother            = $request->mother;
            $studentinfo->guardian_mobile   = $request->guardianmobile;
            $studentinfo->own_mobile        = $request->mobile;
            $studentinfo->address           = $request->address;
            $studentinfo->whatsapp_number   = $request->whatsapp_number;
            $studentinfo->facebook_id       = $request->facebook_id;
            $studentinfo->bkash_number      = $request->bkash_number;
            $studentinfo->email             = $request->email;
            $studentinfo->address           = $request->address;
            $studentinfo->notes             = $request->note;
            $studentinfo->status            = $request->status;
            $studentinfo->save();
            DB::commit();
            $notification = array(
                'message' => 'Student Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->route('student.index')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            if ($e->getMessage()) {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id) // EMON
    {
        $data['student'] = Student::FindOrFail($id);
        $data['mcq_results'] = McqExamStudentAnsSummary::where('student_id', $id)->whereNotNull('final_result')->paginate(20);
        $data['written_results'] = WrittenExamResult::where('student_id', $id)->whereStatus(1)->paginate(20);
        $data['payment_history'] = PaymentHistory::where('student_id',$id)->paginate(20);
        $data['attendances'] = AttendanceDetail::where('student_id', $id)->paginate(20);

        return view('backend.students.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
        $data['sectiones']      = Section::all();
        $data['months']         = Month::all();
        $data['batchtypies']    = BatchType::all();
        $data['student_typies'] = StudentType::all();
        $data['student']        = Student::FindOrFail($id);


        $data['datacount'] = StudentInfo::where('user_id', $data['student']->user_id)->count();



        if ($data['datacount'] == 0) {
            $data['studentinfo'] = [];
        } else {
            $data['studentinfo']  = StudentInfo::where('user_id', $data['student']->user_id)->first();
        }

        return view('backend.students.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'class_id'    => 'required',
                'session_id'  => 'required',
                'batch_setting_id' => 'required',
                'batch_type_id' => 'required',

                'student_type_id' => 'nullable',
                'guardianmobile' => 'nullable',
                'status'        => 'nullable',

                'admission_date'    => $request->admission_date != "" ? 'required' : 'nullable',
                'start_month_id'    => $request->admission_date != "" ? 'required' : 'nullable',
                'activate_status'   => $request->admission_date != "" ? 'required' : 'nullable',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }


            $student = Student::find($id);
            $student->class_id          = $request->class_id;
            $student->session_id        = $request->session_id;
            $student->section_id        = $request->section_id;
            $student->batch_setting_id  = $request->batch_setting_id;
            $student->batch_type_id     = $request->batch_type_id;
            $student->roll              = $request->roll;
            $student->admission_date    = $request->admission_date;
            $student->student_type_id   = $request->student_type_id;
            $student->start_month_id    = $request->start_month_id;
            $student->school_name       = $request->school_name;
            $student->activate_status   = $request->activate_status;
            $student->status            = $request->activate_status;
            $student->save();



            $studentinfo =  StudentInfo::firstOrCreate(
                ['user_id' =>  $student->user_id]
            );

            $studentinfo->father        = $request->father;
            $studentinfo->mother        = $request->mother;
            $studentinfo->guardian_mobile = $request->guardianmobile;
            $studentinfo->own_mobile     = $request->mobile;
            $studentinfo->address       = $request->address;
            $studentinfo->whatsapp_number = $request->whatsapp_number;
            $studentinfo->facebook_id   = $request->facebook_id;
            $studentinfo->bkash_number  = $request->bkash_number;
            $studentinfo->email         = $request->email;
            $studentinfo->address       = $request->address;
            $studentinfo->notes          = $request->note;
            $studentinfo->status        = $request->status;
            $studentinfo->save();

            DB::commit();
            $notification = array(
                'message' => 'Student Successfully Update!',
                'alert-type' => 'success'
            );

            return redirect()->route('student.index')->with($notification);
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            if ($e->getMessage()) {
                // $message = "Something went wrong! Please Try again";
                $message = $e->getMessage();
            }

            $notification = array(
                'message' => 'Failed to Submit Student Info!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
         

        $data = Student::find($id)->delete();

        $notification = array(
            'message' => 'Student Successfully Delete!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
























 // for student folder 




            
        public function studentclass()
        {
            $data['classes'] = Classes::all();
            return view('backend.students.groupes.class',$data);
        }



        public function studentbatch($id)
        {
            $data['batchsettings'] = BatchSetting::where('classes_id',$id)->get();
            return view('backend.students.groupes.batch',$data);
        }




        public function studentbatchstudent($id)
        {   

            $data['id'] = $id;
            $data['allstudents'] = Student::with('user')->where('batch_setting_id',$id)->where('activate_status',1)->get()->sortBy('user.name')->values()->all();
            return view('backend.students.groupes.student',$data);
        }



















}
