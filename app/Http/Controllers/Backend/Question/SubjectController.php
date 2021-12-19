<?php

namespace App\Http\Controllers\Backend\Question;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subjects = Subject::latest()->get();
        return view('backend.questions.subjects.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('backend.questions.subjects.create');
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

        $subjects = new Subject();
        $subjects->name = $request->name;
        $subjects->status = $request->status;
        $subjects->save();

        $notification = array(
            'message' => 'Subject Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('subject.index')->with($notification);

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
        $data['subject'] = Subject::find($id);
        return view('backend.questions.subjects.edit',$data);
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

        $subjects = Subject::find($id);
        $subjects->name = $request->name;
        $subjects->status = $request->status;
        $subjects->save();

        $notification = array(
            'message' => 'Subject update Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('subject.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $subject =  Subject::find($id)->delete();

        $notification = array(
            'message' => 'subject Delete Successfully!',
            'alert-type' => 'danger'
        );

        return redirect()->route('subject.index')->with($notification);
    }
}
