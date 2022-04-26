<?php

namespace App\Http\Controllers;

use App\ExtraExam;
use App\ExtraExamDetail;
use Illuminate\Http\Request;

class ExtraExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['extraexams'] = ExtraExam::latest()->get();

        return view('backend.extraexam.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.extraexam.add');
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
             'exam_name' => 'required',
             'exam_date' => 'required',
        ]);

        $extraexam = New ExtraExam();
        $input    = $request->except('_token');
        $extraexam->fill($input)->save();

        $notification = array(
            'message' => 'Exam Successfully Added!',
            'alert-type' => 'success'
        );
        return redirect()->route('extraexam.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExtraExam  $extraExam
     * @return \Illuminate\Http\Response
     */
    public function show(ExtraExam $extraExam,$id)
    {
        $data['extraExam'] = ExtraExam::Find($id);
        $data['extraExamdetails'] = ExtraExamDetail::where('extra_exam_id',$id)->get();
        return view('backend.extraexam.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExtraExam  $extraExam
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtraExam $extraExam,$id)
    {
        $data['extraExam'] = ExtraExam::Find($id);
        return view('backend.extraexam.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtraExam  $extraExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExtraExam $extraExam,$id)
    {

         $request->validate([
             'exam_name' => 'required',
             'exam_date' => 'required',
        ]);


        $extraexam =  ExtraExam::find($id);
        $input    = $request->except('_token');
        $extraexam->fill($input)->save();

        $notification = array(
            'message' => 'Exam Successfully Updated!',
            'alert-type' => 'success'
        );
        return redirect()->route('extraexam.index')->with($notification);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtraExam  $extraExam
     * @return \Illuminate\Http\Response
     */
      public function destroy(ExtraExam $extraExam,$id)
    {
        ExtraExam::find($id)->delete();

        $notification = array(
            'message' => 'Exam Successfully Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->route('extraexam.index')->with($notification);
    }
}
