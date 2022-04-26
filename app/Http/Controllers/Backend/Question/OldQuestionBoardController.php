<?php

namespace App\Http\Controllers\Backend\Question;

use App\OldQuestionBoard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OldQuestionBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = OldQuestionBoard::all();
        return view('backend.oldquestions.board_questions.boards', compact('boards'));
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
            'name' => 'required', 'unique',
        ]);

        OldQuestionBoard::create($request->all());
        notify()->success('Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OldQuestionBoard  $oldQuestionBoard
     * @return \Illuminate\Http\Response
     */
    public function show(OldQuestionBoard $board)
    {
        return view('backend.oldquestions.board_questions.years', compact('board'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OldQuestionBoard  $oldQuestionBoard
     * @return \Illuminate\Http\Response
     */
    public function edit(OldQuestionBoard $oldQuestionBoard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OldQuestionBoard  $oldQuestionBoard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldQuestionBoard $board)
    {
        $request->validate([
            'name' => 'required', 'unique:old_question_boards,name,'.$board->id.',id',
        ]);

        $board->update($request->all());
        notify()->success('Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OldQuestionBoard  $oldQuestionBoard
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldQuestionBoard $board)
    {
        $board->delete();
        notify()->success('Deleted Successfully!');
        return back();
    }
}
