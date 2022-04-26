<?php

namespace App\Http\Controllers\Backend\ExamResult;

use App\Http\Controllers\Controller;
use App\Models\DiagramExamResult;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Sessiones;
use App\Model\ExamSetting;
use App\Models\BatchSetting;
use Auth;

class DiagramExamResultController extends Controller
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
                    ->whereHas('diagramQuestionSubjects')
                    ->with('diagramQuestionSubjects')
                    ->where('fee_cat_id',7)
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

            $data['students'] = Student::where('activate_status',1)
                ->where('batch_setting_id', $batchId) //
                ->where('class_id', $classId)
                ->where('session_id', $sessionId)
                // ->where('batch_type_id', $request->batch_type_id)
                ->get(['id', 'batch_setting_id', 'user_id'])
                ->map(function ($student) use ($examId) {
                    $result = $student->diagram_result($examId);

                    if (isset($result)) {
                        $student->resultId = $result->id;
                        $student->result = $result->result ?? null;
                        $student->submission_files = $result->submission_files ?? null;
                    }
                    $student->name = $student->user->name;
                    return $student;
                })->sortBy('name')->values()->all();
        } else {
            $data['students'] = null;
        }



        if ($request->has('print')) {
            return view('backend.exam.diagram.print', $data);

        } 
        
        if ($request->has('sms')) {
            if ($request->sms == 'all_students') {
                $data['all_students'] = true;
            }
            return view('backend.exam.diagram.sms', $data);
        }

        $data['classes'] = Classes::whereStatus(1)->get();
        $data['sessions'] = Sessiones::whereStatus(1)->get();
        return view('backend.exam.diagram.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
       return $data['result'] = DiagramExamResult::findOrFail($id);
        return view('backend.exam.diagram.show', $data);
    }

    public function edit(WrittenExamResult $writtenExamResult)
    {
        //
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'result' => 'max:100|min:0'
        ]);

        $result = DiagramExamResult::findOrFail($id);
        $result->result = $request->result;
        $result->verified = 1;
        $result->save();

        $notification = array(
            'message' => 'Result has been set successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }






    public function diagrammarkentry(Request $request)
    {

        $input = $request->all();

        $exam = ExamSetting::find($request->exam_setting_id);
        

       foreach(array_chunk($input['student_id'],1000000) as $x){

        foreach($x as $key => $value)
        {
             
            $checkresult = DiagramExamResult::where('exam_setting_id',$request->exam_setting_id)
                                            ->where('student_id',$input['student_id'][$key])
                                            ->count();



                  
            
            if($checkresult>0)
            { 
                if(($input['result'][$key]) != null){


                    
                    $findreslt  = DiagramExamResult::where('student_id',$input['student_id'][$key])->where('exam_setting_id',$exam->id)->first();
                     
                    $data = DiagramExamResult::find($findreslt->id);
                    $data->result = $input['result'][$key];
                    $data->save();
                }
            }
            else{

                if(($input['result'][$key]) != null){

 

                    $result = new DiagramExamResult();
                    $result->student_id = $input['student_id'][$key];
                    $result->batch_setting_id = $exam->batch_setting_id;
                    $result->batch_type_id = $exam->batch_type_id;
                    $result->class_id = $exam->class_id;
                    $result->session_id = $exam->session_id;
                    $result->examination_type_id = $exam->examination_type_id;
                    $result->exam_setting_id = $exam->id;
                    $result->subject_id = $exam->subject_id;
                    $result->question_subject_id = $exam->question_subject_id;
                    $result->result = $input['result'][$key];
                    $result->submission_files = "diagram_question.png";
                    $result->created_by = Auth::id();
                    $result->verified = 1;
                    $result->status = 1;
                    $result->save();
                }

            }


        }   
    }   


        $notification = array(
            'message' => 'Result has been set successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

  


 



    public function destroy($id)
    {
        DiagramExamResult::find($id)->delete();
        $notification = array(
            'message' => 'Student has been re-assigned to this exam!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
