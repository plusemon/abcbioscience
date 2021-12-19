<?php

namespace App\Http\Controllers\Backend\SMS;

use DB;
use Auth;
use App\User;
use Validator;
use App\Models\Year;
use App\Models\Batch;
use App\Models\Month;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use App\Models\Sessiones;
use App\Jobs\MatchSendSms;
use App\Model\ExamSetting;
use App\Models\SmsHistroy;
use App\Models\SmsTemplete;
use App\Models\StudentInfo;
use App\Models\StudentType;
use App\Models\BatchSetting;
use Illuminate\Http\Request;
use App\Models\AbsentStudent;
use App\Models\WrittenExamResult;
use App\Http\Controllers\Controller;
use App\Model\McqExamStudentAnsSummary;

class SmsController extends Controller
{


    /*all student sms */

    public function allstudentsms()
    {
        return view('backend.sms.sms.allstudent');
    }

    public function allstudentsmssend(Request $request)
    {

        $students = Student::where('activate_status', 1)->whereNull('deleted_at')->get();
        $data['message']  = $request->message;


        foreach ($students as $student) {
            try {
                $smsJob = new MatchSendSms($student->user->mobile, $data['message']);

                dispatch($smsJob);

                $smshistory = new SmsHistroy();
                $smshistory->user_id    = $student->user_id;
                $smshistory->student_id = $student->id;
                $smshistory->message    = $request->message;
                $smshistory->status     = 1;
                $smshistory->save();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        $notification = array(
            'message' => 'SMS Send Successfully Completed!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }





    public function batchsms()
    {
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();

        return view('backend.sms.sms.batch', $data);
    }

    public function batchsmssend(Request $request)
    {



        $class_id        = $request->class_id;
        $session_id      = $request->session_id;
        $batch_setting_id = $request->batch_setting_id;

        $data['message'] = $request->message;

        $allstudents = Student::where('class_id', $class_id)
            ->where('session_id', $session_id)
            ->where('batch_setting_id', $batch_setting_id)
            ->where('activate_status', 1)
            ->get();


        foreach ($allstudents as $student) {

            try {

                $data['number'] = $student->user->mobile;

                $smsJob = new MatchSendSms($data['number'], $data['message']);

                dispatch($smsJob);

                $smshistory = new SmsHistroy();
                $smshistory->user_id    = $student->user_id;
                $smshistory->student_id = $student->id;
                $smshistory->message    = $request->message;
                $smshistory->status     = 1;
                $smshistory->save();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }



        $notification = array(
            'message' => 'SMS Send Successfully Completed!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }




    /*single student sms*/
    public function singlesms()
    {
        $data['students'] = User::where('role_id', 3)->get();
        return view('backend.sms.sms.single', $data);
    }


    public function singlesmssend(Request $request)
    {


        $data['message']  = $request->message;
        $student_id       = $request->student_id;

        $data['students'] = User::where('id', $request->student_id)->first();


        $data['number']  = $data['students']->mobile;


        try {
            $smsJob = new MatchSendSms($data['number'], $data['message']);

            dispatch($smsJob);


            $smshistory = new SmsHistroy();
            $smshistory->user_id    =  $data['students']->id;
            $smshistory->student_id = $student_id;
            $smshistory->message    = $data['message'];
            $smshistory->status     = 1;
            $smshistory->save();

            $notification = array(
                'message' => 'SMS Send Successfully Completed!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }





    /*custom student sms*/

    public function custombatchsms()
    {
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
        return view('backend.sms.sms.custombatchsms', $data);
    }


    /*surprise sms send method*/

    public function custombatchsmssend(Request $request)
    {



        $request->validate([
            'message'          => 'required',
            'user_id.*'        => 'required'
        ]);





        $input =  $request->all();

        $data['message'] = $request->message;



        if (!empty($input['user_id'])) {

            foreach ($input['user_id'] as $key => $value) {

                $showuser = User::find($input['user_id'][$key]);

                $data['number'] = $showuser->mobile;


                try {
                    $smsJob = new MatchSendSms($data['number'], $data['message']);

                    dispatch($smsJob);


                    $smshistory = new SmsHistroy();
                    $smshistory->user_id    = $input['user_id'][$key];
                    $smshistory->student_id = $input['student_id'][$key];
                    $smshistory->message    = $request->message;
                    $smshistory->status     = 1;
                    $smshistory->save();
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }


            $notification = array(
                'message' => 'SMS Send Successfully Completed!',
                'alert-type' => 'success'
            );


            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Please Select Student!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }


    public function mcqAllStudentSMS(Request $request)
    {

        $request->validate([
            'exam_id' => 'required',
            'test_name' => 'required',
            'subject_name' => 'required',
            'students_ids' => 'required',
        ]);

        $exam = ExamSetting::findOrFail($request->input('exam_id'));
        $exam->highest_mark = McqExamStudentAnsSummary::where('mcq_exam_setting_id', $exam->id)->max('final_result') ?? 0;

         $students = Student::with(['user'])
            ->find($request->students_ids)
            ->reject(function ($student) {
                return $student->user->mobile == null;
            })->map(function ($student) use ($exam) {
                $student = [
                    'id' => $student->id,
                    'user_id' => $student->user->id,
                    'student_id' => $student->user->useruid,
                    'name' => $student->user->name,
                    'mobile' => $student->user->mobile,
                    'result' => $student->mcq_result(request('exam_id'))->final_result ?? null,
                ];
                if (request('sms_type') == 'all') {
                    $student['message'] = $this->createMCQMgs($student, request(), $exam);
                } else {
                    $student['message'] = request('message');
                }
                return $student;
            });

        foreach ($students as $student) {
            try {
                // dispatch(new MatchSendSms('01995329555', $student['message']));
              //   dispatch(new MatchSendSms('01818737845', $student['message']));
             //    dispatch(new MatchSendSms('01779325718', $student['message']));
               dispatch(new MatchSendSms($student['mobile'], $student['message']));

                $smshistory = new SmsHistroy();
                $smshistory->user_id = $student['user_id'];
                $smshistory->student_id = $student['id'];
                $smshistory->message = $student['message'];
                $smshistory->status = 1;
                $smshistory->save();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        $notification = array(
            'message' => 'SMS Send Successfully Completed!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function createMCQMgs($student, Request $request, $exam)
    {
        // return $exam;
        $exam_name = optional($exam->mcqQuestionSubjects)->question_no ?? '';
        $exam_subject = optional($exam->subjects)->name ?? '';
        $exam_topic =  optional($exam->writtenQuestionSubjects)->topic  ?? '';
        $exam_total_mark = $exam->mcqQuestionSubjects->mcqQuestions->count();
        $exam_highest_mark = McqExamStudentAnsSummary::where('mcq_exam_setting_id', $exam->id)->get('final_result')->max('final_result');
        $exam_start_date_time = date('d/m/y');

        $student_id = $student['student_id'];
        $student_name = $student['name'];
        $student_result = $student['result'];

        if ($student_result && $exam_total_mark) {
            $obtained_mark_percent = intval($student_result / $exam_total_mark * 100);
$message ="MCQ exam result of the student: (" .$student_name .",ID no. " . $student_id . ")
Exam :". $exam_name ."
Subject :  " . $exam_subject ."
Topic :  " . $exam_topic . "
Total marks : ". $exam_total_mark . "
Obtained marks: ". $student_result ."
Highest marks: " . $exam_highest_mark . "

#ABCBioScience.";


        } else {
            $message = "Respected Guardian,
The student (".$student_name .",ID no. ". $student_id .")
didn't participate in the last MCQ exam on 
Exam :". $exam_name ."
Subject :  " . $exam_subject ."
Topic :  " . $exam_topic . "
that was held on  ".$exam_start_date_time.".

Please, take necessary step.

#ABCBioScience.";
        }
        return $message;
    }

    public function writtenAllStudentSMS(Request $request)
    {
        // return $request;
        $request->validate([
            'exam_id' => 'required',
            'test_name' => 'required',
            'subject_name' => 'required',
            'students_ids' => 'required',
        ]);

        $exam = ExamSetting::findOrFail($request->input('exam_id'));
         $students = Student::with(['user'])
            ->find($request->students_ids)
            ->reject(function ($student) {
                return $student->user->mobile == null;
            })->map(function ($student) use ($exam) {
                $student = [
                    'id' => $student->id,
                    'user_id' => $student->user->id,
                    'student_id' => $student->user->useruid,
                    'name' => $student->user->name,
                    'mobile' => $student->user->mobile,
                    'result' => $student->written_result(request('exam_id'))->result ?? null,
                ];
                if (request('sms_type') == 'all') {
                    $student['message'] = $this->createWrritenMgs($student, $exam);
                } else {
                    $student['message'] = request('message');
                }
                return $student;
            });

        foreach ($students as $student) {
            try {
                // dispatch(new MatchSendSms('01995329555', $student['message'])); // emon
               //  dispatch(new MatchSendSms('01779325718', $student['message'])); // taleb
                // dispatch(new MatchSendSms('01818737845', $student['message'])); // taleb
              dispatch(new MatchSendSms($student['mobile'], $student['message']));

                $smshistory = new SmsHistroy();
                $smshistory->user_id = $student['user_id'];
                $smshistory->student_id = $student['id'];
                $smshistory->message = $student['message'];
                $smshistory->status = 1;
                $smshistory->save();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        $notification = array(
            'message' => 'SMS Send Successfully Completed!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }



    public function createWrritenMgs($student, $exam)
    {
        // return $exam;
        $exam_name = optional($exam->writtenQuestionSubjects)->question_no ?? '';
        $exam_subject = optional($exam->subjects)->name ?? '';
        
        $exam_chapter = optional($exam->writtenQuestionSubjects->chapter)->name ?? '';
        $exam_topic =  optional($exam->writtenQuestionSubjects)->topic  ?? '';
        
        $exam_total_mark = optional($exam->writtenQuestionSubjects)->total_mark;
        $exam_highest_mark = WrittenExamResult::where('exam_setting_id', $exam->id)->get('result')->max('result');
        $exam_start_date_time = date('d/m/y');


        $student_id = $student['student_id'];
        $student_name = $student['name'];
        $student_result = $student['result'];

        if ($student_result && $exam_total_mark) {
            $obtained_mark_percent = intval($student_result / $exam_total_mark * 100);
            $message ="Written exam result of the student: (" .$student_name .",ID no. " . $student_id . ")
Exam :". $exam_name ."
Subject :  " . $exam_subject ."
Topic :  " . $exam_topic . "
Total marks : ". $exam_total_mark . "
Obtained marks: ". $student_result ."
Highest marks: " . $exam_highest_mark . "

#ABCBioScience.";
        } else {
            $message = "Respected Guardian,
The student (".$student_name .",ID no. ". $student_id .")
did not participate in the last written exam on Chapter- ". $exam_chapter ." (". $exam_topic .") that was held on  " . $exam_start_date_time . ".

Please, take necessary step.

#ABCBioScience.";
        }
        return $message;
    }
}
