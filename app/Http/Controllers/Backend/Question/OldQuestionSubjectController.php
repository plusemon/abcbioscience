<?php

namespace App\Http\Controllers\Backend\Question;

use App\OldQuestionSubject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OldQuestionSubjectController extends Controller
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
        $request->validate([
            'year_id' => ['required'],
            'name' => ['required'],
        ]);

        $check = OldQuestionSubject::query()->where(['name' => $request->name, 'year_id' => $request->year_id])->count();
        if ($check) {
            notify()->warning('Already Created');
            return back();
        }

        OldQuestionSubject::create($request->all());
        notify()->success('Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OldQuestionSubject  $oldQuestionSubject
     * @return \Illuminate\Http\Response
     */
    public function show(OldQuestionSubject $board_subject)
    {
            $subject = $board_subject;
        return view('backend.oldquestions.board_questions.questions', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OldQuestionSubject  $oldQuestionSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(OldQuestionSubject $oldQuestionSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OldQuestionSubject  $oldQuestionSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldQuestionSubject $board_subject)
    {
        $request->validate([
            'name' => 'required', 'unique:old_question_subjects,name,' . $board_subject->id . ',id',
        ]);

        $board_subject->update($request->all());
        notify()->success('Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OldQuestionSubject  $oldQuestionSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldQuestionSubject $board_subject)
    {
        $board_subject->delete();
        notify()->success('Deleted Successfully!');
        return back();
    }
}
