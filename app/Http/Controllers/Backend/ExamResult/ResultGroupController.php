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
use DB;

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











    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'session_id' => 'required',
            'batch_setting_id' => 'required',
            'mcq_exam_setting_id' => 'required',
            'written_exam_setting_id' => 'required',
        ]);



        $findExamSetting = ExamSetting::find($request->mcq_exam_setting_id);
        $findWrittenExamSetting = ExamSetting::find($request->written_exam_setting_id);


        $mcqtotal =  $findExamSetting->mcqQuestionSubjects->mcqQuestions->count();
        $writtentotal = $findWrittenExamSetting->writtenQuestionSubjects->total_mark;
        

        
        $ResultGroup = New ResultGroup();
        $input       = $request->except('_token');
        $input['mcq_exam_total_mark']     =    $mcqtotal;
        $input['written_exam_total_mark'] =    $writtentotal;
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
                

            $findgroup = ResultGroup::find($group->id);

            $input = $request->all();

            $insert_data = collect();

            if($input['student_id']!=null){

                foreach($input['student_id'] as $key =>$value)
                {


                    $findstudent = Student::find($input['student_id'][$key]);

                    $user = User::find($findstudent->user_id);


                    if($input['result'][$key]=='Absent')
                    {

                        $data['message'] = "Respected  Guardian,
Obtained marks of your child on ". $findgroup->name ." on chapter ". $group->mcqexamsetting->mcqQuestionSubjects->chapter->name ." ( " .  $group->mcqexamsetting->mcqQuestionSubjects->topic . " ) are-
CQ: was absent;
MCQ: was absent;
Total: 00 out of ".$request->totalmark."

Please, take necessary steps.

#ABCBioScience.";


                    }
                    elseif($input['result'][$key]=='00')
                    {


                        $data['message'] = "Respected  Guardian,
Obtained marks of your child on ". $findgroup->name ." of chapter ". $group->mcqexamsetting->mcqQuestionSubjects->chapter->name ." ( " .  $group->mcqexamsetting->mcqQuestionSubjects->topic . " ) are-

CQ: ". $input['written'][$key] ." /". $request->writtentotalmark ." 
MCQ: ". $input['mcq'][$key] ." /". $request->mcqtotalmark.";
Total: 00 out of ". $request->totalmark."

Please, take necessary steps.

#ABCBioScience.";


                    }else{


                        $data['message'] = "Respected  Guardian,
Obtained marks of your child on ". $findgroup->name ." of chapter ". $group->mcqexamsetting->mcqQuestionSubjects->chapter->name ." ( " .  $group->mcqexamsetting->mcqQuestionSubjects->topic . " ) are-

CQ: ". $input['written'][$key] ." /". $request->writtentotalmark ." 
MCQ: ". $input['mcq'][$key] ." /". $request->mcqtotalmark.";
Total: ". $input['result'][$key]  ." out of ". $request->totalmark."

#ABCBioScience.";

                    }

 
 



                /*for sms */

                if($input['sms'][$key]=='Yes'){

                        try {

                            $smsJob = new MatchSendSms($user->mobile,$data['message']);

                            dispatch($smsJob);
 
                            
                            $insert_data->push([
                                'user_id'       => $user->id,
                                'student_id'    => $findstudent->id, 
                                'message'       => $data['message'],
                                'status'        => 1,
                            ]);
                            
                            
                            
                            
                            
                            
                            

                        } catch (\Exception $e) {
                            echo $e->getMessage();
                        }

                }






                }   // end foreach
                
                
                
                foreach ($insert_data->chunk(5000) as $chunk)
                {
                   \DB::table('sms_histroys')->insert($chunk->toArray());
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
