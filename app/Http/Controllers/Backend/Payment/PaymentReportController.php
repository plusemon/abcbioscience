<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sessiones;
use App\Models\Classes;
use App\User;
use Auth;
use App\Models\BatchSetting;
use App\Models\Student;

class PaymentReportController extends Controller
{
    
	public function paidreports(Request $request)
	{
		$query = Student::query();
		
        if($request->class_id)
        {
            $data['class_id']   = $request->class_id;
            $query              = $query->where('class_id',$request->class_id);
        }

        if($request->session_id)
        {
            $data['session_id'] = $request->session_id;
            $query              = $query->where('session_id',$request->session_id);
        }

        if($request->batch_setting_id)
        {
            $data['batch_setting_id']   = $request->batch_setting_id;
            $query                      = $query->where('batch_setting_id',$request->batch_setting_id);
        }

        if($request->month_id)
        {
            $data['month_id']   = $request->month_id;
            $query              = $query->where('month_id',$request->month_id);
        }
        if($request->student_type_id)
        {

            $data['student_type_id']    = $request->student_type_id;
            $query                      = $query->where('student_type_id',$request->student_type_id);
        }

        $data['allstudents'] = $query->orderBy('id','DESC')->where('activate_status',1)->get();
 

		return view('backend.account.payments.paidreports',$data);
	}


	public function unpaidreports(Request $request)
	{
		$query = Student::query();
        if($request->class_id)
        {
            $data['class_id']   = $request->class_id;
            $query              = $query->where('class_id',$request->class_id);
        }

        if($request->session_id)
        {
            $data['session_id'] = $request->session_id;
            $query              = $query->where('session_id',$request->session_id);
        }

        if($request->batch_setting_id)
        {
            $data['batch_setting_id']   = $request->batch_setting_id;
            $query                      = $query->where('batch_setting_id',$request->batch_setting_id);
        }

        if($request->month_id)
        {
            $data['month_id']   = $request->month_id;
            $query              = $query->where('month_id',$request->month_id);
        }
        if($request->student_type_id)
        {

            $data['student_type_id']    = $request->student_type_id;
            $query                      = $query->where('student_type_id',$request->student_type_id);
        }

        $data['allstudents'] = $query->orderBy('id','DESC')->where('activate_status',1)->get();

      
		return view('backend.account.payments.unpaidreports',$data);
	}


	public function allreports(Request $request)
	{
		$query = Student::query();
        if($request->class_id)
        {
            $data['class_id']   = $request->class_id;
            $query              = $query->where('class_id',$request->class_id);
        }

        if($request->session_id)
        {
            $data['session_id'] = $request->session_id;
            $query              = $query->where('session_id',$request->session_id);
        }

        if($request->batch_setting_id)
        {
            $data['batch_setting_id']   = $request->batch_setting_id;
            $query                      = $query->where('batch_setting_id',$request->batch_setting_id);
        }

        if($request->month_id)
        {
            $data['month_id']   = $request->month_id;
            $query              = $query->where('month_id',$request->month_id);
        }
        if($request->student_type_id)
        {

            $data['student_type_id']    = $request->student_type_id;
            $query                      = $query->where('student_type_id',$request->student_type_id);
        }

        $data['allstudents'] = $query->orderBy('id','DESC')->where('activate_status',1)->get();

 
		return view('backend.account.payments.allreports',$data);
	}








}
