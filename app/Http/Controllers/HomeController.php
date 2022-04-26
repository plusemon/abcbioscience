<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use App\Model\PaymentHistory;
use App\Models\BatchSetting;
use App\Models\Sheet;
use App\Model\McqQuestionSubject;
use App\Models\WrittenQuestion;
use App\Models\Contact;
use App\User;
 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
 
        $data['totalstudent'] =Student::where('activate_status',1)->count();
        $data['todayattendance'] =Attendance::wheredate('attendance_date',Date('Y-m-d'))->sum('total_present');
        $data['totalpaymentreceive'] =  PaymentHistory::where('status',1)->whereNull('deleted_at')->sum('amount');
        $data['todaytotalpaymentreceive'] =PaymentHistory::wheredate('receive_date',Date('Y-m-d'))->where('status',1)->whereNull('deleted_at')->sum('amount');

        $data['totalsheet']             = Sheet::count();
        $data['totalmcqquestion']       = McqQuestionSubject::count();
        $data['totalwrittenquestion']   = WrittenQuestion::count();
        $data['contacts']   = Contact::count();
        $data['batchlist']   = BatchSetting::count();
    
        $data['pendingstudents'] = Student::where('activate_status',3)->count();
        
          
        $data['studentusers'] = User::where('role_id',3)->orderBy('name', 'ASC')->get();


        return view('backend.dashboard',$data);
    }
}
