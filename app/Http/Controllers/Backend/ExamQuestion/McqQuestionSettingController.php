<?php

namespace App\Http\Controllers\Backend\ExamQuestion;

use App\Http\Controllers\Controller;
use App\Model\McqExamSetting;
use App\Model\ExamSetting;
use Illuminate\Http\Request;


use App\Model\FeeAmountSetting;
use App\Model\FeeSetting;

use App\Model\FeeCategory;
use App\Model\FeeActionType;

use App\Models\Section;
use App\Models\Sessiones;
use App\Models\Classes;
use App\Models\Batch;

use App\Model\McqQuestionSubject;
use App\Model\PayTime;
use App\Model\BatchType;
use App\Models\BatchSetting;
use App\Models\StudentType;
use App\Models\Subject;
use DB;
use Validator;
use Auth;
use App\Model\McqExamStudentAnsSummary;
use App\Model\McqExamStudentAnswer;
use App\Model\StudentQuestionSetting;

class McqQuestionSettingController extends Controller
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
            $query                = $query->where('subject_id',$request->subject_id);
        }  


        $data['questions'] = $query->whereNull('deleted_at')->where('fee_cat_id',4)->latest()->paginate(30);


        return view('backend.questions.mcq_question_setting.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /*though it is not using, but maybe will be uses */
        $data['classes']            = Classes::whereStatus(1)->get();
        $data['sessiones']          = Sessiones::whereStatus(1)->get();
        /*though it is not using, but maybe will be uses */

        $data['batchTypies']        = BatchType::whereStatus(1)->get();
        $data['payTimes']           = PayTime::whereStatus(1)->get();


        $mcqSubjectQes = McqQuestionSubject::find($request->qid);
        $data['mcqSubjectName']             = $mcqSubjectQes ? $mcqSubjectQes->subjects ? $mcqSubjectQes->subjects->name : NULL : NULL;
        $data['mcqSubjectQuestionName']     = $mcqSubjectQes ? $mcqSubjectQes->question_no : NULL;

        $data['mcq_question_subject_id']    = $request->qid;
        $data['mcq_subject_id']             = $mcqSubjectQes ? $mcqSubjectQes->subject_id : NULL;
        $data['class_id']                   = $mcqSubjectQes ? $mcqSubjectQes->class_id : NULL;
        $data['className']                  = $mcqSubjectQes ? $mcqSubjectQes->classes ? $mcqSubjectQes->classes->name : NULL : NULL;
        $data['session_id']                 = $mcqSubjectQes ? $mcqSubjectQes->session_id : NULL;
        $data['sessionName']                = $mcqSubjectQes ? $mcqSubjectQes->sessiones ? $mcqSubjectQes->sessiones->name : NULL : NULL;
        $data['examination_type_id']        = $mcqSubjectQes ? $mcqSubjectQes->examination_type_id : NULL;
        $data['ExamTypeName']               = $mcqSubjectQes ? $mcqSubjectQes->examtypies ? $mcqSubjectQes->examtypies->name : NULL : NULL;

        /**Batch Setting by class and session id */
        $data['batches'] = BatchSetting::whereStatus(1)
            ->where('sessiones_id', $data['session_id'])
            ->where('classes_id', $data['class_id'])
            ->latest()
            ->get();
        /**Batch Setting by class and session id */
        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
            ->where('fee_category_type_id', 2)
            ->whereIn('id', [4])
            ->whereStatus(1)
            //->latest()
            ->get();

        $data['examination_type_id']        = $mcqSubjectQes ? $mcqSubjectQes->examination_type_id : NULL;
        return view('backend.questions.mcq_question_setting.create', $data);
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
            'examination_type_id'  => 'required',
            'mcq_subject_id'    => 'required',
            'mcq_question_subject_id'  => 'required',
            'exam_start_date_time'   => 'required',
            'exam_end_date_time'     => 'required',
            'duration'   => 'required',
            'result_view'   => 'required',
            'fee_cat_id'   => 'required',
            'pay_time_id'       => 'required',
            'amount'            => 'required',

            //'activate_status'   => $request->previous_admitted == "" ?'required':'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $exist = ExamSetting::where('fee_cat_id', $request->fee_cat_id)
                ->where('class_id', $request->class_id)
                ->where('session_id', $request->session_id)
                ->where('batch_type_id', $request->batch_type_id)
                ->where('batch_setting_id', $request->batch_setting_id)
                ->where('examination_type_id', $request->examination_type_id)
                ->where('subject_id', $request->mcq_subject_id)
                ->where('question_subject_id', $request->mcq_question_subject_id)
                //->where('pay_time_id',$request->pay_time_id)
                ->where('exam_status', 1)
                ->whereStatus(1)
                ->first();
            if ($exist) {
                $notification = array(
                    'message' => 'Already Inserted,Please try another fields!',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);
            }

 

            $mcqExSetting = new ExamSetting();
            $mcqExSetting->fee_cat_id           = $request->fee_cat_id;
            $mcqExSetting->batch_setting_id     = $request->batch_setting_id;
            $mcqExSetting->batch_type_id        = $request->batch_type_id;
            $mcqExSetting->class_id             = $request->class_id;
            $mcqExSetting->session_id           = $request->session_id;
            $mcqExSetting->examination_type_id  = $request->examination_type_id;
            $mcqExSetting->subject_id           = $request->mcq_subject_id;
            $mcqExSetting->question_subject_id  = $request->mcq_question_subject_id;
            $mcqExSetting->exam_start_date_time = $request->exam_start_date_time;
            $mcqExSetting->exam_end_date_time   = $request->exam_end_date_time;
            $mcqExSetting->duration             = $request->duration;
            $mcqExSetting->result_view          = $request->result_view; /** 1 for instant 2 for delay **/
            $mcqExSetting->exam_status          = 1;
            $mcqExSetting->question_type        = 1; /*1 for only for batch 2 for all student */
            $mcqExSetting->status               = 1;
            $mcqExSetting->created_by           = Auth::user()->id;
            $mcqExSetting->save();


            $data = new FeeAmountSetting();
            $data->fee_cat_id           = $request->fee_cat_id;
            $data->class_id             = $request->class_id;
            $data->session_id           = $request->session_id;
            $data->batch_type_id        = $request->batch_type_id;
            $data->batch_setting_id     = $request->batch_setting_id;
            $data->pay_time_id          = $request->pay_time_id;
            $data->amount               = $request->amount;
            $data->origin_id            = $mcqExSetting->id;
            $data->created_by           = Auth::user()->id;
            $data->status               = 1;
            $data->save();

            DB::commit();
            $notification = array(
                'message' => 'Mcq Question Setting Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.mcq-setting.index')->with($notification);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\McqExamSetting  $mcqExamSetting
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {


        $data['mcqexamsetting']  = ExamSetting::where('question_subject_id', $id)->first();

        $data['mcqexamamount']  = FeeAmountSetting::where('origin_id', $data['mcqexamsetting']->id)->first();

        return view('backend.questions.mcq_question_setting.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\McqExamSetting  $mcqExamSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamSetting $ExamSetting, Request $request, $id)
    {

        /*though it is not using, but maybe will be uses */
        $data['classes']            = Classes::where('status', 1)->get();
        $data['sessiones']          = Sessiones::where('status', 1)->get();
        /*though it is not using, but maybe will be uses */

        $data['batchTypies']        = BatchType::where('status', 1)->get();
        $data['payTimes']           = PayTime::where('status', 1)->get();

        $examSet                            = $data['examSet'] = ExamSetting::find($id);
        $data['paytime_id'] = FeeAmountSetting::where('origin_id', $examSet->id)->first()->pay_time_id;

        $mcqSubjectQes                      = McqQuestionSubject::find($examSet ? $examSet->question_subject_id : NULL);
        $data['mcqSubjectName']             = $mcqSubjectQes ? $mcqSubjectQes->subjects ? $mcqSubjectQes->subjects->name : NULL : NULL;
        $data['mcqSubjectQuestionName']     = $mcqSubjectQes ? $mcqSubjectQes->question_no : NULL;

        $data['mcq_question_subject_id']    = $request->qid;
        $data['mcq_subject_id']             = $mcqSubjectQes ? $mcqSubjectQes->subject_id : NULL;
        $data['class_id']                   = $mcqSubjectQes ? $mcqSubjectQes->class_id : NULL;
        $data['className']                  = $mcqSubjectQes ? $mcqSubjectQes->classes ? $mcqSubjectQes->classes->name : NULL : NULL;
        $data['session_id']                 = $mcqSubjectQes ? $mcqSubjectQes->session_id : NULL;
        $data['sessionName']                = $mcqSubjectQes ? $mcqSubjectQes->sessiones ? $mcqSubjectQes->sessiones->name : NULL : NULL;
        $data['examination_type_id']        = $mcqSubjectQes ? $mcqSubjectQes->examination_type_id : NULL;
        $data['ExamTypeName']               = $mcqSubjectQes ? $mcqSubjectQes->examtypies ? $mcqSubjectQes->examtypies->name : NULL : NULL;

        $data['batchSettingName']           = $examSet ? $examSet->batchsetting ? $examSet->batchsetting->batch_name : NULL : NULL;
        $data['batchSettingId']             = $examSet ? $examSet->batch_setting_id : NULL;

        $data['batchTypeName']              = $examSet ? $examSet->batchTypies ? $examSet->batchTypies->name : NULL : NULL;
        $data['batchTypeId']                = $examSet ? $examSet->batch_type_id : NULL;

        $data['question']                  = $examSet;


        /**Batch Setting by class and session id */
        $data['batches'] = BatchSetting::where('status', 1)
            ->where('sessiones_id', $data['session_id'])
            ->where('classes_id', $data['class_id'])
            ->latest()
            ->get();
        /**Batch Setting by class and session id */
        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
            ->where('fee_category_type_id', 2)
            ->where('status', 1)
            //->latest()
            ->get();

        $data['examination_type_id']        = $mcqSubjectQes ? $mcqSubjectQes->examination_type_id : NULL;

        //    return $data;

        return view('backend.questions.mcq_question_setting.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\McqExamSetting  $mcqExamSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamSetting $mcqSetting)
    {

        $setting = $mcqSetting;

        // Exam Setting Table Data
        $setting->batch_setting_id = $request->batch_setting_id;
        $setting->batch_type_id = $request->batch_type_id;
        $setting->exam_start_date_time= $request->exam_start_date_time;
        $setting->exam_end_date_time  = $request->exam_end_date_time;
        $setting->duration            = $request->duration;
        $setting->result_view         = $request->result_view;
        $setting->save();

        $feeSet =  FeeAmountSetting::where('origin_id', $setting->id)->first();
        $feeSet->pay_time_id = $request->pay_time_id;
        $feeSet->amount = $request->amount;
        $feeSet->save();


        $notification = array(
            'message' => 'Successfully updated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\McqExamSetting  $mcqExamSetting
     * @return \Illuminate\Http\Response
     */
      public function destroy(McqExamSetting $mcqExamSetting,$id)
    {   
           



        $findexamsettingcount       = ExamSetting::where('id',$id)->where('fee_cat_id',4)->count();
 
 
        if($findexamsettingcount>0)
        {

             $findexamsetting  = ExamSetting::where('id',$id)->where('fee_cat_id',4)->first();

             $mcqanssummery = McqExamStudentAnsSummary::where('mcq_question_subject_id',$id)->where('mcq_exam_setting_id',$id)->first();
             $mcqanssummeryans = McqExamStudentAnswer::where('mcq_question_subject_id',$id)->where('mcq_exam_setting_id',$id)->count();

             $feeamountcount = FeeAmountSetting::where('fee_cat_id',4)->where('origin_id',$id)->count();
         
             $findstudentmcqsetting = StudentQuestionSetting::where('exam_setting_id',$id)->where('fee_cat_id',4)->count();


            if($feeamountcount>0)
            {
                FeeAmountSetting::where('fee_cat_id',4)->where('origin_id',$id)->delete();
            }


            if($mcqanssummeryans>0)
            {
                McqExamStudentAnswer::where('mcq_question_subject_id',$id)->where('mcq_exam_setting_id',$id)->delete();
                McqExamStudentAnsSummary::where('mcq_question_subject_id',$id)->where('mcq_exam_setting_id',$id)->delete();
            }


            if($findstudentmcqsetting>0)
            {
                StudentQuestionSetting::where('exam_setting_id',$id)->where('fee_cat_id',4)->delete();
            }


            ExamSetting::where('id',$id)->where('fee_cat_id',4)->delete();
        }
        



        $notification = array(
            'message' => 'Successfully updated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
 
    }
}
