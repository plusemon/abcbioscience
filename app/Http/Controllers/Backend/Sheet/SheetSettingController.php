<?php

namespace App\Http\Controllers\Backend\Sheet;

use App\Http\Controllers\Controller;
use App\Model\SheetSetting;
use Illuminate\Http\Request;


use App\Model\ExamSetting;

use App\Model\McqQuestionSubject;


use App\Model\FeeAmountSetting;
use App\Model\FeeSetting;

use App\Model\FeeCategory;

use App\Models\Sessiones;
use App\Models\Classes;
use App\Models\Sheet;
use App\Models\Subject;

use App\Model\PayTime;
use App\Model\BatchType;
use App\Models\BatchSetting;
use App\Models\StudentType;
use DB;
use Validator;
use Auth;

class SheetSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['classes']           = Classes::whereStatus(1)->get();
        $data['sessiones']          = Sessiones::whereStatus(1)->get();
        /*though it is not using, but maybe will be uses */
        $data['subjects']   = Subject::all();
        

        return view('backend.sheet.setting.index', $data);
    }






    public function ajax_index(Request $request)
    {

        $pagination = $request->pagination;

        $query  = SheetSetting::query();

        if($request->class_id)
        {
            $data['class_id']   = $request->class_id;
            $query = $query->where('class_id',$request->class_id);
        }  

        if($request->session_id)
        {
            $data['session_id'] = $request->session_id;
            $query = $query->where('session_id',$request->session_id);
        }  

         
        if($request->batch_setting_id)
        {
            $data['batch_setting_id']   = $request->batch_setting_id;
            $query = $query->where('batch_setting_id',$request->batch_setting_id);
        }

        if($request->subject_id)
        {
            $data['subject_id']   = $request->subject_id;
            $query                = $query->where('subject_id',$request->subject_id);
        }  



        if($pagination == 'all_data')
        {
            $pagination = $query->orderBy('id', 'DESC')->count();
        }else{
            $pagination = $pagination;
        }


        $data['sheetSettings'] =  $query->whereNull('deleted_at')->latest()->paginate($pagination);


        return view('backend.sheet.setting.ajax_index', $data);
    }









    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['batchTypies']        = BatchType::where('status', 1)->get();
        $data['payTimes']           = PayTime::where('status', 1)->get();

        $sheet                              = Sheet::find($request->sid);
        $data['sheetName']                  = $sheet ? $sheet->sheet_no : NULL;
        $data['subjectName']                = $sheet ? $sheet->subjects ? $sheet->subjects->name : NULL : NULL;

        $data['sheet_id']                   = $request->sid;
        $data['subject_id']                 = $sheet ? $sheet->subject_id : NULL;
        $data['class_id']                   = $sheet ? $sheet->class_id : NULL;
        $data['className']                  = $sheet ? $sheet->classes ? $sheet->classes->name : NULL : NULL;
        $data['session_id']                 = $sheet ? $sheet->session_id : NULL;
        $data['sessionName']                = $sheet ? $sheet->sessiones ? $sheet->sessiones->name : NULL : NULL;
        $data['sheet_type_id']              = $sheet ? $sheet->sheet_type_id : NULL;
        $data['sheetTypeName']              = $sheet ? $sheet->sheetTypes ? $sheet->sheetTypes->name : NULL : NULL;

        /**Batch Setting by class and session id */
        $data['batches'] = BatchSetting::where('status', 1)
            ->where('sessiones_id', $data['session_id'])
            ->where('classes_id', $data['class_id'])
            ->latest()
            ->get();
        /**Batch Setting by class and session id */
        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
            ->where('fee_category_type_id', 2)
            ->whereIn('id', [6])
            ->where('status', 1)
            //->latest()
            ->get();

        return view('backend.sheet.setting.create', $data);
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
            'sheet_id'    => 'required',
            'class_id'    => 'required',
            'session_id'  => 'required',
            'sheet_type_id'  => 'required',
            'subject_id'  => 'required',
            'batch_setting_id'  => 'required',
            'batch_type_id'  => 'required',
            'publish_date'  => 'required',
            'publish_by'  => 'required',
            'taken_by'  => 'required',
            'fee_cat_id'  => 'required',
            'pay_time_id'  => 'required',
            'amount'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $input  = $request->except('_token');

            $ssetting = new SheetSetting();
            $input['taken_by']        = $request->taken_by;
            $input['publish_by']      = $request->publish_by;
            $input['status']          = 1;
            $input['created_by']      = Auth::user()->id;
            $ssetting->fill($input)->save();

            $data = new FeeAmountSetting();
            $data->fee_cat_id           = $request->fee_cat_id;
            $data->class_id             = $request->class_id;
            $data->session_id           = $request->session_id;
            $data->batch_type_id        = $request->batch_type_id;
            $data->batch_setting_id     = $request->batch_setting_id;
            $data->pay_time_id          = $request->pay_time_id;
            $data->amount               = $request->amount;
            $data->origin_id            = $ssetting->id;
            $data->created_by           = Auth::user()->id;
            $data->status               = 1;
            $data->save();

            DB::commit();
            $notification = array(
                'message' => 'Sheet Setting Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.sheet.setting.index')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            if ($e->getMessage()) {
                // $message = "Something went wrong! Please Try again";
                $message = $e->getMessage();
            }
            $notification = array(
                'message' => 'Failed to Submit Student Info!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($message);
        }
    }
    
    public function show(SheetSetting $sheetSetting)
    {
        //
    }
    
    public function edit(SheetSetting $sheetSetting)
    {
        $data['setting']                    = $sheetSetting;
        $data['batchTypies']                = BatchType::where('status', 1)->get();
        $data['payTimes']                   = PayTime::where('status', 1)->get();

        $sheet                              = Sheet::find($sheetSetting->sheet_id);
        $data['sheetName']                  = $sheet ? $sheet->sheet_no : NULL;
        $data['subjectName']                = $sheet ? $sheet->subjects ? $sheet->subjects->name : NULL : NULL;

        $data['sheet_id']                   = $sheetSetting->sheet_id;
        $data['subject_id']                 = $sheet ? $sheet->subject_id : NULL;
        $data['class_id']                   = $sheet ? $sheet->class_id : NULL;
        $data['className']                  = $sheet ? $sheet->classes ? $sheet->classes->name : NULL : NULL;
        $data['session_id']                 = $sheet ? $sheet->session_id : NULL;
        $data['sessionName']                = $sheet ? $sheet->sessiones ? $sheet->sessiones->name : NULL : NULL;
        $data['sheet_type_id']              = $sheet ? $sheet->sheet_type_id : NULL;
        $data['sheetTypeName']              = $sheet ? $sheet->sheetTypes ? $sheet->sheetTypes->name : NULL : NULL;

        /**Batch Setting by class and session id */
        $data['batches'] = BatchSetting::where('status', 1)
            ->where('sessiones_id', $data['session_id'])
            ->where('classes_id', $data['class_id'])
            ->latest()
            ->get();
        /**Batch Setting by class and session id */
        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
            ->where('fee_category_type_id', 2)
            ->whereIn('id', [6])
            ->where('status', 1)
            //->latest()
            ->get();
        return view('backend.sheet.setting.edit', $data);
    }
    
    public function update(Request $request, SheetSetting $sheetSetting)
    {
        $request->validate([

            'batch_setting_id'  => 'required',
            'batch_type_id'  => 'required',
            'publish_date'  => 'required',
            'publish_by'  => 'required',
            'taken_by'  => 'required',
            'fee_cat_id'  => 'required',
            'pay_time_id'  => 'required',
            'amount'  => 'required',
        ]);

        DB::transaction(function () use ($sheetSetting, $request) {
            
            $data = $sheetSetting->amounts;
            
            $sheetSetting->batch_setting_id = $request->batch_setting_id;
            $sheetSetting->batch_type_id = $request->batch_type_id;
            $sheetSetting->publish_date = $request->publish_date;
            $sheetSetting->publish_by = $request->publish_by;
            $sheetSetting->taken_by = $request->taken_by;
            $sheetSetting->fee_cat_id = $request->fee_cat_id;
            $sheetSetting->created_by = Auth::id();
            $sheetSetting->save();

            $data->fee_cat_id           = $request->fee_cat_id;
            $data->batch_type_id        = $request->batch_type_id;
            $data->batch_setting_id     = $request->batch_setting_id;
            $data->pay_time_id          = $request->pay_time_id;
            $data->amount               = $request->amount;
            $data->created_by           = Auth::id();
            $data->save();
        });

        $notification = array(
            'message' => 'Sheet Setting Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.sheet.setting.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SheetSetting  $sheetSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SheetSetting::find($id)->delete();
        
        $notification = array(
            'message' => 'Sheet Setting Delete Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.sheet.setting.index')->with($notification);
        
    }
}
