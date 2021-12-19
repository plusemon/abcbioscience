<?php

namespace App\Http\Controllers\Backend\Attendance;

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
use App\Models\BatchSetting;
use App\Models\StudentType;
use App\Models\Attendance;
use App\Models\AttendanceDetail;
use DB;
use Validator;
use Auth;
use App\Jobs\MatchSendSms;
use App\Models\SmsHistroy;
use PDF;

class AttendanceController extends Controller
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



        $query = Attendance::query();


        if($request->class_id){
            $query              = $query->where('classes_id',$request->class_id);
            $data['class_id']   = $request->class_id;
        }
         
        if($request->session_id){
            $query              = $query->where('sessiones_id',$request->session_id);
            $data['session_id'] = $request->session_id;
        }


        if($request->batch_setting_id)
        {
            $query = $query->where('batch_setting_id',$request->batch_setting_id);
            $data['batch_setting_id'] = $request->batch_setting_id; 
        }
        else{
            $data['batch_setting_id'] = 0;
        }


        if($request->attendance_date)
        {
            $data['attendance_date'] = $request->attendance_date;
        }


        $data['attendances'] = $query->latest()->get(); 
                            


        return view('backend.attendances.view',$data);
    }




    public function ajaxindex(Request $request)
    {
         $query = Attendance::query();


        if($request->class_id){
            $query              = $query->where('classes_id',$request->class_id);
            $data['class_id']   = $request->class_id;
        }
         
        if($request->session_id){
            $query              = $query->where('sessiones_id',$request->session_id);
            $data['session_id'] = $request->session_id;
        }


        if($request->batch_setting_id)
        {
            $query = $query->where('batch_setting_id',$request->batch_setting_id);
            $data['batch_setting_id'] = $request->batch_setting_id; 
        }
        else{
            $data['batch_setting_id'] = 0;
        }


        if($request->attendance_date)
        {
            $data['attendance_date'] = $request->attendance_date;
        }


        $data['attendances'] = $query->latest()->get(); 
                            

        return view('backend.attendances.view_ajax',$data);
    }


    public function attendanceexport($id)
    {

        $data['attendance']  = Attendance::find($id);

        $pdf = PDF::loadView('backend.attendances.attendance_pdf',$data);
        return $pdf->download('student_attendance.pdf');
    }




    public function getstudentlist(Request $request)
    {

        $id = $request->attendence_id;

        $data['attendance'] = Attendance::find($id);

         return view('backend.attendances.present_list',$data);

    }



    public function getabsentstudentlist(Request $request)
    {

        $id = $request->attendence_id;

        $data['attendance'] = Attendance::find($id);

         return view('backend.attendances.absent_list',$data);

    }

















    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
        $data['sectiones']      = Section::all();
        $data['months']         = Month::all();
        $data['student_typies'] = StudentType::all();



        $query = Student::query();


        if($request->class_id){
            $query = $query->where('class_id',$request->class_id);
            $data['class_id'] = $request->class_id;
        }
        else{
           $query = $query->where('class_id',100);
        }
        if($request->session_id){
            $query = $query->where('session_id',$request->session_id);
            $data['session_id'] = $request->session_id;
        }
        else{
            $data['session_id'] = 1;
        }

        if($request->batch_setting_id)
        {
            $query = $query->where('batch_setting_id',$request->batch_setting_id);
            $data['batch_setting_id'] = $request->batch_setting_id; 
        }
        else{
            $data['batch_setting_id'] = 0;
        }
 

        if($request->attendance_date)
        {
            $data['attendance_date'] = $request->attendance_date;
        }
        else{
             $data['attendance_date'] = Date('d-m-Y');
        }
        


        if($request->class_id || $request->session_id || $request->batch_setting_id || $request->student_type_id){
        $data['students'] = $query->with(['user'])
                                    ->whereIn('activate_status',[1])
                                    ->get()
                                    ->sortBy('user.name')
                                    ->values()
                                    ->all();
            $data['datacount'] = $query->count();
        }
        else{
            $data['datacount'] = $query->count();
            $data['students']  = $query->with(['user'])
                                        ->whereIn('activate_status',[1])
                                        ->get()
                                        ->sortBy('user.name')
                                        ->values()
                                        ->all();
        }



        $data['countattendance'] = Attendance::where('classes_id',$request->class_id)
                                                ->where('sessiones_id',$request->session_id)
                                                ->where('batch_setting_id',$request->batch_setting_id)
                                                ->where('attendance_date',$request->attendance_date)
                                                ->count();

 


        return view('backend.attendances.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
       $input = $request->all();
       DB::beginTransaction();
        try
        {
            $attendance = New Attendance();

            $attendance->classes_id     = $request->classes_id;
            $attendance->sessiones_id   = $request->sessiones_id;
            $attendance->batch_setting_id= $request->batch_setting_id;
            $attendance->attendance_date = Date('Y-m-d H:i:s',strtotime($request->attendance_date));
            $attendance->is_admin       = Auth::user()->id;
            $attendance->status         =2;

            $attendance->save();


            $totalpresent = 0;
            $totalabsent  = 0;

            if($request->student !='')
            {
                if(!empty($input['student'])){

                    foreach($input['student'] as $key => $value){
                        $attendancedetail = new AttendanceDetail();
                        $attendancedetail->attendance_id = $attendance->id;
                        $attendancedetail->student_id = $input['student'][$key];
                        $attendancedetail->attendance = $input['attendance'][$key];
                        $attendancedetail->status = 0;
                        $attendancedetail->save();

                        if($input['attendance'][$key] == 'Present')
                        {
                            $totalpresent = $totalpresent+1;
                        }
                        else{
                            $totalabsent = $totalabsent+1;
                        }
                    } 
                }
            }


            $attendanceupdate = Attendance::find($attendance->id);
            $attendanceupdate->total_student = $totalpresent + $totalabsent;
            $attendanceupdate->total_present = $totalpresent;
            $attendanceupdate->total_absent =  $totalabsent;
            $attendanceupdate->save();


            DB::commit();
            $notification = array(
                'message' => 'Attendance Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->route('student.attendance.create')->with($notification);
        } 
         catch(\Exception $e) {
            DB::rollback();
            if($e->getMessage())
            {
                $notification = array(
                    'message' => 'Someting Wrong!',
                    'alert-type' => 'error'
                );
                $message = $e->getMessage();

            }

            $notification = array(
                'message' => 'Failed to Submit Attendance Info!',
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
    public function show(Request $request)
    {
        $id = $request->attendence_id;

        $data['attendance'] = Attendance::find($id);

        return view('backend.attendances.show',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
        $data['sectiones']      = Section::all();
        $data['months']         = Month::all();
        $data['student_typies'] = StudentType::all();



        $query = Student::query();


        if($request->class_id){
            $query = $query->where('class_id',$request->class_id);
            $data['class_id'] = $request->class_id;
        }
        else{
           $query = $query->where('class_id',100);
        }
        if($request->session_id){
            $query = $query->where('session_id',$request->session_id);
            $data['session_id'] = $request->session_id;
        }

        if($request->batch_setting_id)
        {
            $query = $query->where('batch_setting_id',$request->batch_setting_id);
            $data['batch_setting_id'] = $request->batch_setting_id; 
        }
 

        if($request->attendance_date)
        {
            $data['attendance_date'] = $request->attendance_date;
        }
        


        if($request->class_id || $request->session_id || $request->batch_setting_id || $request->student_type_id){
            $data['students'] = $query->get();
            $data['datacount'] = $query->count();
        }
        else{
            $data['datacount'] = $query->count();
            $data['students'] = $query->get();
        }



        $data['countattendance'] = Attendance::where('classes_id',$request->class_id)
                                                ->where('sessiones_id',$request->session_id)
                                                ->where('batch_setting_id',$request->batch_setting_id)
                                                ->where('attendance_date',$request->attendance_date)
                                                ->count();



        $data['attendance'] = Attendance::find($id);

       


        return view('backend.attendances.edit',$data);




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
        try
        {
            $attendance = Attendance::find($id);


            $totalpresent = 0;
            $totalabsent  = 0;

            if($request->student !='')
            {
                if(!empty($input['student'])){

                    AttendanceDetail::where('attendance_id',$attendance->id)->delete();

                    foreach($input['student'] as $key => $value){
                        $attendancedetail = new AttendanceDetail();
                        $attendancedetail->attendance_id = $attendance->id;
                        $attendancedetail->student_id = $input['student'][$key];
                        $attendancedetail->attendance = $input['attendance'][$key];
                        
                         if($input['attendance'][$key] == 'Present')
                        {
                        
                            $attendancedetail->status = 1;
                        
                        }
                        else{
                            $attendancedetail->status = 0;
                        }
                        
                        $attendancedetail->save();

                        if($input['attendance'][$key] == 'Present')
                        {
                            $totalpresent =  $totalpresent+1;
                        }
                        else{
                            $totalabsent =  $totalabsent+1;
                        }



                        if($input['sms'][$key]=='Yes'){

                            $findstudent = Student::find($input['student'][$key]);

                             $dateattendance = Date('d-m-Y',strtotime($request->attendance_date));
            
                            $data['message'] ="Respected Guardian,
Your son/daughter : ( ". $findstudent->user->name .", ID No.:".$findstudent->user->useruid.") was absent from today's ( ". $dateattendance ." ) class.

#ABCBioScience.";
 
                                $finduser = User::where('id', $findstudent->user_id)->first();

                                $data['number']  = $finduser->mobile;



                                    $data['number'] = $findstudent->user->mobile;

                                    $smsJob = new MatchSendSms($data['number'], $data['message']);

                                    dispatch($smsJob);

                                    $smshistory = new SmsHistroy();
                                    $smshistory->user_id    = $findstudent->user_id;
                                    $smshistory->student_id = $findstudent->id;
                                    $smshistory->message    = $data['message'];
                                    $smshistory->status     = 1;
                                    $smshistory->save();
                                 
 
 
                            } /*sms end*/



















                    } 
                }
            }
 
            $attendanceupdate = Attendance::find($attendance->id);
            $attendanceupdate->total_student = $totalpresent + $totalabsent;
            $attendanceupdate->total_present = $totalpresent;
            $attendanceupdate->total_absent =  $totalabsent;
            $attendanceupdate->save();


            DB::commit();
            $notification = array(
                'message' => 'Attendance Successfully Update!',
                'alert-type' => 'success'
            );
            return redirect()->route('student.attendance.index')->with($notification);
        } 
         catch(\Exception $e) {
            DB::rollback();
            if($e->getMessage())
            {
                // $message = "Something went wrong! Please Try again";
                $message = $e->getMessage();

            }

            $notification = array(
                'message' => 'Failed to Submit Attendance Info!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($message);
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
         
       /* $data = Attendance::find($id);
        $data->status = 0;
        $data->save();*/

        AttendanceDetail::where('attendance_id',$id)->delete();

        Attendance::find($id)->delete();

        $notification = array(
            'message' => 'Attendance delete Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
