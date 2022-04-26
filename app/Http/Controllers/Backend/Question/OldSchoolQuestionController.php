<?php

namespace App\Http\Controllers\Backend\Question;

use App\OldSchoolQuestion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class OldSchoolQuestionController extends Controller
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

        $question = OldSchoolQuestion::create($request->except('content'));

        if ($request->hasFile('content')) {
            $file = $request->file('content');
            $file_name = Str::lower((uniqid($request->name) . '.' . $file->getClientOriginalExtension()));
            $file_path = $file->move('public/media/images/old_questions', $file_name);
            $question->update([
                'content' => $file_path,
            ]);
        }

        notify()->success('Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OldSchoolQuestion  $question
     * @return \Illuminate\Http\Response
     */
    public function show(OldSchoolQuestion $question)
    {
        // return  $question;
        return  response()->download($question->content);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OldSchoolQuestion  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(OldSchoolQuestion $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OldSchoolQuestion  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldSchoolQuestion $question)
    {
        $request->validate([
            'name' => ['required'],
            'content' => ['required', 'file'],
            'status' => ['required'],
        ]);

        $question->update($request->except('content'));

        if ($request->hasFile('content')) {

            // first delete existing one 
            if ($question->content && File::exists($question->content)) {
                File::delete($question->content);
            }

            // then save the new one 
            $file = $request->file('content');
            $file_name = Str::lower((uniqid($request->name) . '.' . $file->getClientOriginalExtension()));
            $file_path = $file->move('public/media/images/old_questions', $file_name);
            $question->update([
                'content' => $file_path,
            ]);
        }

        notify()->success('Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OldSchoolQuestion  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldSchoolQuestion $question)
    {

        if ($question->content && File::exists($question->content)) {
            File::delete($question->content);
        }
        $question->delete();
        notify()->success('Deleted Successfully!');
        return back();
    }
}
