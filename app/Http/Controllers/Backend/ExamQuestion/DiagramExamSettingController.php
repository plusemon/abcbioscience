<?php

namespace App\Http\Controllers\Backend\ExamQuestion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ExamSetting;
use App\Models\Sessiones;
use App\Models\Classes;
use App\Models\Subject;
use App\Model\PayTime;
use App\Model\BatchType;
use App\Models\DiagramQuestion;
use App\Models\DiagramExamResult;
use App\Model\FeeAmountSetting;
use App\Models\BatchSetting;
use App\Model\FeeCategory;
use App\Model\StudentQuestionSetting;
use DB;
use Validator;
use Auth;


class DiagramExamSettingController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


                /*though it is not using, but maybe will be uses */
        $data['classes']            = Classes::whereStatus(1)->get();
        $data['sessiones']          = Sessiones::whereStatus(1)->get();
        /*though it is not using, but maybe will be uses */
        $data['subjects']   = Subject::all();

        $query  = ExamSetting::query();


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
            $query = $query->where('subject_id',$request->subject_id);
        }




        $data['questions'] = $query->whereNull('deleted_at')->where('fee_cat_id',7)->latest()->paginate(100);
        return view('backend.questions.diagram_question_setting.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       /*though it is not using, but maybe will be uses */
       $data['classes']            = Classes::where('status',1)->get();
       $data['sessiones']          = Sessiones::where('status',1)->get();
       /*though it is not using, but maybe will be uses */

       $data['batchTypies']        = BatchType::where('status',1)->get();
       $data['payTimes']           = PayTime::where('status',1)->get();


       $writSubjectQestion = DiagramQuestion::find($request->qid);
       $data['subjectName']             = $writSubjectQestion?$writSubjectQestion->subject?$writSubjectQestion->subject->name:NULL:NULL;
       $data['subjectQuestionName']     = $writSubjectQestion?$writSubjectQestion->question_no:NULL;

       $data['question_subject_id']    = $request->qid;
       $data['subject_id']             = $writSubjectQestion?$writSubjectQestion->subject_id:NULL;
       $data['class_id']                   = $writSubjectQestion?$writSubjectQestion->class_id:NULL;
       $data['className']                  = $writSubjectQestion?$writSubjectQestion->classes?$writSubjectQestion->classes->name:NULL:NULL;
       $data['session_id']                 = $writSubjectQestion?$writSubjectQestion->session_id:NULL;
       $data['sessionName']                = $writSubjectQestion?$writSubjectQestion->sessiones?$writSubjectQestion->sessiones->name:NULL:NULL;
       $data['examination_type_id']        = $writSubjectQestion?$writSubjectQestion->examination_type_id:NULL;
       $data['ExamTypeName']               = $writSubjectQestion?$writSubjectQestion->examtypies?$writSubjectQestion->examtypies->name:NULL:NULL;

       /**Batch Setting by class and session id */
       $data['batches'] = BatchSetting::where('status',1)
               ->where('sessiones_id',$data['session_id'])
               ->where('classes_id',$data['class_id'])
               ->latest()
               ->get();
       /**Batch Setting by class and session id */
       $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
                               ->where('fee_category_type_id',2)
                               ->whereIn('id',[7])
                               ->where('status',1)
                               //->latest()
                               ->get();

       $data['examination_type_id']        = $writSubjectQestion?$writSubjectQestion->examination_type_id:NULL;
       return view('backend.questions.diagram_question_setting.create',$data);
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
            'class_id'          => 'required',
            'session_id'        => 'required',
            'batch_setting_id'  => 'required',
            'batch_type_id'     => 'required',
            'examination_type_id' => 'required',
            'subject_id'        => 'required',
            'question_subject_id'  => 'required',
            'exam_start_date_time'   => 'required',
            'exam_end_date_time'     => 'required',
            'duration'   => 'required',
            'fee_cat_id'   => 'required',
            'pay_time_id'       => 'required',
            'amount'            => 'required',

            //'activate_status'   => $request->previous_admitted == "" ?'required':'nullable',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();
        try
        {
            $exist = ExamSetting::where('fee_cat_id',$request->fee_cat_id)
                    ->where('class_id',$request->class_id)
                    ->where('session_id',$request->session_id)
                    ->where('batch_type_id',$request->batch_type_id)
                    ->where('batch_setting_id',$request->batch_setting_id)
                    ->where('examination_type_id',$request->examination_type_id)
                    ->where('subject_id',$request->subject_id)
                    ->where('question_subject_id',$request->question_subject_id)
                    //->where('pay_time_id',$request->pay_time_id)
                    ->where('exam_status',1)
                    ->where('status',1)
                    ->first();
            if($exist)
            {
                $notification = array(
                    'message' => 'Already Inserted,Please try another fields!',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);
            }




            $examSetting = new ExamSetting();
            $examSetting->fee_cat_id           = $request->fee_cat_id;
            $examSetting->batch_setting_id     = $request->batch_setting_id;
            $examSetting->batch_type_id        = $request->batch_type_id;
            $examSetting->class_id             = $request->class_id;
            $examSetting->session_id           = $request->session_id;
            $examSetting->examination_type_id  = $request->examination_type_id;
            $examSetting->subject_id           = $request->subject_id;
            $examSetting->question_subject_id  = $request->question_subject_id;
            $examSetting->exam_start_date_time= $request->exam_start_date_time;
            $examSetting->exam_end_date_time  = $request->exam_end_date_time;
            $examSetting->duration            = $request->duration;
            $examSetting->exam_status          = 1;
            $examSetting->question_type        = 1;
            $examSetting->status               = 1;
            $examSetting->created_by           = Auth::user()->id;
            $examSetting->save();

            $data = new FeeAmountSetting();
            $data->fee_cat_id           = $request->fee_cat_id;
            $data->class_id             = $request->class_id;
            $data->session_id           = $request->session_id;
            $data->batch_type_id        = $request->batch_type_id;
            $data->batch_setting_id     = $request->batch_setting_id;
            $data->pay_time_id          = $request->pay_time_id;
            $data->amount               = $request->amount;
            $data->origin_id            = $examSetting->id;
            $data->created_by           = Auth::user()->id;
            $data->status               = 1;
            $data->save();

            DB::commit();
            $notification = array(
                'message' => 'Mcq Question Setting Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.diagram-setting.index')->with($notification);
        }
        catch(\Exception $e) {
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
     * @param  \App\Model\WrittenExamSetting  $writtenExamSetting
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    public function edit(Request $request, $id)
    {
        /*though it is not using, but maybe will be uses */
        $data['classes']            = Classes::where('status', 1)->get();
        $data['sessiones']          = Sessiones::where('status', 1)->get();
        /*though it is not using, but maybe will be uses */

        $data['batchTypies']        = BatchType::where('status', 1)->get();
        $data['payTimes']           = PayTime::where('status', 1)->get();



        $writSubjectQestion = DiagramQuestion::findOrFail($request->qid);
        $data['subjectName']             = $writSubjectQestion ? $writSubjectQestion->subject ? $writSubjectQestion->subject->name : NULL : NULL;
        $data['subjectQuestionName']     = $writSubjectQestion ? $writSubjectQestion->question_no : NULL;

        $data['question_subject_id']    = $request->qid;
        $data['subject_id']             = $writSubjectQestion ? $writSubjectQestion->subject_id : NULL;
        $data['class_id']                   = $writSubjectQestion ? $writSubjectQestion->class_id : NULL;
        $data['className']                  = $writSubjectQestion ? $writSubjectQestion->classes ? $writSubjectQestion->classes->name : NULL : NULL;
        $data['session_id']                 = $writSubjectQestion ? $writSubjectQestion->session_id : NULL;
        $data['sessionName']                = $writSubjectQestion ? $writSubjectQestion->sessiones ? $writSubjectQestion->sessiones->name : NULL : NULL;
        $data['examination_type_id']        = $writSubjectQestion ? $writSubjectQestion->examination_type_id : NULL;
        $data['ExamTypeName']               = $writSubjectQestion ? $writSubjectQestion->examtypies ? $writSubjectQestion->examtypies->name : NULL : NULL;

        /**Batch Setting by class and session id */
        $data['batches'] = BatchSetting::where('status', 1)
            ->where('sessiones_id', $data['session_id'])
            ->where('classes_id', $data['class_id'])
            ->latest()
            ->get();
        /**Batch Setting by class and session id */
        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
            ->where('fee_category_type_id', 2)
            ->whereIn('id', [7])
            ->where('status', 1)
            //->latest()
            ->get();

        $data['examination_type_id']        = $writSubjectQestion ? $writSubjectQestion->examination_type_id : NULL;

        // return
        $data['setting'] = ExamSetting::findOrFail($id);
        return view('backend.questions.diagram_question_setting.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'batch_setting_id'  => 'required',
            'batch_type_id'     => 'required',
            'exam_start_date_time'   => 'required',
            'exam_end_date_time'     => 'required',
            'duration'   => 'required',
            'fee_cat_id'           => 'required',

            'pay_time_id'       => 'required',
            'amount'            => 'required',

        ]);

        DB::transaction(function () use ($request,$id){


            $total_exam_time = ((strtotime($request->exam_end_time) - strtotime($request->exam_start_time)) / 60);

            $setting = ExamSetting::findOrFail($id);
            $setting->batch_setting_id= $request->batch_setting_id;
            $setting->batch_type_id   = $request->batch_type_id;
            $setting->exam_start_date_time= $request->exam_start_date_time;
            $setting->exam_end_date_time  = $request->exam_end_date_time;
            $setting->duration            = $request->duration;
            $setting->fee_cat_id      = $request->fee_cat_id;
            $setting->save();

            $fee_setting = $setting->amounts;
            $fee_setting->amount = $request->amount;
            $fee_setting->pay_time_id = $request->pay_time_id;
            $fee_setting->save();
        });

        $notification = array(
            'message' => 'Question Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.diagram-setting.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\WrittenExamSetting  $writtenExamSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



        $findexamsettingcount       = ExamSetting::where('id',$id)->where('fee_cat_id',7)->count();


        if($findexamsettingcount>0)
        {

             $findexamsetting  = ExamSetting::where('id',$id)->where('fee_cat_id',7)->first();

             $feeamountcount = FeeAmountSetting::where('fee_cat_id',7)->where('origin_id',$id)->count();

             $findstudentmcqsetting = StudentQuestionSetting::where('exam_setting_id',$id)->where('fee_cat_id',7)->count();


            if($feeamountcount>0)
            {
                FeeAmountSetting::where('fee_cat_id',4)->where('origin_id',$id)->delete();
            }

            if($findstudentmcqsetting>0)
            {
                StudentQuestionSetting::where('exam_setting_id',$id)->where('fee_cat_id',7)->delete();
            }

            DiagramExamResult::where('exam_setting_id',$findexamsetting->id)->delete();

            $findexamsetting->delete();
        }



        $notification = array(
            'message' => 'Successfully updated',
            'alert-type' => 'success'
        );
        return back()->with($notification);



    }
}
