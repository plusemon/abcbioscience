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
use PDF;
use App\Models\WebSetting;
use App\Models\DiagramExamResult;
use App\Models\OfflineMcqExamResult;
use App\Traits\ReceivePaymentTrait;
use App\Model\PaymentHistory;

class SmsController extends Controller
{

    use ReceivePaymentTrait;

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

    
        $websetting = WebSetting::find(2);

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
                
                $name =  $student->user->name;
                
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
                    $student['message'] = "Respected guardian,

The student (".  $name .") didn’t participate
in the last MCQ exam on chapter-". optional($exam->mcqQuestionSubjects->chapter)->name." (". optional($exam->mcqQuestionSubjects)->topic .")
that was held on ". Date('d-m-Y', strtotime($exam->exam_start_date_time)) .".

Please, take necessary step. 

# ABC Bioscience.";
                }
                return $student;
            });

        foreach ($students as $student) {
            try {
                // dispatch(new MatchSendSms('01995329555', $student['message']));
              //   dispatch(new MatchSendSms('01818737845', $student['message']));
               //   dispatch(new MatchSendSms('01779325718', $student['message']));
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
        $websetting = WebSetting::find(1);
        // return $exam;
        $exam_name = optional($exam->mcqQuestionSubjects)->question_no ?? '';
        $exam_subject = optional($exam->subjects)->name ?? '';
        $exam_topic =  optional($exam->mcqQuestionSubjects)->topic  ?? '';
        $exam_total_mark = $exam->mcqQuestionSubjects->mcqQuestions->count();
        $exam_highest_mark = McqExamStudentAnsSummary::where('mcq_exam_setting_id', $exam->id)->get('final_result')->max('final_result');
        $exam_start_date_time =  date('d/m/y',strtotime($exam->exam_start_date_time));

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

#". $websetting->site_name.".";


        } else {
            $message = "Respected Guardian,
The student (".$student_name .",ID no. ". $student_id .")
didn't participate in the last MCQ exam on ". $exam_name ."
Subject :  " . $exam_subject ."
Topic :  " . $exam_topic . "
that was held on  ".$exam_start_date_time.".

Please, take necessary step.

#". $websetting->site_name.".";
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
                
                $name =  $student->user->name;
                 
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
                    
                     $student['message'] = "Respected guardian,

The student (".  $name .") didn’t participate
in the last CQ exam on chapter-". optional($exam->writtenQuestionSubjects->chapter)->name." (". optional($exam->writtenQuestionSubjects)->topic .")
that was held on ". Date('d-m-Y', strtotime($exam->exam_start_date_time)) .".

Please, take necessary step. 

# ABC Bioscience.";
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
    
    
    public function diagramAllStudentSMS(Request $request)
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
                
                $name =  $student->user->name;
                 
                $student = [
                    'id' => $student->id,
                    'user_id' => $student->user->id,
                    'student_id' => $student->user->useruid,
                    'name' => $student->user->name,
                    'mobile' => $student->user->mobile,
                    'result' => $student->diagram_result(request('exam_id'))->result ?? null,
                ];
                if (request('sms_type') == 'all') {
                    $student['message'] = $this->createDiagramMgs($student, $exam);
                } else {
                    
                     $student['message'] = "Respected guardian,

The student (".  $name .") didn’t participate
in the last CQ exam on chapter-". optional($exam->diagramQuestionSubjects->chapter)->name." (". optional($exam->diagramQuestionSubjects)->topic .")
that was held on ". Date('d-m-Y', strtotime($exam->exam_start_date_time)) .".

Please, take necessary step. 

# ABC Bioscience.";
                }
                return $student;
            });

        foreach ($students as $student) {
            try {
                // dispatch(new MatchSendSms('01995329555', $student['message'])); // emon
                // dispatch(new MatchSendSms('01779325718', $student['message'])); // taleb
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

        $websetting = WebSetting::find(1);
        // return $exam;
        $exam_name = optional($exam->writtenQuestionSubjects)->question_no ?? '';
        $exam_subject = optional($exam->subjects)->name ?? '';

        $exam_chapter = optional($exam->writtenQuestionSubjects->chapter)->name ?? '';
        $exam_topic =  optional($exam->writtenQuestionSubjects)->topic  ?? '';

        $exam_total_mark = optional($exam->writtenQuestionSubjects)->total_mark;
        $exam_highest_mark = WrittenExamResult::where('exam_setting_id', $exam->id)->get('result')->max('result');
        $exam_start_date_time =  date('d/m/y',strtotime($exam->exam_start_date_time));


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

#". $websetting->site_name.".";
        } else {
            $message = "Respected Guardian,
The student (".$student_name .",ID no. ". $student_id .")
did not participate in the last written exam on Chapter- ". $exam_chapter ." (". $exam_topic .") that was held on  " . $exam_start_date_time . ".

Please, take necessary step.

#". $websetting->site_name.".";
        }
        return $message;
    }
    
    
    public function createDiagramMgs($student, $exam)
    {

        $websetting = WebSetting::find(1);
        // return $exam;
        $exam_name = optional($exam->diagramQuestionSubjects)->question_no ?? '';
        $exam_subject = optional($exam->subjects)->name ?? '';

        $exam_chapter = optional($exam->diagramQuestionSubjects->chapter)->name ?? '';
        $exam_topic =  optional($exam->diagramQuestionSubjects)->topic  ?? '';

        $exam_total_mark = optional($exam->diagramQuestionSubjects)->total_mark;
        $exam_highest_mark = DiagramExamResult::where('exam_setting_id', $exam->id)->get('result')->max('result');
        $exam_start_date_time =  date('d/m/y',strtotime($exam->exam_start_date_time));


        $student_id = $student['student_id'];
        $student_name = $student['name'];
        $student_result = $student['result'];

        if ($student_result && $exam_total_mark) {
            $obtained_mark_percent = intval($student_result / $exam_total_mark * 100);
            $message ="Diagram exam result of the student: (" .$student_name .",ID no. " . $student_id . ")
Exam :". $exam_name ."
Subject :  " . $exam_subject ."
Topic :  " . $exam_topic . "
Total marks : ". $exam_total_mark . "
Obtained marks: ". $student_result ."
Highest marks: " . $exam_highest_mark . "

#". $websetting->site_name.".";
        } else {
            $message = "Respected Guardian,
The student (".$student_name .",ID no. ". $student_id .")
did not participate in the last diagram exam on Chapter- ". $exam_chapter ." (". $exam_topic .") that was held on  " . $exam_start_date_time . ".

Please, take necessary step.

#". $websetting->site_name.".";
        }
        return $message;
    }





     public function monthly_due_sms(Request $request)
    {
        $websetting = WebSetting::find(1);
        $input = $request->all();

        $nameofmonth = Month::find($request->month_id)->name;

        if ($request->has('sms')) {

            if (!empty($input['student_id'])) {
                foreach ($input['student_id'] as $key => $value) {
                    $studentinfo = Student::where('id',$input['student_id'][$key])->first();
                    
                    $showuser = User::find($studentinfo->user_id);
                    $data['number'] = $showuser->mobile;

                   //   for message 


                    $data['message'] = "Dear Guardian,
Your son's/daughter's: " . $studentinfo->user->name . ",ID No." . $studentinfo->user->useruid . ",(" . $studentinfo->batchsetting->batch_name . ") 'Monthly Tuition Fee' of " . $nameofmonth . " " . $studentinfo->sessiones->name . "  still remains unpaid.
Regards 
". $websetting->site_name.".";

                   
                         
                        $smsJob = new MatchSendSms($data['number'], $data['message']);
                        

                        dispatch($smsJob);

                        $smshistory = new SmsHistroy();
                        $smshistory->user_id = $studentinfo->user_id;
                        $smshistory->student_id = $studentinfo->id;
                        $smshistory->message = $data['message'];
                        $smshistory->status = 1;
                        $smshistory->save(); 
                     
                }

                $notification = array(
                    'message' => 'SMS Send Successfully Completed!',
                    'alert-type' => 'success',
                );

                return redirect()->back()->with($notification);
            } else {
                $notification = array(
                    'message' => 'Please Select Student!',
                    'alert-type' => 'error',
                );
                return redirect()->back()->with($notification);
            }
        } elseif ($request->has('pdf')) {

            $data['class_id'] = $request->class_id;
            $data['session_id'] = $request->session_id;
            $data['batch_setting_id'] = $request->batch_setting_id;
            $data['batch_type_id'] = $request->batch_type_id;
            $data['fee_cat_id'] = $request->fee_cat_id;
            $data['month_id'] = $request->month_id;

            $class_id = $request->class_id;
            $session_id = $request->session_id;
            $batch_setting_id = $request->batch_setting_id;
            $fee_cat_id = $request->fee_cat_id;
            $batch_type_id = $request->batch_type_id;
            $month_id = $request->month_id;

            $data['month'] = Month::findOrfail($month_id);
            $data['class'] = Classes::findOrfail($class_id);
            $data['session'] = Sessiones::findOrfail($session_id);
            $data['batch'] = BatchSetting::findOrfail($batch_setting_id);

            $data['students'] = Student::where('activate_status', 1)
                ->where('class_id', $class_id)
                ->where('session_id', $session_id)
                ->where('batch_setting_id', $batch_setting_id)
                ->where('batch_type_id', $batch_type_id)
                ->whereNull('deleted_at')
                ->where(function ($query) use ($month_id) {
                    $query->where('start_month_id', '<=', $month_id);
                    //$query->where('end_month_id', '<=', $month_id);
                })
                ->get()
                ->sortBy('user.name')
                ->values();

            $pdf = PDF::loadView('backend.fee_management.due_list.month_due_pdf', $data);
            
            $filename =  $data['batch']->batch_name."_".$data['month']->name."_monthly due list.pdf";
            
            return $pdf->download($filename);
        }
        elseif($request->has('invoice'))
        {
            
          
   
             if (!empty($input['student_id'])) {
                foreach ($input['student_id'] as $key => $value) {
                    
                    
                     
                    
                $studentinfo = Student::where('id',$input['student_id'][$key])->first();
                    
                    $showuser = User::find($studentinfo->user_id);
                    $data['number'] = $showuser->mobile;
                    
                    
              $checkInvoice = PaymentHistory::where('student_id',$studentinfo->id)
                                                    ->where('origin_id',$request->month_id)
                                                    ->where('class_id',$studentinfo->class_id)
                                                    ->where('session_id',$studentinfo->session_id)
                                                    ->whereIn('status',[1,2,3])
                                                    ->count();
                    if($checkInvoice>0){
                        // dd('user has no due, it will skip in foreach the key of: '. $key);
                    }
                    else{
                    // for payment invoice 
                    
                    // check the values
                    //  dd($input['student_id'],$key,$studentinfo->id,$value);
                     
                     // working... it will return the amount where student has no invoice
                  //   dd($input['amount'][$studentinfo->id]);
        
                        $this->invoice_no           = NULL;
                        $this->reference_no         = 'MF'.date('Y').'P';
                        $this->amount               = $input['amount'][$studentinfo->id];
                        $this->student_id           = $studentinfo->id;
                        $this->fee_cat_id           = $request->fee_cat_id;
                        $this->user_id              = $studentinfo->user_id;
                        $this->class_id             = $studentinfo->class_id;
                        $this->session_id           = $studentinfo->session_id;
                        $this->batch_setting_id     = $studentinfo->batch_setting_id;
                        $this->batch_type_id        = $studentinfo->batch_type_id;
                        $this->fee_amount_setting_id= $request->fee_amount_setting_id[$key];
                        $this->student_waiver_id    =  NULL;
                        $this->origin_id            = $request->month_id;
                        $this->payment_method_id    = NULL;
                        $this->transaction_id       = NULL;
                        $this->account_id           = NULL;
                        $this->status               = 2;
                        $this->created_at           = date('Y-m-d h:i:s');
                        $this->DuePayment();
                        
                    }
                    
                    
            
                
        
                }
            }
        }
        
        
        $notification = array(
            'message' => 'Invoice Create Successfully Completed!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);




    }



    
    
    public function offlinemcqAllStudentSMS(Request $request)
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
                
                $name =  $student->user->name;
                 
                $student = [
                    'id' => $student->id,
                    'user_id' => $student->user->id,
                    'student_id' => $student->user->useruid,
                    'name' => $student->user->name,
                    'mobile' => $student->user->mobile,
                    'result' => $student->offlinemcq_result(request('exam_id'))->result ?? null,
                ];
                if (request('sms_type') == 'all') {
                    $student['message'] = $this->createOfflineMcqMgs($student, $exam);
                } else {
                    
                     $student['message'] = "Respected guardian,

The student (".  $name .") didn’t participate
in the last MCQ exam on chapter-". optional($exam->OfflineMcqQuestionSubjects->chapter)->name." (". optional($exam->OfflineMcqQuestionSubjects)->topic .")
that was held on ". Date('d-m-Y', strtotime($exam->exam_start_date_time)) .".

Please, take necessary step. 

# ABC Bioscience.";
                }
                return $student;
            });

        foreach ($students as $student) {
            try {
                // dispatch(new MatchSendSms('01995329555', $student['message'])); // emon
                // dispatch(new MatchSendSms('01779325718', $student['message'])); // taleb
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


     public function createOfflineMcqMgs($student, $exam)
    {

        $websetting = WebSetting::find(1);
        // return $exam;
        $exam_name = optional($exam->OfflineMcqQuestionSubjects)->question_no ?? '';
        $exam_subject = optional($exam->subjects)->name ?? '';

        $exam_chapter = optional($exam->OfflineMcqQuestionSubjects->chapter)->name ?? '';
        $exam_topic =  optional($exam->OfflineMcqQuestionSubjects)->topic  ?? '';

        $exam_total_mark = optional($exam->OfflineMcqQuestionSubjects)->total_mark;
        $exam_highest_mark = OfflineMcqExamResult::where('exam_setting_id', $exam->id)->get('result')->max('result');
        $exam_start_date_time =  date('d/m/y',strtotime($exam->exam_start_date_time));


        $student_id = $student['student_id'];
        $student_name = $student['name'];
        $student_result = $student['result'];

        if ($student_result && $exam_total_mark) {
            $obtained_mark_percent = intval($student_result / $exam_total_mark * 100);
            $message ="MCQ Result of the student: (" .$student_name .",ID no. " . $student_id . ")
Exam :". $exam_name ."
Subject :  " . $exam_subject ."
Topic :  " . $exam_topic . "
Total marks : ". $exam_total_mark . "
Obtained marks: ". $student_result ."
Highest marks: " . $exam_highest_mark . "

#". $websetting->site_name.".";
        } else {
            $message = "Respected Guardian,
The student (".$student_name .",ID no. ". $student_id .")
did not participate in the last mcq exam on Chapter- ". $exam_chapter ." (". $exam_topic .") that was held on  " . $exam_start_date_time . ".

Please, take necessary step.

#". $websetting->site_name.".";
        }
        return $message;
    }
    







}
