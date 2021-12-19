<?php

namespace App\Http\Controllers\Backend\Fee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\FeeCollection;

use App\Model\StudentWaiver;
use App\Model\Waiver;
use App\Model\WaiverType;
use App\Model\AbsentMonth;
use App\Models\AbsentStudent;

use App\Model\BatchType;
use App\Model\FeeAmountSetting;
use App\Model\FeeSetting;
use App\Model\FeeCategory;
use App\Models\Section;
use App\Models\Sessiones;
use App\Models\Classes;
use App\Models\Month;
use App\Models\Year;
use App\Models\BatchSetting;
use App\Models\StudentType;
use App\Models\Student;
use DB;
use Validator;
use App\User;
use App\Model\FeeCollectionMain;
use App\Model\PaymentHistory;

use App\Traits\ReceivePaymentTrait;
class OthersFeeCollectionController extends Controller
{
    use ReceivePaymentTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function othersFeeCollection(Request $request)
    {
        $data['classId']           = $request->class_id;
        $data['sessionId']         = $request->session_id;
        $data['batchId']           = $request->batch_id;
        $data['classTypeId']       = $request->class_type_id;

        $getStudentId   = NULL;
        $userId         = NULL;
        if(isset($_GET['student_id']))
        {
            $getStudent     = Student::where('user_id',$_GET['student_id'])
                                    ->where('activate_status',1)
                                    ->whereNull('deleted_at')
                                    ->first();
            $getStudentId = $getStudent?$getStudent->id : NULL;
            if(empty($getStudent))
            {
                $notification = array(
                    'message' => 'Add Student Or Promotion Student First!',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);
            }
            $userId = $_GET['student_id'];
        }
        $data['get_student_id']     = $getStudentId;
        $data['student_user_id']    = $userId;

        /**----------------------------------------------------------------------------------*/
        //$data['students']       = Student::where('activate_status',1)->whereNull('deleted_at')->get();

        $data['classes']        = Classes::where('status',1)->get();
        $data['sessiones']      = Sessiones::where('status',1)->get();
        $data['sectiones']      = Section::where('status',1)->get();
        $data['student_typies'] = StudentType::where('status',1)->get();
        $data['batch_settings'] = BatchSetting::where('status',1)->latest()->get();
        $data['batchTypies']    = BatchType::where('status',1)->latest()->get();
        $data['fee_categories'] = FeeCategory::where('status',1)
                                            //->where('fee_category_type_id',1)
                                            ->whereNotIn('id',[2])
                                            ->latest()
                                            ->get();
        $data['months']         = Month::get();//where('status',1)->latest()->
        return view('backend.fee_management.fee_collection.others_fee_collection.create',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchFeeAmountSettingByOthersData(Request $request)
    {
        $class_id           = $request->class_id;
        $session_id         = $request->session_id;
        $batch_setting_id   = $request->batch_setting_id;
        $fee_cat_id         = $request->fee_cat_id;
        $batch_type_id      = $request->batch_type_id;

        $datas = FeeAmountSetting::whereNull('deleted_at')
                        ->where('fee_cat_id',$fee_cat_id)
                        ->where('class_id',$class_id)
                        ->where('session_id',$session_id)
                        ->when($batch_setting_id,function($q) use ($batch_setting_id){
                            $q->where('batch_setting_id',$batch_setting_id) ;
                        })
                        ->when($batch_type_id,function($q) use ($batch_type_id){
                            $q->where('batch_type_id',$batch_type_id)  ;
                        })
                        ->where('status',1)
                        ->get();

            $output = '<option value="">'.'Please Select One'.'</option>';
            foreach($datas as $data)
            {
                $detail = $data->feeCategory($data->fee_cat_id);
                $id     = $detail['id'];
                $name   = $detail['name'];;
                $output .='<option value="'.$data->id.'">'.$name.'</option>';
            }
            if($datas)
            {
                return response()->json([
                    'status'    => true,
                    'data'      => $output
                ]);
            }
            return response()->json([
                'status'    => false,
                'data'      => $output
            ]);
    }



    public function othersFeeCollectionByStudent(Request $request)
    {
        $student_id         = $request->student_id;
        $class_id           = $request->class_id;
        $session_id         = $request->session_id;
        $batch_setting_id   = $request->batch_setting_id;
        $fee_cat_id         = $request->fee_cat_id;
        $batch_type_id      = $request->batch_type_id;
        $fee_amount_setting_id = $request->fee_amount_setting_id;

        /**------------------------------------ */
        $session        = Sessiones::findOrfail($session_id);
        $sessionIdYear  = $session?$session->name:NULL;
        

        $student    = Student::where('user_id',$student_id)
                        ->where('class_id',$class_id)
                        ->where('session_id',$session_id)
                        ->where('batch_setting_id',$batch_setting_id)
                        ->where('batch_type_id',$batch_type_id)
                        ->where('activate_status',1)
                        ->whereNull('deleted_at')
                        ->first();

        $startMonthId   = $student?$student->start_month_id:NULL;
        $admissionYear  = $student?$student->session_id:NULL;
        $userId         = $student?$student->user_id:NULL;

        $absentMonth    = [];
        $absent = AbsentStudent::where('student_id',$student_id)
                    ->where('class_id',$class_id)
                    ->where('session_id',$session_id)
                    ->where('batch_setting_id',$batch_setting_id)
                    ->where('status',1)
                    ->whereNull('deleted_at')
                    ->first();
        if($absent)
        {
            foreach ($absent->absentMonths as $key => $absn)
            {
                $absentMonth[$key] = $absn->month_id;
            }
        }

        /* if(in_array($month_id,$absentMonth))
        {
            return response()->json([
                'status' => false
            ]);
        } */

        /**------------------------------------ */

        $data['feeSetting']  = FeeAmountSetting::where('id',$fee_amount_setting_id)
                                ->where('class_id',$class_id)
                                ->where('session_id',$session_id)
                                ->where('fee_cat_id',$fee_cat_id)
                                ->where('batch_setting_id',$batch_setting_id)
                                ->where('batch_type_id',$batch_type_id)
                                ->where('status',1)
                                ->whereNull('deleted_at')
                                ->first();

        $data['student_id']         = $student?$student->id:NULL;
        $data['class_id']           = $class_id;
        $data['session_id']         = $session_id;
        $data['batch_setting_id']   = $batch_setting_id;
        $data['origin_id']          = $data['feeSetting']?$data['feeSetting']->origin_id : NULL;
        $data['batch_type_id']      = $batch_type_id;

        if($startMonthId  )//&& $admissionYear == $sessionIdYear <= $month_id
        {
            if($data['feeSetting'])
            {
                $html = view('backend.fee_management.fee_collection.others_fee_collection.ajax_fee_cat_list',$data)->render();
                return response()->json([
                    'status' => true,
                    'htmlData' => $html
                ]);
            }
            return response()->json([
                'status' => false
            ]);
        }
        else{
            return response()->json([
                'status' => false
            ]);
        }
    }



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

    public function storeOthersFeeCollectionByStudent(Request $request)
    {
        //return $request;

        $validator = Validator::make($request->all(), [
            'student_id'        => 'required',
            'class_id'          => 'required',
            'session_id'        => 'required',
            'origin_id'         => 'required',
            'fee_cat_id'        => 'required',
            'batch_setting_id'  => 'required',
            'batch_type_id'     => 'required',
            'amount'            => 'required',
            'fee_amount_setting_id' => 'required',
        ]);
        if ($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        //return $request;
        if(!isset($request->amount) || $request->amount == NULL || $request->amount == 'null' || empty($request->amount))
        {
            $notification = array(
                'message' => 'Please Set Fee Collection Amount!',
                'alert-type' => 'wanring'
            );
            return redirect()->back()->with($notification);
        }

        //return $request;
        DB::beginTransaction();
        try
        {
            $this->invoice_no           = NULL;
            $this->reference_no         = $request->reference_no.date('Y').'P';
            $this->amount               = $request->amount;
            $this->student_id           = $request->student_id;
            $this->fee_cat_id           = $request->fee_cat_id;
            $this->user_id              = $request->user_id;
            $this->class_id             = $request->class_id;
            $this->session_id           = $request->session_id;
            $this->batch_setting_id     = $request->batch_setting_id;
            $this->batch_type_id        = $request->batch_type_id;
            $this->fee_amount_setting_id = $request->fee_amount_setting_id;
            $this->student_waiver_id    = $request->student_waiver_id;
            $this->origin_id            = $request->origin_id;

            $this->payment_method_id    = NULL;
            $this->account_id           = NULL;
            $this->receivePayment();

            DB::commit();

            $notification = array(
                'message' => 'Fee Collection Successfully!',
                'alert-type' => 'success'
            );
                return redirect()->route('admin.fee-collection.index')->with($notification);

        }//
        catch(\Exception $e)
        {
            DB::rollback();
            if($e->getMessage())
            {
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




    public function othersFeeDueList(Request $request)
    {
        $data['classId']           = $request->class_id;
        $data['sessionId']         = $request->session_id;
        $data['batchId']           = $request->batch_id;
        $data['classTypeId']       = $request->class_type_id;

        $getStudentId   = NULL;
        $userId         = NULL;
        if(isset($_GET['student_id']))
        {
            $getStudent     = Student::where('user_id',$_GET['student_id'])
                                    ->where('activate_status',1)
                                    ->whereNull('deleted_at')
                                    ->first();
            $getStudentId = $getStudent?$getStudent->id : NULL;
            if(empty($getStudent))
            {
                $notification = array(
                    'message' => 'Add Student Or Promotion Student First!',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);
            }
            $userId = $_GET['student_id'];
        }
        $data['get_student_id']     = $getStudentId;
        $data['student_user_id']    = $userId;

        /**----------------------------------------------------------------------------------*/
        //$data['students']       = Student::where('activate_status',1)->whereNull('deleted_at')->get();

        $data['classes']        = Classes::where('status',1)->get();
        $data['sessiones']      = Sessiones::where('status',1)->get();
        $data['sectiones']      = Section::where('status',1)->get();
        $data['student_typies'] = StudentType::where('status',1)->get();
        $data['batch_settings'] = BatchSetting::where('status',1)->latest()->get();
        $data['batchTypies']    = BatchType::where('status',1)->latest()->get();
        $data['fee_categories'] = FeeCategory::where('status',1)
                                            //->where('fee_category_type_id',1)
                                            ->whereNotIn('id',[2])
                                            ->latest()
                                            ->get();
        $data['months']         = Month::get();//where('status',1)->latest()->
        return view('backend.fee_management.others_due_list.list',$data);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\PaymentHistory  $paymentHistory
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentHistory $paymentHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\PaymentHistory  $paymentHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentHistory $paymentHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\PaymentHistory  $paymentHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentHistory $paymentHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\PaymentHistory  $paymentHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentHistory $paymentHistory)
    {
        //
    }
}
