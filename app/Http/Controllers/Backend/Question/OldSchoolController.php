<?php

namespace App\Http\Controllers\Backend\Question;

use App\OldSchool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OldSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = OldSchool::latest()->get();
        return view('backend.oldquestions.school_questions.schools', compact('schools'));
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
            'institute' => 'required', 'unique',
            'type' => 'required',
            'status' => 'required'
        ]);

        $check = OldSchool::query()->where(['institute' => $request->institute, 'type' => $request->type])->count();
        if ($check) {
            return notify()->info('Already Created')->back();
        }

        OldSchool::create($request->all());
        notify()->success('Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(OldSchool $school)
    {
        $school->load('sessions');
        return view('backend.oldquestions.school_questions.sessions', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldSchool $school)
    {
        $request->validate([
            'institute' => 'required',
            'type' => 'required',
            'status' => 'required'
        ]);

        $school->update($request->all());
        notify()->success('School Updated Successfully!');
        return back();
    }

    public function destroy(OldSchool $school)
    {
        $school->delete();
        notify()->success('Deleted Successfully!');
        return back();
    }
}
