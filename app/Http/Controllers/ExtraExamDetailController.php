<?php

namespace App\Http\Controllers;

use App\ExtraExamDetail;
use Illuminate\Http\Request;
use App\Imports\ExtraExamImport;
use Excel;
use DB;
use App\Models\ExamGroupStudent;

class ExtraExamDetailController extends Controller
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
            'name' => 'required',
            'mobile' => 'required',
       ]);
       
       $input = $request->all();
       
       
       

       $extraexam = New ExamGroupStudent();
       $input    = $request->except('_token');
       $extraexam->fill($input)->save();

       $notification = array(
           'message' => 'Exam Mark Successfully Added!',
           'alert-type' => 'success'
       );
       return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExtraExamDetail  $extraExamDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ExtraExamDetail $extraExamDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExtraExamDetail  $extraExamDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtraExamDetail $extraExamDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtraExamDetail  $extraExamDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $request->validate([
            'name' => 'required',
            'mobile' => 'required',
       ]);

       $extraexam =  ExtraExamDetail::find($id);
       $input    = $request->except('_token');
       $extraexam->fill($input)->save();

       $notification = array(
           'message' => 'Exam Mark Successfully Added!',
           'alert-type' => 'success'
       );
       return redirect()->back()->with($notification);
    }
    
    
    public function importextraexam(Request $request)
    {
         $request->validate([
             'exam_file' => 'required',
             'extra_exam_id' => 'required',
        ]);


        $file = $request->exam_file;

        $studentsdata = Excel::toArray(new ExtraExamImport(), $file)[0];
        
        $length = count($studentsdata);

 

       foreach (array_chunk($studentsdata, 10000) as $students)
        {
         
           
                DB::beginTransaction();
        
                try{ 

                    for($i = 1; $i < $length; $i++){
                            
                            
                       $ExtraExamDetail = new ExtraExamDetail();
                       
                       $ExtraExamDetail->extra_exam_id  = $request->extra_exam_id;
                       $ExtraExamDetail->name           = $students[$i][1];
                       $ExtraExamDetail->mobile         = $students[$i][2];
                       $ExtraExamDetail->section        = $students[$i][3];
                       $ExtraExamDetail->roll           = $students[$i][4];
                       $ExtraExamDetail->mcq_mark       = $students[$i][5];
                       $ExtraExamDetail->written_mark   = $students[$i][6];
                       
                       $ExtraExamDetail->save();
                   
               
                    }
    
                DB::commit();
                 $notification = array(
                    'message' => 'Bulk Order Uploaded!',
                    'alert-type' => 'success'
                );
    
                return redirect()->back()->with($notification);
    
            }catch(\Exception $e){
                print($e);
                DB::rollback();
            } 
    
        }
        
    }
    
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtraExamDetail  $extraExamDetail
     * @return \Illuminate\Http\Response
     */
      public function destroy(ExtraExamDetail $extraExamDetail,$id)
    {
        ExtraExamDetail::find($id)->delete();

        $notification = array(
            'message' => 'Exam Mark Successfully Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
