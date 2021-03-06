<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\BatchSetting;
use DB;
use App\Models\Notice;
use App\Models\Sheet;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\BlogCategory;
use App\Models\Sessiones;
use App\Models\Classes;
use App\About;
use App\Models\OldQuestion;
use App\Models\Subject;
use App\Models\Year;
use App\Models\ExamType;
use App\Models\BoardQuestionType;
use App\Model\FeeAmountSetting;
use App\Models\Student;
use App\Model\ExamSetting;
use App\Model\SheetSetting;
use Auth;
use Validator;
use App\Model\FeeCollectionMain;
use App\Model\PaymentHistory;

class FrontendController extends Controller
{
    
	public function index()
	{
	 

		$data['sheetsetting']  = SheetSetting::where('taken_by',1)->get();




		$data['sliders'] 		= Slider::where('status',1)->get();

		if(Auth::check()){

			
		$data['BatchSettings']  = BatchSetting::where('status',1)->where('classes_id',Auth::user()->class_id)->limit(6)->get();

		}
		else{
			$data['BatchSettings']  = BatchSetting::where('status',10)->limit(6)->get();
		}


		$data['notices']  		= Notice::where('status',1)->get();
		$data['blogs']  		= Blog::where('status',1)->get();

		return view('frontend.pages.index',$data);
	}




	public function about()
	{
		$data['about'] = About::find(2);
		return view('frontend.pages.about',$data);
	}


	public function boardquestiones(Request $request)
	{

        $data['years'] = Year::all();
        $data['exams'] = ExamType::all();
        $data['board_questions'] = BoardQuestionType::all();
        $data['classs'] = Classes::all();
        $data['subjects'] = Subject::all();

		$query = OldQuestion::query();


		if($request->type_id)
		{
			$data['type_id']  = $request->type_id;
			$query = $query->where('board_question_type_id',$request->type_id);
		}

		if($request->year_id)
		{
			$data['year_id'] = $request->year_id;
			$query = $query->where('year_id',$request->year_id);
 		}

 		if($request->subject_id)
 		{
 			$data['subject_id'] = $request->subject_id;
 			$query = $query->where('subject_id',$request->subject_id);
 		}


		$data['boardquestiones'] =  $query->where('question_type_id',2)->latest()->paginate(20);

		return view('frontend.pages.boardquestiones',$data);
	}





	public function schoolquestiones(Request $request)
	{
		
        $data['years'] = Year::all();
        $data['exams'] = ExamType::all();
        $data['board_questions'] = BoardQuestionType::all();
        $data['classs'] = Classes::all();
        $data['subjects'] = Subject::all();

		$query = OldQuestion::query();


		if($request->type)
		{
			$data['type']  = $request->type;
			$query = $query->where('board_question_type_id',$request->type);
		}

		if($request->year)
		{
			$data['year'] = $request->year;
			$query = $query->where('year_id',$request->year);
 		}

 		if($request->subject)
 		{
 			$data['subject_id'] = $request->subject_id;
 			$query = $query->where('subject_id',$request->subject_id);
 		}


		$data['schoolquestiones'] =  $query->where('question_type_id',1)->latest()->paginate(20);

		return view('frontend.pages.schoolquestiones',$data);


	}	
	
	
	public function collegequestiones(Request $request)
	{
		
        $data['years'] = Year::all();
        $data['exams'] = ExamType::all();
        $data['board_questions'] = BoardQuestionType::all();
        $data['classs'] = Classes::all();
        $data['subjects'] = Subject::all();

		$query = OldQuestion::query();


		if($request->type)
		{
			$data['type']  = $request->type;
			$query = $query->where('board_question_type_id',$request->type);
		}

		if($request->year)
		{
			$data['year'] = $request->year;
			$query = $query->where('year_id',$request->year);
 		}

 		if($request->subject)
 		{
 			$data['subject_id'] = $request->subject_id;
 			$query = $query->where('subject_id',$request->subject_id);
 		}


		$data['schoolquestiones'] =  $query->where('question_type_id',3)->latest()->paginate(20);

		return view('frontend.pages.college_question',$data);


	}



 
	public function lecturesheet()
	{
		
		$data['sheetsetting']  = SheetSetting::where('taken_by',1)->get();

		return view('frontend.pages.lecturesheet',$data);	
	}


	public function lecturesheetdetail($id)
	{

		$data['sheetsetting'] = SheetSetting::find($id);

		return view('frontend.pages.lecturesheetdetail',$data);	
	}

 

	public function mcqexam()
	{

		$startDate  = date('d-m-Y');
        $endDate    = date('d-m-Y');
        $start      = date("Y-m-d",strtotime($startDate));
        $end        = date("Y-m-d",strtotime($endDate."+1 day"));     
		
		if(Auth::check()){

			 
  
	    $batch_setting_id = Auth::user()->activestudents?Auth::user()->activestudents->pluck('batch_setting_id')->toArray():NULL;
        $batch_type_id = Auth::user()->activestudents?Auth::user()->activestudents->pluck('batch_type_id')->toArray():NULL;
        $data['latestExams'] = ExamSetting::withCount('checkExamCompletedOrNot')
                                    //->having('check_exam_completed_or_not_count',0)
                                    ->where('fee_cat_id',4)
                                    ->where('exam_start_date','>', date('Y-m-d'))
                                    ->whereIn('batch_setting_id',$batch_setting_id)
                                    ->whereIn('batch_type_id',$batch_type_id)
                                    ->latest()
                                    ->get();
      
                        
        $data['currentExams'] = ExamSetting::withCount('checkExamCompletedOrNot')
                                //->having('check_exam_completed_or_not_count',0)
                                ->where('fee_cat_id',4)
                                ->whereIn('batch_setting_id',$batch_setting_id)
                                ->whereIn('batch_type_id',$batch_type_id)
                                ->whereBetween('exam_start_date',[$start,$end])
                                ->orderBy('id','DESC')
                                ->get();

        $data['oldestExams'] = ExamSetting::withCount('checkExamCompletedOrNot')
                                //->having('check_exam_completed_or_not_count', '>', 0)
                                ->where('fee_cat_id',4)
                                ->whereIn('batch_setting_id',$batch_setting_id)
                                ->whereIn('batch_type_id',$batch_type_id)
                                ->latest()
                                ->get();


        }
        else{
        	$data['currentExams'] = ExamSetting::where('fee_cat_id',4)
                                ->whereBetween('exam_start_date',[$start,$end])
                                ->orderBy('id','DESC')
                                ->get();
        }




		return view('frontend.pages.mcqexam',$data);	
	}



	public function mcqexam_detail()
	{

		return view('frontend.pages.mcqexam_detail');
	}


	public function mcqexam_start()
	{

		return view('frontend.pages.mcqexam_start');
	}




	public function mcqexam_question()
	{
		return view('frontend.pages.mcq_question');
	}


	public function mcqexam_resultsummery()
	{
		return view('frontend.pages.mcqexam_start');
	}


	public function mcqexam_result_show()
	{
		return view('frontend.pages.mcqexam_result_show');
	}




 

	public function writtenexam()
	{
		$data['writtenexames'] = [];

		return view('frontend.pages.writtenexam',$data);	
	}


 	
 	public function writtenexam_detail()
	{
		return view('frontend.pages.writtenexam_detail');
	}

	public function writtenexam_start()
	{
		return view('frontend.pages.writtenexam_start');
	}


 



	public function writtenexam_question()
	{
		return view('frontend.pages.mcqexam_start');
	}


	public function writtenexam_resultsummery()
	{
		return view('frontend.pages.mcqexam_start');
	}


	public function writtenexam_result_show()
	{
		return view('frontend.pages.mcqexam_start');
	}


 








	public function allbatch(Request $request)
	{

		$data['classes'] 	= Classes::all();
		$data['sessiones']  = Sessiones::all();

 		
 		$query  = BatchSetting::query();


 		if($request->classes_id)
 		{
 			$data['classes_id']  = $request->classes_id; 
 			$query  = $query->where('classes_id',$request->classes_id);
 		}

 		if($request->sessiones_id)
 		{
 			$data['sessiones_id']  = $request->sessiones_id; 
 			$query  = $query->where('sessiones_id',$request->sessiones_id);
 		}

 		if(Auth::check()){
 
		$data['BatchSettings'] =  $query->where('status',1)->where('classes_id',Auth::user()->class_id)->latest()->get();

		}
		else{
			$data['BatchSettings'] =  $query->where('status',10)->latest()->get();
		}
		return view('frontend.pages.allbatch',$data);
	}





	/*for batch details */

	public function batchenroll($id)
	{



		$data['batchsetting']  = BatchSetting::find($id);

 
		$data['batch_fee'] = FeeAmountSetting::where('fee_cat_id',1)->where('batch_setting_id',$id)->first();

 


		return view('frontend.pages.batchenroll',$data);
	}






	public function batch_admission(Request $request)
	{	


			if(!Auth::check()){

				$notification = array(
	                'message' => 'Please Login First!',
	                'alert-type' => 'warning'
	            );
	            return redirect()->route('student.login')->with($notification);
			}

			else{


 


			$findbatchsetting  = BatchSetting::find($request->batch_setting_id);




			$exist = Student::where('user_id',Auth::user()->id)
											->where('class_id',$findbatchsetting->classes_id)
											->where('session_id',$findbatchsetting->sessiones_id)
											->where('batch_setting_id',$findbatchsetting->id)
											->count();



 		     if($exist)
            {
                $notification = array(
                    'message' => 'Already Admission,Please try another Batch!',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);
            }				


			$student = New Student();
            $student->user_id           = Auth::user()->id;
            $student->class_id          = $findbatchsetting->classes_id;
            $student->session_id	    = $findbatchsetting->sessiones_id;
            $student->batch_setting_id  = $findbatchsetting->id;
            $student->batch_type_id     = 1;
            $student->admission_date    = Date('Y-m-d');
            $student->student_type_id   = 2;
            $student->start_month_id    = Date('m');
            $student->activate_status   = 3;
            $student->status   = 2;
            $student->save();
 

            $notification = array(
                'message' => 'Student Enroll Successfully Completed!',
                'alert-type' => 'success'
            );
            return redirect()->route('student.dashboard')->with($notification);


			} //auth check 

	}







 




	/*for blogs*/


	public function blogs()
	{
		$data['blogs'] = Blog::latest()->get();
		return view('frontend.pages.blogs',$data);
	}

	public function blogdetail($slug)
	{
		$data['categories'] = BlogCategory::all();

		$data['blogs'] = Blog::latest()->limit(6)->whereNotIn('slug',[$slug])->get();

		$data['blog'] = Blog::where('slug',$slug)->first();

		return view('frontend.pages.blogdetail',$data);
 	}






	/*for notices */

	public function notices()
	{
		$data['notices'] = Notice::latest()->paginate(2);
		return view('frontend.pages.notices',$data);
	}

	public function noticedetail($slug)
	{
		$data['notice'] = Notice::where('slug',$slug)->first();
		return view('frontend.pages.noticedetail',$data);
	}




	public function contact()
	{
		return view('frontend.pages.contact');
	}



	public function contactstore(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'mobile' => 'required',
           'email' => 'required',
           'subject' => 'required',
           'message' => 'required',
        ]);

        $contacts = new Contact();
        $contacts->name    = $request->name;
        $contacts->mobile  =  $request->mobile;
        $contacts->email   =  $request->email;
        $contacts->subject =  $request->subject;
        $contacts->message =  $request->message;
        $contacts->status  =  1;
        $contacts->save();

        $notification = array(
            'message' => 'Message Send Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('frontend')->with($notification);
    }






}
