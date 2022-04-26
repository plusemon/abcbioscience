<?php

namespace App\Http\Controllers\Backend\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WrittenQuestion;
use App\Models\Subject;
use App\Models\Sessiones;
use App\Models\Chapter;
use App\Models\Classes;
use App\Models\ExamType;
use App\Model\ExamSetting;
use App\Model\FeeAmountSetting;
use App\Model\StudentQuestionSetting;
use App\Models\WrittenExamResult;
use Validator;
use App\Model\ResultGroup;

class WrittenQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 

        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
   
        $data['subjects']       = Subject::all();

         $query  = WrittenQuestion::query();

        if($request->class_id)
        {
            $data['class_id']   = $request->class_id;
            $query = $query->where('class_id',$request->class_id);
        }  

        if($request->session_id)
        {
             $data['session_id'] = $request->session_id;
            $query = $query->where('session_id',$request->session_id);
        }  

        if($request->subject_id)
        {
             $data['subject_id'] = $request->subject_id;
            $query = $query->where('subject_id',$request->subject_id);
        }  

  

        $data['writtenquestiones'] = $query->latest()->whereNull('deleted_at')->paginate(100);
        return view('backend.questions.writtenquestions.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
        $data['subjectes']      = Subject::latest()->get();
        $data['examTypies']     = ExamType::all();
        return view('backend.questions.writtenquestions.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_no'   => 'required|min:2|max:255',
            'subject_id'    => 'required',
            'class_id'      => 'required',
            'session_id'    => 'required',
            'examination_type_id' => 'required',
            'attachment'     => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $insetwrittenquestion = New WrittenQuestion();

        $attachmentFile = $request->attachment;
        $input = $request->except('_token') ;//$request->all();
        if($attachmentFile){
            $uniqname = uniqid();
            $ext = strtolower($attachmentFile->getClientOriginalExtension());
            $filepath = 'public/uploads/questions/';
            $imagename = $filepath.$uniqname.'.'.$ext;
            $attachmentFile->move($filepath,$imagename);
            $input['attachment'] = $imagename;
        }
        $input['status'] = 1;
        $insetwrittenquestion->fill($input)->save();
        $notification = array(
            'message' => 'Question Create Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('written.question.index')->with($notification);
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
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
        $data['subjectes']      = Subject::latest()->get();
        $data['examTypies']     = ExamType::all();
        $data['question']       = WrittenQuestion::find($id);

        return view('backend.questions.writtenquestions.edit',$data);
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
        $validator = Validator::make($request->all(), [
            'question_no'   => 'required|min:2|max:255',
            'subject_id'    => 'required',
            'class_id'      => 'required',
            'session_id'    => 'required',
            'examination_type_id' => 'required',
            //'attachment'     => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $updateWrittenquestion = WrittenQuestion::find($id);

        $attachmentFile = $request->attachment;
        $input = $request->except('_token') ;//$request->all();
        if($attachmentFile){
            $uniqname = uniqid();
            $ext = strtolower($attachmentFile->getClientOriginalExtension());
            $filepath = 'public/uploads/questions/';
            $imagename = $filepath.$uniqname.'.'.$ext;
            $attachmentFile->move($filepath,$imagename);
            $input['attachment'] = $imagename;
        }
        $input['status'] = 1;
        $updateWrittenquestion->fill($input)->save();
        $notification = array(
            'message' => 'Question Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('written.question.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    
    public function destroy($id)
    {
        $findwritten = WrittenQuestion::find($id);

        $findexamsettingcount   = ExamSetting::where('question_subject_id', $id)->where('fee_cat_id',5)->count();

        if ($findexamsettingcount > 0) {
            $findexamsetting    = ExamSetting::where('question_subject_id', $id)->where('fee_cat_id', 5)->first();

            $feeamountcount     = FeeAmountSetting::where('fee_cat_id', 5)->where('origin_id', $findexamsetting->id)->count();

            if ($feeamountcount > 0) {
                FeeAmountSetting::where('fee_cat_id', 5)->where('origin_id', $findexamsetting->id)->delete();
            }

            WrittenExamResult::where('exam_setting_id',$findexamsetting->id)->delete();

            $findstudentcqsetting = StudentQuestionSetting::where('exam_setting_id', $findexamsetting->id)->where('fee_cat_id', 5)->count();

            if ($findstudentcqsetting > 0) {
                StudentQuestionSetting::where('exam_setting_id', $findexamsetting->id)->where('fee_cat_id', 5)->delete();
            }

            ResultGroup::where('written_exam_setting_id',$findexamsetting->id)->delete();
            
            $findexamsetting->delete();
        }


        $findwritten->delete();

        $notification = array(
                'message' => 'Question Delete Successfully!',
                'alert-type' => 'success'
        );
        return redirect()->route('written.question.index')->with($notification);

    }
}
