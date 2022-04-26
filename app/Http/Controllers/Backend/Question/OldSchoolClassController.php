<?php

namespace App\Http\Controllers\Backend\Question;

use App\OldSchoolClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OldSchoolClassController extends Controller
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
            'session_id' => ['required'],
            'name' => ['required'],
            'status' => ['required'],
        ]);

        $check = OldSchoolClass::query()->where(['name' => $request->name, 'session_id' => $request->session_id])->count();
        if ($check) {
            notify()->warning('Class Already Created');
            return back();
        }

        OldSchoolClass::create($request->all());
        notify()->success('Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OldSchoolClass  $class
     * @return \Illuminate\Http\Response
     */
    public function show(OldSchoolClass $class)
    {
        $class->load('subjects');
        return view('backend.oldquestions.school_questions.subjects', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OldSchoolClass  $class
     * @return \Illuminate\Http\Response
     */
    public function edit(OldSchoolClass $class)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OldSchoolClass  $class
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldSchoolClass $class)
    {

        $request->validate([
            'name' => ['required'],
            'status' => ['required'],
        ]);

        $class->update($request->all());
        notify()->success('Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OldSchoolClass  $class
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldSchoolClass $class)
    {
        $class->delete();
        notify()->success('Deleted Successfully!');
        return back();
    }
}
