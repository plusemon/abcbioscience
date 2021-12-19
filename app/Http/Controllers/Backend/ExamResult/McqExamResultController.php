<?php

namespace App\Http\Controllers\Backend\ExamResult;

use App\Models\Classes;
use App\Models\Student;
use App\Models\Sessiones;
use App\Model\ExamSetting;
use App\Models\BatchSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\McqExamStudentAnsSummary;

class McqExamResultController extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->class;
        $sessionId = $request->session;
        $batchId = $request->batch;
        $examId = $request->exam;

        // handle all ajax requests
        if ($request->ajax()) {
            if ($classId && $sessionId && $batchId) {

                // return exam list 
                return ExamSetting::whereStatus(1)
                    ->where('class_id', $classId)
                    ->where('session_id', $sessionId)
                    ->where('batch_setting_id', $batchId)
                    ->with('mcqQuestionSubjects')
                    ->where('fee_cat_id', 4)
                    ->get();
            } else if ($classId && $sessionId) {

                // return batch list
                return BatchSetting::whereStatus(1)
                    ->where('classes_id', $classId)
                    ->where('sessiones_id', $sessionId)
                    ->get();
            }
        }

        $data['exam'] = null;

        if ($examId) {
            $data['exam'] = ExamSetting::find($examId);

            $data['students'] = Student::with('user')
                ->where('activate_status', 1)
                ->where('batch_setting_id', $batchId) //
                ->where('class_id', $classId)
                ->where('session_id', $sessionId)
                // ->where('batch_type_id', $request->batch_type_id)
                ->get(['id', 'batch_setting_id', 'user_id'])
                ->map(function ($student) use ($examId) {
                    $result = $student->mcq_result($examId);
                    if (isset($result)) {
                        $student->resultId = $result->id;
                        $student->result = $result->final_result;
                    }
                    return $student;
                })
                ->sortBy('user.name')
                ->values();
        } else {
            $data['students'] = null;
        }


        $data['classes'] = Classes::whereStatus(1)->get();
        $data['sessions'] = Sessiones::whereStatus(1)->get();

        if ($request->has('print')) {
            return view('backend.exam.mcq.print', $data);
        } elseif ($request->has('sms')) {
            if ($request->sms == 'all_students') {
                $data['all_students'] = true;
            }
            return view('backend.exam.mcq.sms', $data);
        }

        return view('backend.exam.mcq.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, $id)
    {

        $result_id = $request->result_id;

        // return Student::find(333)->user;
        $data['exam'] = McqExamStudentAnsSummary::findOrFail($result_id);
        return view('backend.exam.mcq.result_show', $data);
    }

    public function edit(McqExamStudentAnsSummary $mcqExamStudentAnsSummary)
    {
        //
    }

    public function update(Request $request, McqExamStudentAnsSummary $mcqExamStudentAnsSummary)
    {
        //
    }

    public function destroy(Request $request,$id)
    {
        
      
        
        McqExamStudentAnsSummary::find($request->result_id)->delete();
        
    
        
        $notification = array(
            'message' => 'Student has been re-assigned to this exam!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
