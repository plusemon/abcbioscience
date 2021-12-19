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
use App\Model\McqExamStudentAnsSummary;
use App\Model\ExamSetting;
use App\Models\HomeWorkDetail;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  
        $data['batchlist'] = optional(auth()->user()->activestudents)->pluck('batch_setting_id');
        $student_id = optional(auth()->user()->activestudents)->pluck('id');

        $data['pending_attendances']  = AttendanceDetail::whereIn('student_id',$student_id)->where('attendance','Absent')->count();        

        $data['attendances']  = AttendanceDetail::whereIn('student_id',$student_id)->where('attendance','Present')->count();

        $data['paymenthistories'] = PaymentHistory::whereIn('student_id',$student_id)->sum('amount');
 



        $data['mcq_upcomming'] = ExamSetting::whereIn('batch_setting_id',$data['batchlist'])
                                ->where('fee_cat_id', 4)
                                ->whereDate('exam_start_date_time', '<=', today())
                                ->whereDate('exam_end_date_time', '>=', today())
                                ->count();
 
        $data['mcq_results'] = McqExamStudentAnsSummary::whereIn('batch_setting_id',$data['batchlist'])
                                ->whereIn('student_id',$student_id)
                                ->latest()
                                ->count();

        $data['written_upcomming'] = ExamSetting::whereIn('batch_setting_id',$data['batchlist'])
                                    ->where('fee_cat_id', 5)
                                    ->whereDate('exam_start_date_time', '<=', today())
                                    ->whereDate('exam_end_date_time', '>=', today())
                                    ->count();


       $data['written_results'] = ExamSetting::whereIn('batch_setting_id',$data['batchlist'])
                                    ->where('fee_cat_id', 5)
                                    ->whereDate('exam_end_date_time', '<=', today())
                                    ->count();

        
        $data['homework_pending'] = HomeWorkDetail::whereIn('student_id',$student_id)
                                        ->where('status',0)
                                        ->orderBy('id','DESC')
                                        ->count();

        $data['homework_results'] = HomeWorkDetail::whereIn('student_id',$student_id)
                                        ->where('status',1)
                                        ->orderBy('id','DESC')
                                        ->count();


        $data['sheetsetting'] = SheetSetting::whereIn('batch_setting_id',$data['batchlist'])
                                        ->whereDate('publish_date','<=',Date('Y-m-d'))
                                        ->latest()
                                        ->count();



        return view('students.dashboard',$data);
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
