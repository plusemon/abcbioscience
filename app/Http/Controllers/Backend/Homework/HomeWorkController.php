<?php

namespace App\Http\Controllers\Backend\Homework;


use App\Http\Controllers\Controller;
use App\Models\HomeWork;
use App\Models\HomeWorkDetail;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Sessiones;
use App\Models\Classes;
use App\Models\BatchSetting;
use App\Models\Subject;
use Carbon\Carbon;
use DB;
use Validator;
use Auth;

use App\Jobs\MatchSendSms;
use App\Models\SmsHistroy;
use App\Models\WebSetting;
use App\User;


class HomeWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         

        $data['classes']    = Classes::whereStatus(1)->get();
        $data['sessiones']  = Sessiones::whereStatus(1)->get();
        $data['subjects']   = Subject::all();

        

        return view('backend.homework.index',$data);
    }



    public function ajaxindex(Request $request)
    {


        $pagination = $request->pagination;

        $query = HomeWork::query();


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
          

        if($request->subject_id){
            $query              = $query->where('subject_id',$request->subject_id);
            $data['subject_id'] = $request->subject_id;
        }
         

        if($request->chapter_id){
            $query              = $query->where('chapter_id',$request->chapter_id);
            $data['chapter_id'] = $request->chapter_id;
        }


        if($pagination == 'all_data')
        {
            $pagination = $query->orderBy('id', 'DESC')->count();
        }else{
            $pagination = $pagination;
        }


        $data['homeworks'] = $query->latest()->get(); 

 
        return view('backend.homework.ajax_index',$data);
    }





    public function getsubmittedstudentlist(Request $request)
    {

        $data['homeworks'] = HomeWorkDetail::where('home_work_id',$request->home_work_id)
                                                    ->where('status',1)
                                                    ->get();

        return view('backend.homework.submitted',$data);

    }

    public function getpendingstudentlist(Request $request)
    {

        $data['homeworks'] = HomeWorkDetail::where('home_work_id',$request->home_work_id)
                                                    ->where('status',0)
                                                    ->get();

        return view('backend.homework.pending',$data);
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data['classes']    = Classes::whereStatus(1)->get();
        $data['sessiones']  = Sessiones::whereStatus(1)->get();
        $data['subjects']   = Subject::all();
 


        return view('backend.homework.create',$data);
    }




    public function studentajax(Request $request)
    {


        $query = Student::query();

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



        $data['allstudents']  = $query
                ->leftJoin('users', 'students.user_id', 'users.id')
                ->leftJoin('classes', 'students.class_id', 'classes.id')
                ->leftJoin('sessiones', 'students.session_id', 'sessiones.id')
                ->leftJoin('batch_settings', 'students.batch_setting_id', 'batch_settings.id')
                ->leftJoin('batch_typies', 'students.batch_type_id', 'batch_typies.id')
                ->select('users.*', 'classes.name as cl_name', 'students.*', 'sessiones.name as ses_name', 'batch_settings.batch_name as bs_name', 'batch_typies.name as bt_name')
                ->orderBy('users.name', 'ASC')
                ->whereIn('activate_status',[1])
                ->get();


        return view('backend.homework.ajax_create_student',$data);   
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
            $homework = New HomeWork();

            $homework->classes_id     = $request->class_id;
            $homework->sessiones_id   = $request->session_id;
            $homework->batch_setting_id= $request->batch_setting_id;
            $homework->subject_id     = $request->subject_id;
            $homework->chapter_id     = $request->chapter_id;
            $homework->topic          = $request->topic;
          
            
            $attachment  = $request->attachment;
            if($attachment){
                $uniqname   = uniqid();
                $filenameoriginal = $attachment->getClientOriginalName();
                $ext        = strtolower($attachment->getClientOriginalExtension());
                $filepath   = 'public/uploads/homework/';
                $namedata   =  pathinfo($filenameoriginal, PATHINFO_FILENAME);
    
                $imagename  = $filepath.$namedata."_".$uniqname.'.'.$ext;
                $attachment->move($filepath,$imagename);
                
               $homework->attachment = $imagename;
            }
                
            
             
            
            $homework->date_of_assign  = $request->date_of_assign;
            $homework->dead_line      = $request->dead_line;
            
            $homework->is_admin       = Auth::user()->id;
            $homework->status         =2;

            $homework->save();


            $totalpresent = 0;
            $totalabsent  = 0;

            if($request->student_id !='')
            {
                if(!empty($input['student_id'])){

                    foreach($input['student_id'] as $key => $value){
                        $homeworkdetail = new HomeWorkDetail();
                        $homeworkdetail->home_work_id = $homework->id;
                        $homeworkdetail->student_id = $input['student_id'][$key];
                        $homeworkdetail->status = 0;
                        $homeworkdetail->save();
                        
                        $totalpresent = $totalpresent+1;
                    } 
                }
            }


            $homeworkupdate = HomeWork::find($homework->id);
            $homeworkupdate->total_student = $totalpresent + $totalabsent;
            $homeworkupdate->total_present = $totalpresent;
            $homeworkupdate->total_absent =  $totalabsent;
            $homeworkupdate->save();


            DB::commit();
            $notification = array(
                'message' => 'Home Work Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->route('student.homework.index')->with($notification);
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
                'message' => 'Failed to Submit Homework Info!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($message);
        }
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeWork  $homeWork
     * @return \Illuminate\Http\Response
     */
    public function show(HomeWork $homeWork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeWork  $homeWork
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeWork $homeWork,$id)
    {
         
        $data['classes']    = Classes::whereStatus(1)->get();
        $data['sessiones']  = Sessiones::whereStatus(1)->get();
        $data['subjects']   = Subject::all();

        
        $data['homework'] = HomeWork::find($id);

        return view('backend.homework.edit',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeWork  $homeWork
     * @return \Illuminate\Http\Response
     */
     
     
   public function update(Request $request, HomeWork $homeWork,$id)
    {
         
        $websetting = WebSetting::find(1);

        $input = $request->all();
    
    

       if(!empty($request->homework_detail_id ||  $request->homework_detail_id != '' ))
       {    

            foreach($input['homework_detail_id'] as $key => $value){

                $data =  HomeWorkDetail::find($input['homework_detail_id'][$key]);
                $data->status = $input['homework'][$key];
                $data->save();



                 if($input['sms'][$key]=='Yes'){

                            $findstudent = Student::find($input['student_id'][$key]);
                            $dateattendance = Date('d-m-Y',strtotime($data->created_at));
                            
                            $dayname = Carbon::parse($dateattendance)->format('l');
                            
                    
                            $data['message'] = "Dear student,
Asking to do Homework on the chapter - ". $data->mainhomework->chapter->name ." ( ". $data->mainhomework->topic ." ) 
Last date of submission: ". date('d-M-Y',strtotime($data->mainhomework->dead_line)) ."
Please, complete the homework within the specified time.
#". $websetting->site_name.".";

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



        $notification = array(
                'message' => 'Home Work pending Student Send message Message Successfully!',
                'alert-type' => 'success'
        );
        return redirect()->route('student.homework.index')->with($notification);





    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeWork  $homeWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeWork $homeWork,$id)
    {
        HomeWorkDetail::where('home_work_id',$id)->delete();

        homeWork::find($id)->delete();

        $notification = array(
            'message' => 'Home work delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
