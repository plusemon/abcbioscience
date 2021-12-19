<?php

namespace App\Http\Controllers\Backend\Question;

use App\OldSchoolSubject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OldSchoolSubjectController extends Controller
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
            'class_id' => ['required'],
            'name' => ['required'],
            'status' => ['required'],
        ]);

        $check = OldSchoolSubject::query()->where(['class_id' => $request->class_id, 'name' => $request->name])->count();
        if ($check) {
            notify()->warning('Session Already Created');
            return back();
        }

        OldSchoolSubject::create($request->all());
        notify()->success('Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OldSchoolSubject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(OldSchoolSubject $subject)
    {
        $subject->load('questions');
        return view('backend.oldquestions.school_questions.questions', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OldSchoolSubject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(OldSchoolSubject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OldSchoolSubject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldSchoolSubject $subject)
    {

        $request->validate([
            'name' => ['required'],
            'status' => ['required'],
        ]);

        $subject->update($request->all());
        notify()->success('Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OldSchoolSubject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldSchoolSubject $subject)
    {
        $subject->delete();
        notify()->success('Deleted Successfully!');
        return back();
    }
}
