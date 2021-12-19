<?php

namespace App\Http\Controllers\Backend\Question;

use App\OldQuestionYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OldQuestionYearController extends Controller
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
            'board_id' => ['required'],
            'year' => ['required', 'integer'],
        ]);

        $check = OldQuestionYear::query()->where(['year' => $request->year, 'board_id' => $request->board_id])->count();
        if ($check) {
            notify()->warning('Already Created');
            return back();
        }

        OldQuestionYear::create($request->all());
        notify()->success('Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OldQuestionYear  $oldQuestionYear
     * @return \Illuminate\Http\Response
     */
    public function show(OldQuestionYear $year)
    {
        return view('backend.oldquestions.board_questions.subjects', compact('year'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OldQuestionYear  $oldQuestionYear
     * @return \Illuminate\Http\Response
     */
    public function edit(OldQuestionYear $oldQuestionYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OldQuestionYear  $oldQuestionYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldQuestionYear $year)
    {
        $request->validate([
            'year' => 'required', 'unique:old_question_boards,year,' . $year->id . ',id',
        ]);

        $year->update($request->all());
        notify()->success('Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OldQuestionYear  $oldQuestionYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldQuestionYear $year)
    {
        $year->delete();
        notify()->success('Deleted Successfully!');
        return back();
    }
}
