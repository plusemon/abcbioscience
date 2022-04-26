<?php

namespace App\Http\Controllers\Backend\Fee;

use App\Http\Controllers\Controller;
use App\Model\FeeCollection;
use Illuminate\Http\Request;
use App\Model\Backend\Payment\Account;
use App\Model\Backend\Payment\PaymentMethod;
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
use App\Jobs\MatchSendSms;
use App\Models\SmsHistroy;
use App\Exports\PaymentExport;
use Auth;
use Excel;
use App\Traits\ReceivePaymentTrait;
use App\Models\WebSetting;
use PDF;

class FeeCollectionController extends Controller
{
    use ReceivePaymentTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function index()
    {

        $data['classes']        = Classes::where('status',1)->get();
        $data['sessiones']      = Sessiones::where('status',1)->get();
        $data['batch_settings'] = BatchSetting::where('status',1)->latest()->get();
        $data['months']         = Month::get();
        $data['fee_categories'] = FeeCategory::where('status',1)
                                            ->get();

        return view('backend.fee_management.fee_collection.index',$data);
    }



    public function ajaxindex(Request $request)
    {

        $pagination = $request->pagination;

        $query = PaymentHistory::query();


        if ($request->student_id) {
            $data['student_id'] = $request->student_id;
            $findusercount = User::where('id', $request->student_id)->count();

            if ($findusercount > 0) {
                $finduser = User::where('id', $request->student_id)->first();
                $query->where('user_id', $finduser->id);
            }

        }


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


        if($request->fee_cat_id) {
            $data['fee_cat_id']   = $request->fee_cat_id;
            $query->where('fee_cat_id', $request->fee_cat_id);
        }


        if($request->month_id) {
            $data['month_id']   = $request->month_id;
            $query->where('origin_id', $request->month_id);
        }



        $StartDate = Date('Y-m-d 00:00:00', strtotime($request->start_date));
        $EndDate   = Date('Y-m-d 23:59:59', strtotime($request->end_date));


        if ($request->customer_id) {
            $query = $query->where('customer_id',$request->customer_id);
        }


        if ($request->start_date) {
            $query  = $query->whereDate('created_at', '>=', $StartDate);
        }

        if ($request->end_date) {
            $query  = $query->whereDate('created_at', '<=', $EndDate);
        }


        if($pagination == 'all_data')
        {
            $pagination = $query->orderBy('id', 'DESC')->count();
        }else{
            $pagination = $pagination;
        }



        $data['collections'] =    $query->where('status',1)
                                        ->whereNull('deleted_at')
                                        ->orderBy('id','DESC')
                                        ->paginate($pagination);

        $data['totalamount']  =  $query->sum('amount');

        return view('backend.fee_management.fee_collection.ajax_index',$data);
    }



    

    



















    /**Get Student All Data */
    public function getWaiverStudentDataByStudentId(Request $request)
    {
        $student = Student::where('id',$request->student_id)
                ->where('activate_status',1)
                ->whereNull('deleted_at')
                ->first();
        if($student)
        {
            $class          = $student->classes?$student->classes->name:NULL;
            $session        = $student->sessiones?$student->sessiones->name:NULL;
            $batch_setting  = $student->batchsetting?$student->batchsetting->batch_name:NULL;
            $Class_type     = $student->studentype?$student->studentype->name:NULL;

            $classId        = $student->class_id;
            $sessionId      = $student->session_id;
            $batchSettingId = $student->batch_setting_id;
            $studentTypeId  = $student->student_type_id;
            $section_id     = $student->section_id;

            $user_id        = $student->user_id;

            $hidden =  '<input type="hidden" name="class_id" value="'.$classId.'"/>';
            $hidden .=  '<input type="hidden" name="session_id" value="'.$sessionId.'"/>';
            $hidden .=  '<input type="hidden" name="batch_setting_id" value="'.$batchSettingId.'"/>';
            $hidden .=  '<input type="hidden" name="student_type_id" value="'.$studentTypeId.'"/>';
            $hidden .=  '<input type="hidden" name="section_id" value="'.$section_id.'"/>';
            return response()->json([
                "status"        => true,
                "hidden"        => $hidden,
                "class"         => $class,
                "session"       => $session,
                "batch_setting" => $batch_setting,
                "Class_type"    => $Class_type,
                "user_id"       => $user_id,
            ]);
        }
        return response()->json([
            "status"        => false
        ]);
    }
    /**Get Student All Data */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /**----------------------------------------------------------------------------------*/
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
                                            ->where('fee_category_type_id',1)
                                            ->where('id',2)
                                            ->latest()
                                            ->get();

        $data['payment_methods'] = PaymentMethod::all();

        $data['months']         = Month::get();//where('status',1)->latest()->
        return view('backend.fee_management.fee_collection.create',$data);
    }


    /**get batch segging id by class,seeion,student id */
    public function getBatchSettingIdByClassSessionUserId(Request $request)
    {
        $user_id            = $request->user_id;
        $class_id           = $request->class_id;
        $session_id         = $request->session_id;

        $batch_ids    =  Student::where('user_id',$user_id)
                        ->where('class_id',$class_id)
                        ->where('session_id',$session_id)
                        ->where('activate_status',1)
                        ->whereNull('deleted_at')
                        ->pluck('batch_setting_id')
                        ->toArray();

        $batches = BatchSetting::where('status',1)
                        ->whereIn('id',$batch_ids)
                        ->latest()
                        ->get();

        $output = '<option value="">'.'Please Select One'.'</option>';
        foreach($batches as $data)
        {
            $output .='<option value="'.$data->id.'">'.$data->batch_name.'</option>';
        }
        //$output .= '</select>';
        return response()->json([
            'status'    => true,
            'data'      => $output
        ]);
    }
    /**get batch segging id by class,seeion,student id */



    /**get fee category amount by class,seeion,student id and others */
    public function getFeeCategoryAmount(Request $request)
    {
        $student_id         = $request->student_id;
        $class_id           = $request->class_id;
        $session_id         = $request->session_id;
        $batch_setting_id   = $request->batch_setting_id;
        $fee_cat_id         = $request->fee_cat_id;
        $batch_type_id      = $request->batch_type_id;
        $month_id           = $request->month_id;

        /**------------------------------------ */
        $session        = Sessiones::findOrfail($session_id);
        $sessionIdYear  = $session?$session->name:NULL;
        $month          = Month::findOrfail($month_id);
        $monthId        = $month?$month->name:NULL;

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

        if(in_array($month_id,$absentMonth))
        {
            return response()->json([
                'status' => false
            ]);
        }

        /**------------------------------------ */

        $data['feeSettings']  = FeeAmountSetting::where('class_id',$class_id)
                                ->where('session_id',$session_id)
                                ->where('fee_cat_id',$fee_cat_id)
                                ->where('batch_setting_id',$batch_setting_id)
                                ->where('batch_type_id',$batch_type_id)
                                ->where('status',1)
                                ->whereNull('deleted_at')
                                ->get();

        $data['student_id']         = $student?$student->id:NULL;
        $data['class_id']           = $class_id;
        $data['session_id']         = $session_id;
        $data['batch_setting_id']   = $batch_setting_id;
        $data['month_id']           = $month_id;
        $data['batch_type_id']      = $batch_type_id;

        if($startMonthId <= $month_id )//&& $admissionYear == $sessionIdYear
        {
            if($data['feeSettings'])
            {
                $html = view('backend.fee_management.fee_collection.ajax_fee_cat_list',$data)->render();
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



        StudentWaiver::where('student_id',$student_id)
                    ->where('class_id',$class_id)
                    ->where('session_id',$session_id)
                    ->where('batch_setting_id',$batch_setting_id)
                    ->where(function ($query) use ($month_id) {
                        $query->where('start_month_id', '>=', $month_id);
                        $query->where('end_month_id', '<=', $month_id);
                    })
                    ->where('batch_type_id',$batch_type_id)
                    ->where('activate_status',1)
                    ->whereNull('deleted_at')
                    ->first();

        $data['classes']        = Classes::where('status',1)->get();
        $data['sessiones']      = Sessiones::where('status',1)->get();
        $data['sectiones']      = Section::where('status',1)->get();
        $data['student_typies'] = StudentType::where('status',1)->get();
        $data['batch_settings'] = BatchSetting::where('status',1)->latest()->get();
        $data['fee_categories'] = FeeCategory::where('status',1)->latest()->get();
        $data['months']         = Month::get();//where('status',1)->latest()->

        $data['waivers']        = Waiver::where('status',1)->latest()->get();
        $data['waiverTypes']    = WaiverType::where('status',1)->latest()->get();
        return $request;
    }
    /**get fee category amount by class,seeion,student id and others */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $websetting = WebSetting::find(1);

        $validator = Validator::make($request->all(), [
            'student_id'        => 'required',
            'class_id'          => 'required',
            'session_id'        => 'required',
            'month_id'          => 'required',
            'fee_cat_id'        => 'required',
            'batch_setting_id'  => 'required',
            'batch_type_id'     => 'required',
            'amount.*'          => 'required',
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
            foreach($request->amount as $key => $amt)
            {
                if($amt == 'null' || $amt == null || $amt == NULL)continue;

                $this->invoice_no           = NULL;
                $this->reference_no         = 'MF'.date('Y').'P';
                $this->amount               = $amt;
                $this->student_id           = $request->student_id;
                $this->fee_cat_id           = $request->fee_cat_id;
                $this->user_id              = $request->user_id;
                $this->class_id             = $request->class_id;
                $this->session_id           = $request->session_id;
                $this->batch_setting_id     = $request->batch_setting_id;
                $this->batch_type_id        = $request->batch_type_id;
                $this->fee_amount_setting_id= $request->fee_setting_id[$key];
                $this->student_waiver_id    = $request->student_waiver_id[$key];
                $this->origin_id            = $request->month_id;
                $this->payment_method_id    = $request->payment_method_id;
                $this->transaction_id       = $request->transaction_id;
                $this->account_id           = NULL;
                $this->receive_date         = $request->created_at;
                $this->receivePayment();

            }
                if($request->student_id && $request->sms == "Yes"){

                            $findstudent = Student::find($request->student_id);

                            $nameofmonth = Month::find($request->month_id);

                            $session = Sessiones::where('id',$request->session_id)->first();

                            $data['message'] ="Dear Guardian,
Your son's/daughter's:". $findstudent->user->name .",ID No.:".$findstudent->user->useruid.", (".$findstudent->batchsetting->batch_name.") 'Monthly Tuition Fee' of ".$nameofmonth->name ."-".  $session->name ." has been Paid.
Thankfully
#".$websetting->site_name.".";

                                $finduser = User::where('id', $findstudent->user_id)->first();

                                $data['number']  = $finduser->mobile;



                                    $data['number'] = $findstudent->user->mobile;

                                    $smsJob = new MatchSendSms($data['number'], $data['message']);

                                    dispatch($smsJob);

                                    $smshistory = new SmsHistroy();
                                    $smshistory->user_id    = $findstudent->user_id;
                                    $smshistory->student_id = $findstudent->id;
                                    $smshistory->message    = $data['message'];
                                    $smshistory->status     = 1;
                                    $smshistory->save();



                    } /*sms end*/








            DB::commit();

            $notification = array(
                'message' => 'Fee Collection Successfully!',
                'alert-type' => 'success'
            );
                return redirect()->route('admin.fee-collection.index')->with($notification);

            }
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\FeeCollection  $feeCollection
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data['collection']  = PaymentHistory::findOrFail($id);
        return view('backend.fee_management.fee_collection.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\FeeCollection  $feeCollection
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeCollection $feeCollection,$id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\FeeCollection  $feeCollection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeeCollection $feeCollection,$id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\FeeCollection  $feeCollection
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentHistory $feeCollection,$id)
    {


      $data =   PaymentHistory::find($id);

      $data->delete();

       $notification = array(
                'message' => 'Data Deleted Successfully!',
                'alert-type' => 'success'
           );
       return redirect()->back()->with($notification);

    }



    /**monthly fee due list */
    public function monthlyFeeDueList(Request $request)
    {
        /**----------------------------------------------------------------------------------*/
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
                                            ->where('fee_category_type_id',1)
                                            ->where('id',2)
                                            ->latest()
                                            ->get();
        $data['months']         = Month::get();//where('status',1)->latest()->
        return view('backend.fee_management.due_list.monthly_fee',$data);
    }

    /**monthly fee due list */
    public function monthlyFeeDueListSearchResult(Request $request)
    {

        $data['class_id']          = $request->class_id;
        $data['session_id']        = $request->session_id;
        $data['batch_setting_id']  = $request->batch_setting_id;
        $data['batch_type_id']     = $request->batch_type_id;
        $data['fee_cat_id']        = $request->fee_cat_id;

        $student_id         = $request->student_id;
        $class_id           = $request->class_id;
        $session_id         = $request->session_id;
        $batch_setting_id   = $request->batch_setting_id;
        $fee_cat_id         = $request->fee_cat_id;
        $batch_type_id      = $request->batch_type_id;
        $month_id           = $request->month_id;

        /**------------------------------------ */
        $session        = Sessiones::findOrfail($session_id);
        $sessionIdYear  = $session?$session->name:NULL;
        $month          = Month::findOrfail($month_id);
        $monthId        = $month?$month->name:NULL;

        $data['students']    = Student::where('activate_status',1)
                        ->where('class_id',$class_id)
                        ->where('session_id',$session_id)
                        ->where('batch_setting_id',$batch_setting_id)
                        ->where('batch_type_id',$batch_type_id)
                        ->whereNull('deleted_at')
                        ->where(function ($query) use ($month_id) {
                            $query->where('start_month_id', '<=', $month_id);
                            //$query->where('end_month_id', '<=', $month_id);
                        })
                        ->get()
                        ->sortBy('user.name')
                        ->values();

        /* $startMonthId   = $student?$student->start_month_id:NULL;
        $admissionYear  = $student?$student->session_id:NULL;
        $userId         = $student?$student->user_id:NULL;

        $absentMonth    = [];
        $absent = AbsentStudent::where('student_id',$student_id)
                    ->where('class_id',$class_id)
                    ->where('session_id',$session_id)
                    ->where('batch_setting_id',$batch_setting_id)
                    ->where('status',1)
                    ->whereNull('deleted_at')
                    ->first(); */
        /* if($absent)
        {
            foreach ($absent->absentMonths as $key => $absn)
            {
                $absentMonth[$key] = $absn->month_id;
            }
        } */

       /*  if(in_array($month_id,$absentMonth))
        {
            return response()->json([
                'status' => false
            ]);
        } */

        /**------------------------------------ */

        /* $data['feeSettings']  = FeeAmountSetting::where('class_id',$class_id)
                                ->where('session_id',$session_id)
                                ->where('fee_cat_id',$fee_cat_id)
                                ->where('batch_setting_id',$batch_setting_id)
                                ->where('batch_type_id',$batch_type_id)
                                ->where('status',1)
                                ->whereNull('deleted_at')
                                ->get(); */


        $data['class_id']           = $class_id;
        $data['session_id']         = $session_id;
        $data['batch_setting_id']   = $batch_setting_id;
        $data['month_id']           = $month_id;
        $data['batch_type_id']      = $batch_type_id;
        $data['fee_cat_id']        = $request->fee_cat_id;

        $html = view('backend.fee_management.due_list.monthly_fee_ajax_student_list',$data)->render();
            return response()->json([
                'status' => true,
                'htmlData' => $html
            ]);


        if($startMonthId <= $month_id )//&& $admissionYear == $sessionIdYear
        {
            if($data['feeSettings'])
            {
                $html = view('backend.fee_management.fee_collection.ajax_fee_cat_list',$data)->render();
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



        return view('backend.fee_management.due_list.monthly_fee',$data);
    }







    function collectionexport(Request $request)
    {
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', 300); //6 minutes
        $input = $request->all();
        $allFeeId = [];
        if ($request->fee_id == null) {
            $data['collections'] = PaymentHistory::where('status', 1)->whereNull('deleted_at')->get();
            $data['totalamount']  =  $data['collections']->sum('amount');

        } else {
            if ($input['fee_id'] != '') {
                foreach ($input['fee_id'] as $key => $value) {
                    array_push($allFeeId, $input['fee_id'][$key]);
                }
            }
            ini_set('memory_limit', '2048M');

            $data['collections'] = PaymentHistory::whereIn('id',$allFeeId)->get();
            $data['totalamount']  =  $data['collections']->sum('amount');

        }


        if($request->has('excel')){
            return  Excel::download(new PaymentExport($data['collections']),'student_payments.xlsx');
        }
        elseif($request->has('pdf'))
        {
            $pdf = PDF::loadView('backend.fee_management.fee_collection.payment_export_pdf', $data);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download('Payment History.pdf');
        }

    }







     /*Due Paid */
     
     
     
    public function dueinvoicelist(Request $request)
    {


        $data['payment_methods'] = PaymentMethod::all();

         $pagination = $request->pagination;

         $query = PaymentHistory::query();


        if ($request->studentid) {
            
            $data['studentid'] = $request->studentid;
            
            
            $findusercount = User::where('useruid', $request->studentid)->count();

            if ($findusercount > 0) {
                $finduser = User::where('useruid', $request->studentid)->first();
                $query->where('user_id', $finduser->id);
            }

        }


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


        if($request->fee_cat_id) {
            $data['fee_cat_id']   = $request->fee_cat_id;
            $query->where('fee_cat_id', $request->fee_cat_id);
        }


        if($request->month_id) {
            $data['month_id']   = $request->month_id;
            $query->where('origin_id', $request->month_id);
        }



        $StartDate = Date('Y-m-d 00:00:00', strtotime($request->start_date));
        $EndDate   = Date('Y-m-d 23:59:59', strtotime($request->end_date));


        if ($request->customer_id) {
            $query = $query->where('customer_id',$request->customer_id);
        }


        if ($request->start_date) {
            $query  = $query->whereDate('created_at', '>=', $StartDate);
        }

        if ($request->end_date) {
            $query  = $query->whereDate('created_at', '<=', $EndDate);
        }


        if($pagination == 'all_data')
        {
            $pagination = $query->orderBy('id', 'DESC')->count();
        }else{
            $pagination = $pagination;
        }


        $data['collections'] =    $query->where('status',2)
                                        ->whereNull('deleted_at')
                                        ->orderBy('id','DESC')
                                        ->get();

        $data['totalamount']  =  $query->sum('amount');


        return view('backend.fee_management.fee_collection.due_invoice',$data);
    }




    public function dueinvoicestore(Request $request)
    {
        $websetting = WebSetting::find(1);
        
        
        $validator = Validator::make($request->all(), [
            'payment_method_id'        => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $payment = PaymentHistory::find($request->id);
        
        $payment->payment_method_id    = $request->payment_method_id;
        $payment->transaction_id       = $request->transaction_id;
        $payment->receive_date         = $request->created_at;
        $payment->status               = 1;
        $payment->save();



        if($payment->student_id){

                    $findstudent = Student::find($payment->student_id);
                    $nameofmonth = Month::find($payment->origin_id);

                    $session = Sessiones::where('id',$payment->session_id)->first();

                    $data['message'] ="Dear Guardian,
Your son's/daughter's:". $findstudent->user->name .",ID No.:".$findstudent->user->useruid.", (".$findstudent->batchsetting->batch_name.") 'Monthly Tuition Fee' of ".$nameofmonth->name ."-".  $session->name ." has been Paid.
Thankfully
#".$websetting->site_name.".";

                        $finduser = User::where('id', $findstudent->user_id)->first();

                        $data['number']  = $finduser->mobile;



                            $data['number'] = $findstudent->user->mobile;

                            $smsJob = new MatchSendSms($data['number'], $data['message']);

                            dispatch($smsJob);

                            $smshistory = new SmsHistroy();
                            $smshistory->user_id    = $findstudent->user_id;
                            $smshistory->student_id = $findstudent->id;
                            $smshistory->message    = $data['message'];
                            $smshistory->status     = 1;
                            $smshistory->save();



            }


        $notification = array(
                'message' => 'Payment Successfully Completed!',
                'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



        
        
    public function verify_pending(Request $request)
     {
        
        $websetting = WebSetting::find(1);

        $data['payment_methods'] = PaymentMethod::all();

         $pagination = $request->pagination;

         $query = PaymentHistory::query();


        if ($request->student_id) {
            $data['student_id'] = $request->student_id;
            $findusercount = User::where('id', $request->student_id)->count();

            if ($findusercount > 0) {
                $finduser = User::where('id', $request->student_id)->first();
                $query->where('user_id', $finduser->id);
            }

        }


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


        if($request->fee_cat_id) {
            $data['fee_cat_id']   = $request->fee_cat_id;
            $query->where('fee_cat_id', $request->fee_cat_id);
        }


        if($request->month_id) {
            $data['month_id']   = $request->month_id;
            $query->where('origin_id', $request->month_id);
        }



        $StartDate = Date('Y-m-d 00:00:00', strtotime($request->start_date));
        $EndDate   = Date('Y-m-d 23:59:59', strtotime($request->end_date));


    

        if ($request->start_date) {
            $query  = $query->whereDate('created_at', '>=', $StartDate);
        }

        if ($request->end_date) {
            $query  = $query->whereDate('created_at', '<=', $EndDate);
        }


        if($pagination == 'all_data')
        {
            $pagination = $query->orderBy('id', 'DESC')->count();
        }else{
            $pagination = $pagination;
        }


        $data['collections'] =    $query->where('status',3)
                                        ->whereNull('deleted_at')
                                        ->orderBy('id','DESC')
                                        ->get();

        $data['totalamount']  =  $query->sum('amount');


        return view('backend.fee_management.fee_collection.verify_pending',$data);
    }





    public function paymentverify($id)
    {
        
        $websetting = WebSetting::find(1);
        $payment = PaymentHistory::find($id);
        $payment->status = 1;
        $payment->save();
        
        
        if($payment->student_id){

                    $findstudent = Student::find($payment->student_id);
                    $nameofmonth = Month::find($payment->origin_id);

                    $session = Sessiones::where('id',$payment->session_id)->first();

                    $data['message'] ="Dear Guardian,
Your son's/daughter's:". $findstudent->user->name .",ID No.:".$findstudent->user->useruid.", (".$findstudent->batchsetting->batch_name.") 'Monthly Tuition Fee' of ".$nameofmonth->name ."-".  $session->name ." has been Paid.
Thankfully
#".$websetting->site_name.".";

                        $finduser = User::where('id', $findstudent->user_id)->first();

                        $data['number']  = $finduser->mobile;



                            $data['number'] = $findstudent->user->mobile;

                            $smsJob = new MatchSendSms($data['number'], $data['message']);

                            dispatch($smsJob);

                            $smshistory = new SmsHistroy();
                            $smshistory->user_id    = $findstudent->user_id;
                            $smshistory->student_id = $findstudent->id;
                            $smshistory->message    = $data['message'];
                            $smshistory->status     = 1;
                            $smshistory->save();



        }
        
        $notification = array(
                'message' => 'Payment Paid Successfully Completed!',
                'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    
    
    public function paymentunpaid($id)
    {
        $payment = PaymentHistory::find($id);
        $payment->status = 2;
        $payment->save();
        
        $notification = array(
                'message' => 'Payment Unpaid Successfully Completed!',
                'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }

















}
