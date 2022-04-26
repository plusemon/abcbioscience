<?php

namespace App\Http\Controllers\Backend\Question;

use App\Http\Controllers\Controller;
use App\Models\OldSubject;
use Illuminate\Http\Request;

class OldSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subjects = OldSubject::latest()->get();
        return view('backend.oldquestions.oldsubjects.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('backend.oldquestions.oldsubjects.create');
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
            'name' => 'required',
            'status' => 'required'
        ]);

        $subjects = new OldSubject();
        $subjects->name = $request->name;
        $subjects->status = $request->status;
        $subjects->save();

        $notification = array(
            'message' => 'Subject Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('old.subject.index')->with($notification);

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
        $data['subject'] = OldSubject::find($id);
        return view('backend.oldquestions.oldsubjects.edit',$data);
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
            'name' => 'required',
            'status' => 'required',
        ]);

        $subjects = OldSubject::find($id);
        $subjects->name = $request->name;
        $subjects->status = $request->status;
        $subjects->save();

        $notification = array(
            'message' => 'Subject update Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('old.subject.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $subject =  OldSubject::find($id)->delete();

        $notification = array(
            'message' => 'Subject Delete Successfully!',
            'alert-type' => 'danger'
        );

        return redirect()->route('old.subject.index')->with($notification);
    }
}
