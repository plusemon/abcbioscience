<?php

namespace App\Http\Controllers;

use App\Models\ExtraExamGroup;
use App\Models\ExamGroupStudent;
use App\ExtraExamDetail;
use Illuminate\Http\Request;

class ExtraExamGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['extraexams'] = ExtraExamGroup::latest()->get();

        return view('backend.extraexamgroup.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.extraexamgroup.add');
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
        ]);

        $extraexam = New ExtraExamGroup();
        $input    = $request->except('_token');
        $extraexam->fill($input)->save();

        $notification = array(
            'message' => 'Exam Successfully Added!',
            'alert-type' => 'success'
        );
        return redirect()->route('extraexamgroup.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExtraExam  $extraExam
     * @return \Illuminate\Http\Response
     */
    public function show(ExtraExamGroup $extraExam,$id)
    {
        $data['extraExam'] = ExtraExamGroup::Find($id);
        $data['extraExamdetails'] = ExamGroupStudent::where('group_id',$id)->get();
        return view('backend.extraexamgroup.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExtraExam  $extraExam
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtraExamGroup $extraExam,$id)
    {
        $data['extraExam'] = ExtraExamGroup::Find($id);
        return view('backend.extraexamgroup.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtraExam  $extraExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExtraExamGroup $extraExam,$id)
    {

         $request->validate([
             'name' => 'required',
        ]);


        $extraexam =  ExtraExamGroup::find($id);
        $input    = $request->except('_token');
        $extraexam->fill($input)->save();

        $notification = array(
            'message' => 'Exam Successfully Updated!',
            'alert-type' => 'success'
        );
        return redirect()->route('extraexamgroup.index')->with($notification);
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
    
    
    
    
    
    
    
    
    public function extraexamgroupstore(Request $request)
    {
        $input = $request->all();
        
        foreach($input['name'] as $key => $value)
        {
            $student = New  ExamGroupStudent();
            
            $student->group_id  = $request->group_id;
            $student->name      = $input['name'][$key];
            $student->mobile    = $input['mobile'][$key];
            $student->section   = $input['section'][$key];
            $student->roll      = $input['roll'][$key];
            
             $student->save();
        }
        
        
        
        $notification = array(
            'message' => 'Extra Exam Student Successfully Added!',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
        
        
    }
    
    
    
    public function extraexamgroupupdate(Request $request,$id)
    {
            $student = ExamGroupStudent::find($id);
            
          
            $student->name      = $request->name;
            $student->mobile    = $request->mobile;
            $student->section   = $request->section;
            $student->roll      = $request->roll;
            
            $student->save();
      
        
            $notification = array(
                'message' => 'Extra Exam Student Successfully Updated!',
                'alert-type' => 'success'
            );
            
            return redirect()->back()->with($notification);
        
        
    }
    
    
    
    
    public function extraexamgroupdelete(Request $request,$id)
    {
            $student = ExamGroupStudent::find($id)->delete();
           
        
            $notification = array(
                'message' => 'Extra Exam Student Successfully Deleted!',
                'alert-type' => 'success'
            );
            
            return redirect()->back()->with($notification);
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
