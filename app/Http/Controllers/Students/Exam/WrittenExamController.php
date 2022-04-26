<?php

namespace App\Http\Controllers\Students\Exam;

use App\Models\Student;
use App\Model\ExamSetting;
use Illuminate\Http\Request;
use App\Models\WrittenExamResult;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WrittenExamController extends Controller
{


    public function index()
    {
        $batches = optional(auth()->user()->activestudents)->pluck('batch_setting_id');



        $data['exams'] = ExamSetting::whereIn('batch_setting_id', $batches)
            ->where('fee_cat_id', 5)
            ->whereDate('exam_start_date_time', '<=', today())
            ->whereDate('exam_end_date_time', '>=', today())
            ->whereIn('batch_setting_id',$batches)
            ->latest()
            ->get()->filter(function ($exam) {
                return !$exam->is_written_exam_completed();
            });

        return view('students.exam.written.index', $data);
    }

    public function create(Request $request)
    {
         $batches = optional(auth()->user()->activestudents)->pluck('batch_setting_id');

        $data['exam'] = ExamSetting::where('id', $request->exam_id)
            ->whereDate('exam_start_date_time', '<=', today())
            ->whereDate('exam_end_date_time', '>=', today())
            ->firstOrFail();

        $data['student'] = Student::where('class_id', $data['exam']->class_id)
            ->where('batch_setting_id', $data['exam']->batch_setting_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        $data['attend'] = WrittenExamResult::where('exam_setting_id', $data['exam']->id)->where('student_id', $data['student']->id)->first();

        return view('students.exam.written.show', $data);
    }

    public function store(Request $request)
    {
        // dd($request->files);

        $request->validate([
            'exam_setting_id' => 'required|integer',
            'student_id' => 'required|integer',
        ]);

        $exam = ExamSetting::findOrFail($request->exam_setting_id);
        $result = WrittenExamResult::where('exam_setting_id', $exam->id)->where('student_id',$request->student_id)->first();

        if (!$result) {
            $result = new WrittenExamResult();
            $result->student_id = $request->student_id;
            $result->batch_setting_id = $exam->batch_setting_id;
            $result->batch_type_id = $exam->batch_type_id;
            $result->class_id = $exam->class_id;
            $result->session_id = $exam->session_id;
            $result->examination_type_id = $exam->examination_type_id;
            $result->exam_setting_id = $exam->id;
            $result->subject_id = $exam->subject_id;
            $result->question_subject_id = $exam->question_subject_id;
            $result->created_by = Auth::id();
            $result->verified = $exam->verified;
            $result->status = 0;
            $result->save();
            return back();
        }

        /*if(!empty($request->upload_files)){

        $files_paths = [];
        foreach ($request->upload_files as $file) {
            $path = $this->_fileUpload($file,'written/answers');
            array_push($files_paths, $path);
        }

        $result->submission_files = $files_paths;

        }*/

        $result->submission_files = 'written_question.png';

        $result->status = 1;
        $result->save();

        $notification = array(
            'message' => 'Question Submitted Successfully!',
            'alert-type' => 'success',
        );

        $link = $exam->classes?$exam->classes->fb_link:'';

        if($link != NULL){
             return redirect($exam->classes?$exam->classes->fb_link:'')->with($notification);
        }
        else{
            return redirect()->back()->with($notification);
        }
    }

    public function show()
    {
        return 'Working on it';
    }

    public function history()
    {
        $batches = optional(auth()->user()->activestudents)->pluck('batch_setting_id');



       $data['exams'] = ExamSetting::whereIn('batch_setting_id',$batches)
            ->where('fee_cat_id', 5)
            ->whereDate('exam_end_date_time', '<=', today())
            ->get();



        return view('students.exam.written.writtenexamhistory', $data);
    }
    
    
    public function diagramhistory()
    {
        $batches = optional(auth()->user()->activestudents)->pluck('batch_setting_id');



       $data['exams'] = ExamSetting::whereIn('batch_setting_id',$batches)
            ->where('fee_cat_id', 7)
            ->whereDate('exam_end_date_time', '<=', today())
            ->get();



        return view('students.exam.diagram.history', $data);
    }
    
    
    
}
