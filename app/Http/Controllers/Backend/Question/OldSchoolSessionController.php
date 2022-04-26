<?php

namespace App\Http\Controllers\Backend\Question;

use App\OldSchoolSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OldSchoolSessionController extends Controller
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
        // return $request;
        $request->validate([
            'school_id' => ['required'],
            'year' => ['required'],
            'status' => ['required']
        ]);

        $check = OldSchoolSession::query()->where(['year' => $request->year, 'school_id' => $request->school_id])->count();
        if ($check) {
            notify()->warning('Session Already Created');
            return back();
        }

        OldSchoolSession::create($request->all());
        notify()->success('Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OldSchoolSession  $session
     * @return \Illuminate\Http\Response
     */
    public function show(OldSchoolSession $session)
    {
        // return $session;
        return view('backend.oldquestions.school_questions.classes', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OldSchoolSession  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(OldSchoolSession $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OldSchoolSession  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldSchoolSession $session)
    {
        // return $request;
        $request->validate([
            'year' => ['required'],
            'status' => ['required']
        ]);
        
        $session->update($request->all());
        notify()->success('Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OldSchoolSession  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldSchoolSession $session)
    {
        $session->delete();
        notify()->success('Session Created Successfully');
        return  back();
    }
}
