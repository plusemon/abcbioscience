<?php

namespace App\Http\Controllers\Backend\Question;

use App\OldBoardQuestion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class OldBoardQuestionController extends Controller
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
            'subject_id' => ['required'],
            'name' => ['required'],
            'content' => ['required', 'file'],
        ]);

        $board_question = OldBoardQuestion::create($request->except('content'));

        if ($request->hasFile('content')) {
            $file = $request->file('content');
            $file_name = Str::lower((uniqid($request->name) . '.' . $file->getClientOriginalExtension()));
            $file_path = $file->move('public/media/images/old_questions', $file_name);
            $board_question->update([
                'content' => $file_path,
            ]);
        }

        notify()->success('Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OldBoardQuestion  $board_question
     * @return \Illuminate\Http\Response
     */
    public function show(OldBoardQuestion $board_question)
    {
        return  response()->download($board_question->content);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OldBoardQuestion  $board_question
     * @return \Illuminate\Http\Response
     */
    public function edit(OldBoardQuestion $board_question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OldBoardQuestion  $board_question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldBoardQuestion $board_question)
    {
        $request->validate([
            'name' => ['required'],
            'content' => ['required', 'file'],
            'status' => ['required'],
        ]);

        $board_question->update($request->except('content'));

        if ($request->hasFile('content')) {

            // first delete existing one 
            if ($board_question->content && File::exists($board_question->content)) {
                File::delete($board_question->content);
            }

            // then save the new one 
            $file = $request->file('content');
            $file_name = Str::lower((uniqid($request->name) . '.' . $file->getClientOriginalExtension()));
            $file_path = $file->move('public/media/images/old_questions', $file_name);
            $board_question->update([
                'content' => $file_path,
            ]);
        }

        notify()->success('Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OldBoardQuestion  $board_question
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldBoardQuestion $board_question)
    {
        $board_question->delete();
        notify()->success('Deleted Successfully!');
        return back();
    }
}
