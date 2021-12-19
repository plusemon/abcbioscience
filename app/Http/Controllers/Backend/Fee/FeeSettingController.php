<?php

namespace App\Http\Controllers\Backend\Fee;

use App\Http\Controllers\Controller;
use App\Model\FeeSetting;
use Illuminate\Http\Request;
use App\Model\FeeCategory;
use App\Model\FeeActionType;

use App\Models\Section;
use App\Models\Sessiones;
use App\Models\Classes;
use App\Models\Batch;
use App\Models\BatchSetting;
use App\Models\StudentType;
use DB;
use Validator;

class FeeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['fee_settings'] = FeeSetting::whereNull('deleted_at')->where('status',1)->latest()->get();
        return view("backend.fee_management.fee_setting.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['classes']        = Classes::where('status',1)->get();
        $data['sessiones']      = Sessiones::where('status',1)->get();
        $data['sectiones']      = Section::where('status',1)->get();
        $data['student_typies'] = StudentType::where('status',1)->get();
        $data['fee_action_typies'] = FeeActionType::where('status',1)->get();

        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')->where('status',1)->latest()->get();
        return view("backend.fee_management.fee_setting.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            /* 'name'          => 'required',
            'mobile'        => $request->email == NULL ?'required|min:10|max:16':'nullable'.'|unique:users,mobile',
            'email'         => $request->mobile == NULL  ?'required|email':'nullable'.'|unique:users,email', */
            'class_id'      => 'required',
            'session_id'    => 'required',
            'section_id'    => 'required',
            'fee_cat_id'    => 'required',
            'student_type_id' => 'required',
            'batch_setting_id' => 'required',
            'amount'        => 'required',
            /* 'class_id'    => $request->class_id ?'required':'nullable',
            'session_id'  => $request->class_id ?'required':'nullable',
            'batch_setting_id'=> $request->class_id ?'required':'nullable',
            'section_id'=> $request->class_id ?'required':'nullable',
            'student_type_id'=> $request->class_id ?'required':'nullable', */
        ]);
        if ($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $exist = FeeSetting::where('fee_cat_id',$request->fee_cat_id)
                    ->where('class_id',$request->class_id)
                    ->where('session_id',$request->session_id)
                    ->where('student_type_id',$request->student_type_id)
                    ->where('batch_setting_id',$request->batch_setting_id)
                    ->where('status',1)
                    ->first();
        if($exist)
        {
            $exist->status = 2;
            $exist->deleted_at = date('Y-m-d h:i:s');
            $exist->save();
        }

        $data = new FeeSetting();
        $data->fee_cat_id           = $request->fee_cat_id;
        $data->class_id             = $request->class_id;
        $data->session_id           = $request->session_id;
        $data->section_id           = $request->section_id;
        $data->student_type_id      = $request->student_type_id;
        $data->batch_setting_id     = $request->batch_setting_id;
        $data->amount               = $request->amount;
        $data->fee_category_action_type_id = $request->fee_category_action_type_id;
        $data->status               = 1;
        $data->save();
        $notification = array(
            'message' => 'Fee Setting Create Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.fee-setting.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\FeeSetting  $feeSetting
     * @return \Illuminate\Http\Response
     */
    public function show(FeeSetting $feeSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\FeeSetting  $feeSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeSetting $feeSetting)
    {
        $data['classes']        = Classes::where('status',1)->get();
        $data['sessiones']      = Sessiones::where('status',1)->get();
        $data['sectiones']      = Section::where('status',1)->get();
        $data['student_typies'] = StudentType::where('status',1)->get();
        $data['batch_settings'] = BatchSetting::where('status',1)->get();
        $data['fee_action_typies'] = FeeActionType::where('status',1)->get();
        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')->where('status',1)->latest()->get();
        $data['feeSetting']     = $feeSetting;
        return view("backend.fee_management.fee_setting.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\FeeSetting  $feeSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeeSetting $feeSetting)
    {
        $validator = Validator::make($request->all(), [
            'class_id'          => 'required',
            'session_id'        => 'required',
            'section_id'        => 'required',
            'fee_cat_id'        => 'required',
            'student_type_id'   => 'required',
            'batch_setting_id'  => 'required',
            'amount'            => 'required',
        ]);
        if ($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = FeeSetting::query();
        $exist = $data->where('fee_cat_id',$request->fee_cat_id)
                ->where('class_id',$request->class_id)
                ->where('session_id',$request->session_id)
                ->where('student_type_id',$request->student_type_id)
                ->where('batch_setting_id',$request->batch_setting_id)
                ->where('status',1);
        if($exist->count() > 1 )
        {
            $firstData  =  $exist->first();
            $firstData->deleted_at = date('Y-m-d h:i:s');
            $firstData->status = 1;
            $firstData->save();
        }

        $feeSetting->fee_cat_id         = $request->fee_cat_id;
        $feeSetting->class_id           = $request->class_id;
        $feeSetting->session_id         = $request->session_id;
        $feeSetting->section_id         = $request->section_id;
        $feeSetting->student_type_id    = $request->student_type_id;
        $feeSetting->batch_setting_id   = $request->batch_setting_id;
        $feeSetting->amount             = $request->amount;
        $feeSetting->fee_category_action_type_id = $request->fee_category_action_type_id;
        $feeSetting->status             = 1;
        $feeSetting->save();
        $notification = array(
            'message' => 'Fee Setting Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.fee-setting.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\FeeSetting  $feeSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeSetting $feeSetting)
    {
        $feeSetting->status = 2;
        $feeSetting->deleted_at = date('Y-m-d h:i:s');
        $feeSetting->save();
        $notification = array(
            'message' => 'Fee Setting Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.fee-setting.index')->with($notification);
    }
}
