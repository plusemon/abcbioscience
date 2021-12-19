<?php

namespace App\Http\Controllers\Backend\Question;

use App\Http\Controllers\Controller;
use App\Models\BoardQuestionType;
use App\Models\Classes;
use App\Models\ExamType;
use App\Models\OldQuestion;
use App\Models\QuestionType;
use App\Models\BoardName;
use App\Models\Subject;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OldQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 

    /*  school Question */
    public function index()
    {
        $old_quss = OldQuestion::latest()->where('question_type_id',1)->get();
        return view('backend.questions.questions.index',compact('old_quss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['question_types'] = QuestionType::all();
        $data['years'] = Year::all();
        $data['exams'] = ExamType::all();
        $data['board_questions'] = BoardQuestionType::all();
        $data['classs'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('backend.questions.questions.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'schoolname' => 'required',
            'questionfile' => 'required',

        ]);

		$old_question = new OldQuestion();
        $old_question->question_type_id = 1;
        $old_question->schoolname = $request->schoolname;
        $old_question->year_id = $request->year_id;
        $old_question->class_id = $request->class_id;
        $old_question->exam_type_id = $request->exam_type_id;
        $old_question->subject_id = $request->subject_id;
        $old_question->board_question_type_id = $request->board_question_type_id;

        $questionfile = $request->questionfile;
        if($questionfile){
            //  @unlink($blogs->image);
            $uniqname = uniqid();
            $ext = strtolower($questionfile->getClientOriginalExtension());
            $filepath = 'public/images/old_question/';
            $filename = $filepath.$uniqname.'.'.$ext;
            $questionfile->move($filepath,$filename);
            $old_question->questionfile = $filename;
        }

        $old_question->status = $request->status;
        $old_question->user_id = Auth::user()->id;
        $old_question->save();

        $notification = array(
            'message' => 'Old Question Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('old_question.index')->with($notification);

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

        $data['old_qus'] = OldQuestion::find($id);
        $data['question_types'] = QuestionType::all();
        $data['years'] = Year::all();
        $data['exams'] = ExamType::all();
        $data['board_questions'] = BoardQuestionType::all();
        $data['classs'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('backend.questions.questions.edit',$data);
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

        $request->validate([
            'schoolname' => 'required',

        ]);

        $old_question = OldQuestion::find($id);

        $old_question->schoolname = $request->schoolname;
        $old_question->year_id = $request->year_id;
        $old_question->class_id = $request->class_id;
        $old_question->exam_type_id = $request->exam_type_id;
        $old_question->subject_id = $request->subject_id;
        $old_question->board_question_type_id = $request->board_question_type_id;

        $questionfile = $request->questionfile;
        if($questionfile){
            @unlink($old_question->questionfile);
            $uniqname = uniqid();
            $ext = strtolower($questionfile->getClientOriginalExtension());
            $filepath = 'public/images/old_question/';
            $filename = $filepath.$uniqname.'.'.$ext;
            $questionfile->move($filepath,$filename);
            $old_question->questionfile = $filename;
        }

        $old_question->status = $request->status;
        $old_question->user_id = Auth::user()->id;
        $old_question->save();

        $notification = array(
            'message' => 'Old Question update Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('old_question.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old_qus =  OldQuestion::find($id)->delete();

        $notification = array(
            'message' => 'Old Question Delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('old_question.index')->with($notification);
    }




    /* =======================================================       College  Question ========================================================================================================== */


    
    
    


     public function collegeindex()
    {
        $old_quss = OldQuestion::latest()->where('question_type_id',3)->get();
        return view('backend.questions.questions.college.index',compact('old_quss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function collegecreate()
    {
        $data['question_types'] = QuestionType::all();
        $data['years'] = Year::all();
        $data['exams'] = ExamType::all();
        $data['board_questions'] = BoardQuestionType::all();
        $data['classs'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('backend.questions.questions.college.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function collegestore(Request $request)
    {
        $request->validate([
            'schoolname' => 'required',
            'questionfile' => 'required',

        ]);

		$old_question = new OldQuestion();
        $old_question->question_type_id = 3;
        $old_question->schoolname = $request->schoolname;
        $old_question->year_id = $request->year_id;
        $old_question->class_id = $request->class_id;
        $old_question->exam_type_id = $request->exam_type_id;
        $old_question->subject_id = $request->subject_id;
        $old_question->board_question_type_id = $request->board_question_type_id;

        $questionfile = $request->questionfile;
        if($questionfile){
            //  @unlink($blogs->image);
            $uniqname = uniqid();
            $ext = strtolower($questionfile->getClientOriginalExtension());
            $filepath = 'public/images/old_question/';
            $filename = $filepath.$uniqname.'.'.$ext;
            $questionfile->move($filepath,$filename);
            $old_question->questionfile = $filename;
        }

        $old_question->status = $request->status;
        $old_question->user_id = Auth::user()->id;
        $old_question->save();

        $notification = array(
            'message' => 'Old Question Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('old_question.college.index')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function collegeshow($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function collegeedit($id)
    {

        $data['old_qus'] = OldQuestion::find($id);
        $data['question_types'] = QuestionType::all();
        $data['years'] = Year::all();
        $data['exams'] = ExamType::all();
        $data['board_questions'] = BoardQuestionType::all();
        $data['classs'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('backend.questions.questions.college.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function collegeupdate(Request $request, $id)
    {

        $request->validate([
            'schoolname' => 'required',

        ]);

        $old_question = OldQuestion::find($id);

        $old_question->schoolname   = $request->schoolname;
        $old_question->year_id      = $request->year_id;
        $old_question->class_id     = $request->class_id;
        $old_question->exam_type_id = $request->exam_type_id;
        $old_question->subject_id   = $request->subject_id;
        $old_question->board_question_type_id = $request->board_question_type_id;

        $questionfile = $request->questionfile;
        if($questionfile){
            @unlink($old_question->questionfile);
            $uniqname = uniqid();
            $ext = strtolower($questionfile->getClientOriginalExtension());
            $filepath = 'public/images/old_question/';
            $filename = $filepath.$uniqname.'.'.$ext;
            $questionfile->move($filepath,$filename);
            $old_question->questionfile = $filename;
        }

        $old_question->status   = $request->status;
        $old_question->user_id  = Auth::user()->id;
        $old_question->save();

        $notification = array(
            'message' => 'Old Question update Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('old_question.college.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function collegedestroy($id)
    {
        $old_qus =  OldQuestion::find($id)->delete();

        $notification = array(
            'message' => 'Old Question Delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('old_question.college.index')->with($notification);
    }






















    /* =======================================================       Board Question ============================================================================================================= */

    public function boardquestionindex()
    {
        $data['boardquestiones'] = OldQuestion::where('question_type_id',2)->latest()->get();
        return view('backend.questions.questions.boardquestions',$data);
    }



    public function boardquestioncreate()
    {
        $data['years'] = Year::all();
        $data['board_questions'] = BoardQuestionType::all();
        
        $data['boardnames'] = BoardName::all();

        return view('backend.questions.questions.boardquestionadd',$data);
    }




    public function boardquestionstore(Request $request)
    {
        $request->validate([
            'board_question_type_id' => 'required',
            'year_id' => 'required',
            'questionfile' => 'required',

        ]);

        $old_question = new OldQuestion();

        $old_question->question_type_id = 2;
        $old_question->year_id = $request->year_id;
        $old_question->subject_id = $request->subject_id;
        $old_question->board_name_id = $request->board_name_id;
        $old_question->board_question_type_id = $request->board_question_type_id;


        $questionfile = $request->questionfile;

        if($questionfile){

            $uniqname = uniqid();
            $ext = strtolower($questionfile->getClientOriginalExtension());
            $filepath = 'public/images/old_question/';
            $filename = $filepath.$uniqname.'.'.$ext;
            $questionfile->move($filepath,$filename);
            $old_question->questionfile = $filename;
        }

        $old_question->status = $request->status;
        $old_question->user_id = Auth::user()->id;
        $old_question->save();

        $notification = array(
            'message' => 'Board Question Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('boardquestion.index')->with($notification);

    }



       public function boardquestionedit($id)
    {

        $data['old_qus'] = OldQuestion::find($id);
        $data['years'] = Year::all();
        $data['board_questions'] = BoardQuestionType::all();
        $data['boardnames'] = BoardName::all();
        
        return view('backend.questions.questions.boardquestionedit',$data);
    }




     public function boardquestionupdate(Request $request,$id)
    {
        $request->validate([
            'board_question_type_id' => 'required',
            'year_id' => 'required',

        ]);

        $old_question = OldQuestion::find($id);

        $old_question->question_type_id = 2;
        $old_question->year_id = $request->year_id;
        $old_question->subject_id = $request->subject_id;
        $old_question->board_name_id = $request->board_name_id;
        $old_question->board_question_type_id = $request->board_question_type_id;
        


        $questionfile = $request->questionfile;

        if($questionfile){
            @unlink($old_question->questionfile);
            $uniqname = uniqid();
            $ext = strtolower($questionfile->getClientOriginalExtension());
            $filepath = 'public/images/old_question/';
            $filename = $filepath.$uniqname.'.'.$ext;
            $questionfile->move($filepath,$filename);
            $old_question->questionfile = $filename;
        }

        $old_question->status = $request->status;
        $old_question->user_id = Auth::user()->id;
        $old_question->save();

        $notification = array(
            'message' => 'Board Question Update Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('boardquestion.index')->with($notification);

    }









     public function boardquestiondestroy($id)
    {
        $old_qus =  OldQuestion::find($id)->delete();

        $notification = array(
            'message' => 'Board Question Delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('boardquestion.index')->with($notification);
    }










}
