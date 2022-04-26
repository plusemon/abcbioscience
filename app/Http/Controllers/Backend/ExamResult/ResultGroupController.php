<?php

namespace App\Http\Controllers\Backend\ExamResult;

use App\Model\ResultGroup;
use App\Models\Classes;
use App\Models\Sessiones;
use App\Model\ExamSetting;
use App\Models\BatchSetting;
use Illuminate\Http\Request;
use Idemonbd\Notify\Facades\Notify;
use App\Http\Controllers\Controller;
use App\Model\McqExamStudentAnsSummary;
use App\Model\StudentQuestionSetting;
use App\Models\Student;
use App\Models\WrittenExamResult;
use App\Models\SmsHistroy;
use Auth;
use App\Jobs\MatchSendSms;
use App\User;
use App\Models\WebSetting;

class ResultGroupController extends Controller
{
    public function index(Request $request)
    {

        $data['classes'] = Classes::whereStatus(1)->get();
        $data['sessiones'] = Sessiones::whereStatus(1)->get();

        $data['result_groups'] = ResultGroup::get();

        return view('backend.exam.group-result.index', $data);
    }






    public function getmcqexamlist(Request $request)
    {
        $batch = "<option value=''> Select MCQ Exam List </option>";

        $class_id     = $request->class_id;
        $session_id   = $request->session_id;
        $batch_setting_id   = $request->batch_setting_id;


        $findExamSetting = ExamSetting::where('class_id',$class_id)
                                    ->where('session_id', $session_id)
                                    ->where('batch_setting_id',$batch_setting_id)
                                    ->where('fee_cat_id',4)
                                    ->get();

        foreach ($findExamSetting as $key => $value) {
            $batch .= "<option value='$value->id'>". $value->mcqQuestionSubjects->question_no ." </option>";
        }

        if ($findExamSetting) {
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


    public function getwrittenexamlist(Request $request)
    {
        $batch = "<option value=''> Select Written Exam List </option>";

        $class_id     = $request->class_id;
        $session_id   = $request->session_id;
        $batch_setting_id   = $request->batch_setting_id;


        $findExamSetting = ExamSetting::where('class_id',$class_id)
                                    ->where('session_id', $session_id)
                                    ->where('batch_setting_id',$batch_setting_id)
                                    ->where('fee_cat_id',5)
                                    ->get();
                    
             
                                   

        foreach ($findExamSetting as $key => $value) {
             
            $batch .= "<option value='$value->id'>". $value->writtenQuestionSubjects->question_no ." </option>";
        }

        if ($findExamSetting) {
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
    
    public function getofflinemcqexamlist(Request $request)
    {
        $batch = "<option value=''> Select Offline MCQ Exam List </option>";

        $class_id     = $request->class_id;
        $session_id   = $request->session_id;
        $batch_setting_id   = $request->batch_setting_id;


        $findExamSetting = ExamSetting::where('class_id',$class_id)
                                    ->where('session_id', $session_id)
                                    ->where('batch_setting_id',$batch_setting_id)
                                    ->where('fee_cat_id',8)
                                    ->get();
                    
             
                                   

        foreach ($findExamSetting as $key => $value) {
             
            $batch .= "<option value='$value->id'>". $value->OfflineMcqQuestionSubjects->question_no ." </option>";
        }

        if ($findExamSetting) {
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











    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'session_id' => 'required',
            'batch_setting_id' => 'required',
            'written_exam_setting_id' => 'required',
            'mcq_exam_type' => 'required',
        ]);



        $findExamSetting            = ExamSetting::find($request->mcq_exam_setting_id);
        $findofflinemcqExamSetting  = ExamSetting::find($request->offlinemcq_exam_setting_id);
        $findWrittenExamSetting     = ExamSetting::find($request->written_exam_setting_id);
        
      
        $writtentotal               = $findWrittenExamSetting->writtenQuestionSubjects->total_mark;
        $offlinemcqtotal            = $findofflinemcqExamSetting->OfflineMcqQuestionSubjects->total_mark;
        
        
        
        

        $ResultGroup = New ResultGroup();
        $input       = $request->except('_token');
        
        if($request->mcq_exam_type==1)
        {
           $mcqtotal                   = $findExamSetting->mcqQuestionSubjects->mcqQuestions->count();
           $input['mcq_exam_setting_id']     =    $request->mcq_exam_setting_id;
           $input['mcq_exam_total_mark']     =    $mcqtotal;
        }
        elseif($request->mcq_exam_type==2)
        {
           $input['mcq_exam_setting_id']     =    $request->offlinemcq_exam_setting_id;
           $input['mcq_exam_total_mark']     =    $offlinemcqtotal;
        }
        
        
        $input['written_exam_total_mark'] =    $writtentotal;
        $input['mcq_exam_type']           =    $request->mcq_exam_type;
        
        $ResultGroup->fill($input)->save();

        $notification = array(
            'message' => 'Exam Result Group Successfully Added!',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }





    public function show(ResultGroup $group,Request $request)
    {

        $data['students'] = Student::with('user')
            ->where('activate_status', 1)
            ->where('batch_setting_id', $group->batch_setting_id) //
            ->where('class_id', $group->class_id)
            ->where('session_id', $group->session_id)
            ->get()
            ->sortBy('user.name')->values()->all();



      /*  $data['students'] = Student::with('user')
                ->where('activate_status',1)
                ->where('batch_setting_id', $group->batch_setting_id) //
                ->where('class_id', $group->class_id)
                ->where('session_id', $group->session_id)
                ->get(['id','batch_setting_id', 'user_id','session_id','session_id'])
                ->sortBy('user.name')->values()->all();*/




        return view('backend.exam.group-result.result_show',$data,compact('group',$group));

}








    public function update(ResultGroup $group, Request $request)
    {

            $websetting = WebSetting::find(1);

            $findgroup = ResultGroup::find($group->id);
            $input = $request->all();

            if($input['student_id']!=null){

                foreach($input['student_id'] as $key =>$value)
                {


                    $findstudent = Student::find($input['student_id'][$key]);

                    $user = User::find($findstudent->user_id);


                    if($input['result'][$key]=='Absent')
                    {

                        $data['message'] = "Honourable Guardian

Obtained marks of the student on ". $findgroup->name ." of chapter ". $group->mcqexamsetting->mcqQuestionSubjects->chapter->name ." ( " .  $group->mcqexamsetting->mcqQuestionSubjects->topic . " ) are-

CQ: was absent;
MCQ: was absent;
Total: 00 out of ".$request->totalmark."

Please, take necessary steps.

#". $websetting->site_name.".";


                    }
                    elseif($input['result'][$key]=='00')
                    {


                        $data['message'] = "Honourable Guardian

Obtained marks of the student on ". $findgroup->name ." of chapter ". $group->mcqexamsetting->mcqQuestionSubjects->chapter->name ." ( " .  $group->mcqexamsetting->mcqQuestionSubjects->topic . " ) are-

CQ: ". $input['written'][$key] ." /". $request->writtentotalmark ."
MCQ: ". $input['mcq'][$key] ." /". $request->mcqtotalmark.";
Total: 00 out of ". $request->totalmark."

Please, take necessary steps.

#". $websetting->site_name.".";


                    }else{


                        $data['message'] = "Honourable Guardian

Obtained marks of the student on ". $findgroup->name ." of chapter ". $group->mcqexamsetting->mcqQuestionSubjects->chapter->name ." ( " .  $group->mcqexamsetting->mcqQuestionSubjects->topic . " ) are-

CQ: ". $input['written'][$key] ." /". $request->writtentotalmark ."
MCQ: ". $input['mcq'][$key] ." /". $request->mcqtotalmark.";
Total: ". $input['result'][$key]  ." out of ". $request->totalmark."

#". $websetting->site_name.".";

                    }



                /*for sms */

                if($input['sms'][$key]=='Yes'){


                $smsJob = new MatchSendSms($user->mobile,$data['message']);

                dispatch($smsJob);

                $smshistory = new SmsHistroy();
                $smshistory->user_id    = $user->id;
                $smshistory->student_id = $findstudent->id;
                $smshistory->message    = $data['message'];
                $smshistory->status     = 1;
                $smshistory->save();

                }

            }
        }



        $notification = array(
            'message' => 'SMS Send Successfully Completed!',
            'alert-type' => 'success'
        );

        return back()->with($notification);





    }









    public function destroy(ResultGroup $group)
    {

        $group->delete();


        $notification = array(
            'message' => 'Exam Result Group Successfully Deleted!',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }








}
