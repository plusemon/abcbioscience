<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use DB;
use Validator;
use Auth;
use App\User;
use App\Models\StudentInfo;
use App\Models\BatchSetting;
use App\Model\PaymentHistory;
use App\Model\SheetSetting;
use App\Models\AttendanceDetail;
use App\Models\Attendance;
use App\Models\HomeWork;
use App\Models\HomeWorkDetail;

class StudentController extends Controller
{



	public function batchlist()
	{

		$data['students'] = Student::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
		return view('students.batchlist',$data);

	}



	public function batch_detail($id)
	{
		$data['student'] = Student::where('batch_setting_id',$id)->first();
		$data['setting'] = BatchSetting::where('id',$id)->first();
		return view('students.batch_detail',$data);

	}




	public function paymenthistory()
	{
		$data['paymenthistories']  = PaymentHistory::where('user_id', Auth::user()->id)
                                                        ->orderBy('id','DESC')
                                                        ->get();
		return view('students.paymenthistory',$data);
	}


    public function makepayment(Request $request)
    {
        
        $request->validate([
            'payment_method_id' => 'required',
            'transaction_id'    => 'required' 
        ]);
        
        $payment = PaymentHistory::find($request->id);
        
        $payment->payment_method_id    = $request->payment_method_id;
        $payment->transaction_id       = $request->transaction_id;
        $payment->receive_date         = Date('Y-m-d h:i:s');
        $payment->status               = 3;
        $payment->save();
        
        $notification = array(
                'message' => 'Payment Successfully Completed!',
                'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



	public function studentsheetavailable()
	{

		$totalbatch = Student::where('user_id',Auth::user()->id)->get();

		$batch = [];
		foreach ($totalbatch as $value) {
			array_push($batch, $value->batch_setting_id);
		}

		$data['sheetsetting'] = SheetSetting::whereIn('batch_setting_id',$batch)
		->whereDate('publish_date','<=',Date('Y-m-d'))
		->latest()
		->get();

		return view('students.student_sheet',$data);
	}



    
    public function attendance_pending()
    {

        return view('students.attendances.pending');
    }



    public function attendance_pending_ajax()
    {
        $studentids = optional(auth()->user()->students)->pluck('id');

        $data['pending'] = AttendanceDetail::whereIn('student_id',$studentids)
                                        ->where('status',0)
                                        ->orderBy('id','DESC')
                                        ->get();

        return view('students.attendances.pending_ajax',$data,compact('studentids',$studentids));
    }












    public function attendance_history()
    {
    	$studentids = optional(auth()->user()->students)->pluck('id');

    	$data['attendance_details'] = AttendanceDetail::whereIn('student_id',$studentids)
    														->whereIn('status',[0,1])
                                                            ->orderBy('id','DESC')
    														->get();
        
        return view('students.attendances.history',$data);
    }



    public function attendance_present(Request $request)
    {


    	$detail = AttendanceDetail::find($request->attendance_detail_id);


    	$detail->attendance = "Present";
    	$detail->status =1;

    	$detail->save();
    	
    	$findattend = Attendance::find($detail->attendance_id);
    	$findattend->total_present = $findattend->total_present+1;
    	$findattend->total_absent  =  $findattend->total_absent-1;
    	$findattend->save();



    	$notification = array(
                'message' => 'You are present now!',
                'alert-type' => 'success'
         );

        return redirect()->route('student.attendance.history')->with($notification);
    }








 


    public function homework_pending()
    {

    	$studentids = optional(auth()->user()->students)->pluck('id');

        $data['pending'] = HomeWorkDetail::whereIn('student_id',$studentids)
                                        ->where('status',0)
                                        ->orderBy('id','DESC')
                                        ->get();

        return view('students.homeworks.pending',$data,compact('studentids',$studentids));
    }


    public function homework_history()
    {
    	$studentids = optional(auth()->user()->students)->pluck('id');

        $data['pending'] = HomeWorkDetail::whereIn('student_id',$studentids)
                                        ->where('status',1)
                                        ->orderBy('id','DESC')
                                        ->get();

        return view('students.homeworks.submitted',$data,compact('studentids',$studentids));
    }





    public function homework_submitted(Request $request)
    {


    	$detail = HomeWorkDetail::find($request->homework_detail_id);
    	 
    	$detail->status =1;

    	$detail->save();

        $fb_link  = $detail->mainhomework->classes->fb_link;

 

    	$notification = array(
                'message' => 'You are home work submitted!',
                'alert-type' => 'success'
         );

        return redirect($detail->mainhomework->classes?$detail->mainhomework->classes->fb_link:'')->with($notification);
    }



  /*  Home work   */


 

}
