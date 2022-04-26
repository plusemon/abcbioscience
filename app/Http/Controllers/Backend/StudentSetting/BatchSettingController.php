<?php

namespace App\Http\Controllers\Backend\StudentSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Sessiones;
use App\Models\Section;
use App\Models\Batch;
use App\Models\StudentType;
use App\Models\BatchSetting;
use App\Models\BatchDayTime;
use App\Model\FeeSetting;
use App\Models\Day;
use Auth;
use Validator;
use Redirect,Response;
use DB;
use App\Model\FeeCategory;
class BatchSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $query = BatchSetting::query();
        
        
        if ($request->class_id) {
            $data['class_id']   = $request->class_id;
            $query->where('classes_id', $request->class_id);
        }

        if ($request->session_id) {
            $data['session_id'] = $request->session_id;
            $query->where('sessiones_id', $request->session_id);
        }
        
        
       $data['batchsettings']   = $query->orderBy('classes_id','ASC')->get();
       
       $data['classes']         = Classes::all();
       $data['sessiones']       = Sessiones::all();
       $data['sectiones']       = Section::all();
       return view('backend.studentsetting.batchsettinges.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['classes']   = Classes::all();
        $data['sessiones'] = Sessiones::all();
        $data['sectiones'] = Section::all();
        $data['classtypes'] = StudentType::all();
        $data['daies']     = Day::all();

        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')->where('status',1)->latest()->get();
        return view('backend.studentsetting.batchsettinges.add',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $input = $request->all();
        DB::beginTransaction();
        try{
                $validator = Validator::make($request->all(), [
                    'classes_id'    => 'required',
                    'sessiones_id'  => 'required',
                    'class_type_id' => 'required',
                    //'amount'        => 'required',
                    'status'        => 'required',
                ]);

            if ($validator->fails()){
                    return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } 
    
            
            $countdata      = BatchSetting::count();
            $lastdata       = BatchSetting::orderBy('id','DESC')->first();
            $batchsetting   = new BatchSetting();
            if($countdata>0)
            {
                $batchsetting->batch_uid = $lastdata->batch_uid+1;
            }
            else{
                $batchsetting->batch_uid = "2021001";
            }

            $batchsetting->batch_name   = $request->batch_name;
            $batchsetting->classes_id   = $request->classes_id;
            $batchsetting->sessiones_id = $request->sessiones_id;
            $batchsetting->class_type_id= $request->class_type_id;
            $batchsetting->description  = $request->description;
            $batchsetting->total_seat   = $request->total_seat;
            $batchsetting->fb_link      = $request->fb_link;
            $batchsetting->status       = $request->status;


            $batchsetting->save();


            if($request->day_id!=null){
                if($input['day_id'] != ''){
                    foreach ($input['day_id'] as $key => $value) {
                        $batchdaytime                   = new BatchDayTime;
                        $batchdaytime->batch_setting_id = $batchsetting->id;
                        $batchdaytime->day_id           = $input['day_id'][$key];
                        $batchdaytime->start_time       = $input['start_time'][$key];
                        $batchdaytime->end_time         = $input['end_time'][$key];
                        $batchdaytime->status           = 1;
                        $batchdaytime->save();
                    }
                }
            }
             
            
        DB::commit();
        $notification = array(
            'message' => 'Setting Succefully Added!',
            'alert-type' => 'success'
        );
            return redirect()->route('batch.schedule.index')->with($notification);
        } 
            catch(\Exception $e) {
            DB::rollback();
            if($e->getMessage())
            {
                // $message = "Something went wrong! Please Try again";
                $message = $e->getMessage();

            }

            $notification = array(
                'message' => 'Failed to Submit Batch Setting!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }


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
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
        $data['sectiones']      = Section::all();
        $data['batches']        = Batch::all();
        $data['classtypes']     = StudentType::all();
        $data['daies']          = Day::all();
        $data['batchsetting']   = BatchSetting::find($id);

        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')->where('status',1)->latest()->get();

        return view('backend.studentsetting.batchsettinges.edit',$data);
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

        $input = $request->all();

        DB::beginTransaction();
        try{
            $validator = Validator::make($request->all(), [
                'classes_id'    => 'required',
                'sessiones_id'  => 'required',
                'class_type_id' => 'required',
                'status'        => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        } 
       
        $countdata  = batchsetting::count();
        $lastdata   = batchsetting::orderBy('id','DESC')->first();


        $batchsetting =  BatchSetting::find($id);
        if($countdata>0)
        {
            $batchsetting->batch_uid = $lastdata->batch_uid+1;
        }
        else{
            $batchsetting->batch_uid = "2021001";
        }
        $batchsetting->batch_name   = $request->batch_name;
        $batchsetting->classes_id   = $request->classes_id;
        $batchsetting->sessiones_id = $request->sessiones_id;
        $batchsetting->class_type_id= $request->class_type_id;
        $batchsetting->description  = $request->description;
        $batchsetting->total_seat   = $request->total_seat;
        $batchsetting->fb_link      = $request->fb_link;
        $batchsetting->status       = $request->status;

        $batchsetting->save();


        BatchDayTime::where('batch_setting_id',$id)->delete();



        if($request->day_id!=null){
            if($input['day_id'] != ''){
                foreach ($input['day_id'] as $key => $value) {
                    $batchdaytime             = new BatchDayTime;
                    $batchdaytime->batch_setting_id = $batchsetting->id;
                    $batchdaytime->day_id     = $input['day_id'][$key];
                    $batchdaytime->start_time = $input['start_time'][$key];
                    $batchdaytime->end_time   = $input['end_time'][$key];
                    $batchdaytime->status     = 1;
                    $batchdaytime->save();
                }
            }
        }


          

        DB::commit();
        $notification = array(
            'message' => 'Setting Succefully Updated!',
            'alert-type' => 'success'
        );

        return redirect()->route('batch.schedule.index')->with($notification);
        } 
         catch(\Exception $e) {
            dd($e);
            DB::rollback();
            if($e->getMessage())
            {
                // $message = "Something went wrong! Please Try again";
                $message = $e->getMessage();

            }

            $notification = array(
                'message' => 'Failed to Submit Batch Setting!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BatchDayTime::where('batch_setting_id',$id)->delete();
        BatchSetting::find($id)->delete();

        $notification = array(
                'message' => 'Batch schedule Delete Succefully!',
                'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function datetimedestroy($id)
    {
        BatchDayTime::where('id',$id)->delete();
        
        $notification = array(
                'message' => 'Batch schedule Day Delete Succefully!',
                'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
