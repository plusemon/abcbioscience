<?php

namespace App\Http\Controllers\Backend\ExamQuestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\McqExamStudentAnswer;
use App\Model\McqExamStudentAnsSummary;
use App\Model\McqExamSetting;
use Auth;
use Validator;
use DB;
class McqQuestionController extends Controller
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
    public function create()
    {
        //
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
        //McqExamStudentAnswer
        //McqExamStudentAnsSummary
        //McqExamSetting
        DB::beginTransaction();
        try
        {
            /* $validator = Validator::make($request->all(), [
                'class_id'          => 'required',
                'session_id'        => 'required',
                'question_no'       => 'required|unique:mcq_question_subjects',
                'subject_id'        => 'required',
                'question.*'        => 'required',
                //'batch_setting_id'  => 'required',
                //'section_id'        => 'required',

                //'activate_status'   => $request->previous_admitted == "" ?'required':'nullable',
            ]);

            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            } */

           /*  $mcqSummary = McqExamStudentAnsSummary::whereNull('deleted_at')
                                ->where('student_id',$request->student_id)
                                ->where('batch_setting_id',$request->batch_setting_id)
                                ->where('mcq_question_subject_id',$request->mcq_question_subject_id)
                                ->where('examination_type_id',$request->examination_type_id)
                                ->where('mcq_subject_id',$request->mcq_subject_id)
                                ->first(); */
            //if($mcqSummary)
            //{
                $mcqSummary = new McqExamStudentAnsSummary();
                $mcqSummary->class_id           = $request->class_id;
                $mcqSummary->session_id         = $request->session_id;
                $mcqSummary->mcq_exam_setting_id = $request->mcq_exam_setting_id;
                $mcqSummary->status             = 1;
                $mcqSummary->save();
                $finalResult    = 0;
                foreach($request->questions as $key => $question)
                {
                    $correctId = $request->input('question_answer_'.$key);
                    $givenOptionId = NULL;
                    $subResult      = 0;
                    if(isset($_POST["question_option_".$key]))
                    {
                        $givenOptionId = $request->input("question_option_".$key);
                    }
                    if($correctId == $givenOptionId)
                    {
                        $finalResult += 1;
                        $subResult = 1;
                    }
                    
                    $data    = new McqExamStudentAnswer();
                    $data->student_id                       = $request->student_id;
                    $data->batch_setting_id                 = $request->batch_setting_id;
                    $data->mcq_exam_student_ans_summary_id  = $mcqSummary->id;
                    $data->mcq_exam_setting_id              = $request->mcq_exam_setting_id;
                    $data->mcq_subject_id                   = $request->mcq_subject_id;
                    $data->mcq_question_subject_id          = $request->mcq_question_subject_id;

                    $data->mcq_question_id                  = $question;
                    $data->given_option_id                  = $givenOptionId;
                    $data->correct_option_id                = $correctId;

                    $data->result                           = $subResult;
                    $data->save();
                }
                $mcqSummary->final_result                   = $finalResult;
                $mcqSummary->save();

                DB::commit();
                $notification = array(
                    'message' => 'Mcq Question Submitted Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.mcq.index')->with($notification);
            //}
            //$notification = array(
               // 'message' => 'Your are Not registered for this exam!',
                //'alert-type' => 'error'
            //);
            //return redirect()->route('admin.mcq.index')->with($notification);
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
            return redirect()->back()->with($notification);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
