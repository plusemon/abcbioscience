<?php

namespace App\Http\Controllers\Backend\Fee;

use App\Http\Controllers\Controller;
use App\Model\FeeAmountSetting;
use Illuminate\Http\Request;

use App\Model\FeeSetting;

use App\Model\FeeCategory;
use App\Model\FeeActionType;

use App\Models\Section;
use App\Models\Sessiones;
use App\Models\Classes;
use App\Models\Batch;

use App\Model\PayTime;
use App\Model\BatchType;
use App\Models\BatchSetting;
use App\Models\StudentType;
use DB;
use Validator;
use Auth;
class FeeAmountSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();


        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
                                ->where('status',1)
                                ->latest()
                                ->get();


        $data['fee_settings'] = FeeAmountSetting::whereNull('deleted_at')->where('status',1)->latest()->paginate(100);
        return view("backend.fee_management.fee_amount_setting.index",$data);
    }



    public function ajaxindex(Request $request)
    {

        $pagination = $request->pagination;

         


        $query = FeeAmountSetting::query();



        if ($request->class_id) {
            $data['class_id']   = $request->class_id;
            $query->where('class_id', $request->class_id);

        }

        if ($request->session_id) {
            $data['session_id'] = $request->session_id;
            $query->where('session_id', $request->session_id);

        }

        if ($request->batch_setting_id) {
            $data['batch_setting_id']   = $request->batch_setting_id;
            $query->where('batch_setting_id', $request->batch_setting_id);

        }


        if ($request->fee_cat_id) {
            $data['fee_cat_id']   = $request->fee_cat_id;
            $query->where('fee_cat_id', $request->fee_cat_id);
        }   


        if($pagination == 'all_data')
        {
            $pagination = $query->orderBy('id', 'DESC')->count();
        }else{
            $pagination = $pagination;
        }



       $data['fee_settings'] = $query->whereNull('deleted_at')->where('status',1)->whereIn('pay_time_id',[1,2])->latest()->paginate($pagination);


      return view("backend.fee_management.fee_amount_setting.ajax_index",$data);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['batchTypies']        = BatchType::where('status',1)->get();
        $data['payTimes']           = PayTime::where('status',1)->get();
        $data['classes']            = Classes::where('status',1)->get();
        $data['sessiones']          = Sessiones::where('status',1)->get();
        /*  $data['sectiones']      = Section::where('status',1)->get();
        $data['student_typies'] = StudentType::where('status',1)->get();
        $data['fee_action_typies'] = FeeActionType::where('status',1)->get();*/

        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
                                ->where('fee_category_type_id',1)
                                ->where('status',1)
                                ->latest()
                                ->get();
        return view("backend.fee_management.fee_amount_setting.create",$data);
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
            'fee_cat_id'    => 'required',
            //'student_type_id' => 'required',
            'batch_setting_id' => 'required',
            'batch_type_id' => 'required',
            'pay_time_id' => 'required',
            'amount'        => 'required',
        ]);
        if ($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $exist = FeeAmountSetting::where('fee_cat_id',$request->fee_cat_id)
                    ->where('class_id',$request->class_id)
                    ->where('session_id',$request->session_id)
                    ->where('batch_type_id',$request->batch_type_id)
                    ->where('batch_setting_id',$request->batch_setting_id)
                    ->where('pay_time_id',$request->pay_time_id)
                    ->where('status',1)
                    ->first();
        if($exist)
        {
            $exist->status = 2;
            $exist->deleted_at = date('Y-m-d h:i:s');
            $exist->save();
        }

        $data = new FeeAmountSetting();
        $data->fee_cat_id           = $request->fee_cat_id;
        $data->class_id             = $request->class_id;
        $data->session_id           = $request->session_id;
        $data->batch_type_id        = $request->batch_type_id;
        $data->batch_setting_id     = $request->batch_setting_id;
        $data->pay_time_id          = $request->pay_time_id;
        $data->amount               = $request->amount;
        $data->origin_id            = NULL;
        $data->status               = 1;
        $data->created_by           = Auth::user()->id;
        $data->save();
        $notification = array(
            'message' => 'Batch Wise Fee Amount Setting Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.fee-amount-setting.index')->with($notification);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Model\FeeAmountSetting  $feeAmountSetting
     * @return \Illuminate\Http\Response
     */
    public function show(FeeAmountSetting $feeAmountSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\FeeAmountSetting  $feeAmountSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeAmountSetting $feeAmountSetting)
    {
        $data['batches']            = BatchSetting::where('status',1)->get();
        $data['batchTypies']        = BatchType::where('status',1)->get();
        $data['payTimes']           = PayTime::where('status',1)->get();
        $data['classes']            = Classes::where('status',1)->get();
        $data['sessiones']          = Sessiones::where('status',1)->get();
        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
                                ->where('fee_category_type_id',1)
                                ->where('status',1)
                                ->latest()
                                ->get();
        $data['feeAmountSetting']     = $feeAmountSetting;
        return view("backend.fee_management.fee_amount_setting.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\FeeAmountSetting  $feeAmountSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeeAmountSetting $feeAmountSetting)
    {
        $validator = Validator::make($request->all(), [
            'class_id'          => 'required',
            'session_id'        => 'required',
            'fee_cat_id'        => 'required',
            'batch_setting_id'  => 'required',
            'batch_type_id'     => 'required',
            'pay_time_id'       => 'required',
            'amount'            => 'required',
        ]);
        if ($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        /* 
            $exist = FeeAmountSetting::where('fee_cat_id',$request->fee_cat_id)
                        ->where('class_id',$request->class_id)
                        ->where('session_id',$request->session_id)
                        ->where('batch_type_id',$request->batch_type_id)
                        ->where('batch_setting_id',$request->batch_setting_id)
                        ->where('pay_time_id',$request->pay_time_id)
                        ->where('status',1)
                        ->first();
            if($exist)
            {
                $exist->status = 2;
                $exist->deleted_at = date('Y-m-d h:i:s');
                $exist->save();
            } 
        */

        $feeAmountSetting->fee_cat_id           = $request->fee_cat_id;
        $feeAmountSetting->class_id             = $request->class_id;
        $feeAmountSetting->session_id           = $request->session_id;
        $feeAmountSetting->batch_type_id        = $request->batch_type_id;
        $feeAmountSetting->batch_setting_id     = $request->batch_setting_id;
        $feeAmountSetting->pay_time_id          = $request->pay_time_id;
        $feeAmountSetting->amount               = $request->amount;
        $feeAmountSetting->origin_id            = NULL;
        $feeAmountSetting->status               = 1;
        $feeAmountSetting->save();
        $notification = array(
            'message' => 'Batch Wise Fee Amount Setting Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.fee-amount-setting.index')->with($notification);
        
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\FeeAmountSetting  $feeAmountSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeAmountSetting $feeAmountSetting)
    {
        $feeAmountSetting->status = 2;
        $feeAmountSetting->deleted_at = date('Y-m-d h:i:s');
        $feeAmountSetting->save();
        $notification = array(
            'message' => 'Fee Setting Amount Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.fee-amount-setting.index')->with($notification);
    }
}
