<?php

namespace App\Http\Controllers\Students\Exam;

use App\Models\Student;
use App\Model\ExamSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\McqExamStudentAnswer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\McqExamStudentAnsSummary;

class McqExamController extends Controller
{
    public function index()
    {
        $batches = optional(auth()->user()->activestudents)->pluck('batch_setting_id');

        $data['exams'] = ExamSetting::whereIn('batch_setting_id', $batches)
            ->where('fee_cat_id', 4)
            ->whereDate('exam_start_date_time', '<=', today())
            ->whereDate('exam_end_date_time', '>=', today())
            ->get();

        return view('students.exam.mcq.index', $data);
    }



    public function indexajax()
    {
        $batches = optional(auth()->user()->activestudents)->pluck('batch_setting_id');

        $data['exams'] = ExamSetting::whereIn('batch_setting_id', $batches)
            ->where('fee_cat_id', 4)
            ->whereDate('exam_start_date_time', '<=', today())
            ->whereDate('exam_end_date_time', '>=', today())
            ->get();

        return view('students.exam.mcq.ajaxindex', $data);
    }




 





    public function create(Request $request)
    {
        $data['exam'] = ExamSetting::where('id', $request->exam_id)
            ->whereDate('exam_start_date_time', '<=', today())
            ->whereDate('exam_end_date_time', '>=', today())
            ->firstOrFail();


        $data['findstudentid'] = Student::where('class_id', $data['exam']->class_id)
            ->where('batch_setting_id', $data['exam']->batch_setting_id)
            ->where('user_id', Auth::user()->id)
            ->first();


        $data['attend'] = McqExamStudentAnsSummary::where('mcq_exam_setting_id', $data['exam']->id)
            ->where('student_id', $data['findstudentid']->id)
            ->first();

        return view('students.exam.mcq.show', $data);
    }

    public function store(Request $request)
    {
        if ($request->has('admit')) {
            $mcqSummary = new McqExamStudentAnsSummary();
            $mcqSummary->student_id = $request->student_id;
            $mcqSummary->batch_setting_id = $request->batch_setting_id;
            $mcqSummary->batch_type_id = $request->batch_type_id;
            $mcqSummary->class_id = $request->class_id;
            $mcqSummary->session_id = $request->session_id;
            $mcqSummary->mcq_question_subject_id = $request->mcq_question_subject_id;
            $mcqSummary->examination_type_id = $request->examination_type_id;
            $mcqSummary->mcq_exam_setting_id = $request->mcq_exam_setting_id;
            $mcqSummary->mcq_subject_id = $request->subject_id;
            $mcqSummary->created_by = auth()->id();
            $mcqSummary->save();
            return back();
        }

        //check if exam completed
       $mcqSummary = McqExamStudentAnsSummary::findOrFail($request->attend_id);

        if ($mcqSummary && $mcqSummary->verified) {
            $notification = array(
                'message' => 'Exam Submitted Successfully!',
                'alert-type' => 'success',
            );

            return redirect(route('student.exam.mcq.show', $mcqSummary->id))->with($notification);
        }

        DB::transaction(function () use ($request, $mcqSummary) {

            $mcqSummary->status = 1;
            $mcqSummary->verified = 1;
            $mcqSummary->save();

            $finalResult = 0;

            foreach ($request->questions as $key => $question) {
                $correctId = $request->input('question_answer_' . $key);
                $givenOptionId = null;
                $subResult = 0;

                if (isset($_POST["question_option_" . $key])) {
                    $givenOptionId = $request->input("question_option_" . $key);
                }
                if ($correctId == $givenOptionId) {
                    $finalResult += 1;
                    $subResult = 1;
                }

                $data = new McqExamStudentAnswer();
                $data->student_id  = $request->student_id;
                $data->batch_setting_id = $request->batch_setting_id;
                $data->batch_type_id = $request->batch_type_id;
                $data->mcq_exam_student_ans_summary_id = $mcqSummary->id;
                $data->mcq_exam_setting_id = $request->mcq_exam_setting_id;
                $data->mcq_subject_id = $request->subject_id;
                $data->mcq_question_subject_id = $request->mcq_question_subject_id;

                $data->mcq_question_id = $question;
                $data->given_option_id = $givenOptionId;
                $data->correct_option_id = $correctId;

                $data->result = $subResult;
                $data->save();
            }
            $mcqSummary->final_result = $finalResult;
            $mcqSummary->save();
        });

        $notification = array(
            'message' => 'Exam Submitted Successfully!',
            'alert-type' => 'success',
        );

        return redirect(route('student.exam.mcq.show', $mcqSummary->id))->with($notification);
    }

    public function show($id)
    {
        $data['answer'] = McqExamStudentAnsSummary::findOrFail($id);
        return view('students.exam.mcqexamhistory.show', $data);
    }

    public function history()
    {

        $batches = optional(auth()->user()->activestudents)->pluck('batch_setting_id');
        $ids     = optional(auth()->user()->activestudents)->pluck('id');

        $data['answers'] = McqExamStudentAnsSummary::whereIn('batch_setting_id', $batches)
            ->whereIn('student_id',$ids)
            ->latest()
            ->get();

        return view('students.exam.mcqexamhistory.index', $data);
    }
}
