<?php

namespace App\Http\Controllers\Backend\Question\McqQuestion;


use App\Models\Day;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\ExamType;
use App\Models\Sessiones;
use App\Model\FeeCategory;
use App\Model\McqQuestion;
use App\Models\StudentType;
use Illuminate\Http\Request;
use App\Model\McqQuestionOption;
use App\Model\McqQuestionSubject;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Model\McqExamStudentAnsSummary;
use App\Model\McqExamStudentAnswer;
use App\Model\ExamSetting;
use App\Model\FeeAmountSetting;
use App\Model\StudentQuestionSetting;

class McqQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();

        $data['subjects']       = Subject::all();


        return view('backend.questions.mcq_question.index', $data);
    }






    public function ajax_index(Request $request)
    {

        $pagination = $request->pagination;

        $query  = McqQuestionSubject::query();

        if ($request->class_id) {
            $data['class_id']   = $request->class_id;
            $query = $query->where('class_id', $request->class_id);
        }

        if ($request->session_id) {
            $data['session_id'] = $request->session_id;
            $query = $query->where('session_id', $request->session_id);
        }

        if ($request->subject_id) {
            $data['subject_id'] = $request->subject_id;
            $query = $query->where('subject_id', $request->subject_id);
        }


        if ($request->chapter_id) {
            $data['chapter_id'] = $request->chapter_id;
            $query              = $query->where('chapter_id', $request->chapter_id);
        }


        if ($pagination == 'all_data') {
            $pagination = $query->orderBy('id', 'DESC')->count();
        } else {
            $pagination = $pagination;
        }


        $data['questions'] = $query->whereNull('deleted_at')->latest()->paginate($pagination);


        return view('backend.questions.mcq_question.ajax_index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
        $data['sectiones']      = Section::all();
        $data['batches']        = Batch::all();
        $data['classtypes']     = StudentType::all();
        $data['daies']          = Day::all();
        $data['examTypies']     = ExamType::all();
        $data['subjects']       = Subject::all();

        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')->where('status', 1)->latest()->get();
        return view('backend.questions.mcq_question.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            // ajax check for answers
            $check_answers = collect($request->get('question'))->map(function ($item, $index) {
                return in_array(true, (array) request()->get($index . '_answer'));
            })->toArray();
            if (in_array(false, $check_answers)) {
                return response([
                    'success' => false,
                    'message' => 'Please check the answers again.',
                ]);
            } else {
                return response([
                    'success' => true,
                    'saved' => true,
                    'message' => 'Mcq Question created Successfully Added!',
                    'redirect' => route('admin.mcq.index'),
                ]);
            }
        }

        $input  = $request->all();

        $request->validate([
            'class_id'          => 'required',
            'session_id'        => 'required',
            'question_no'       => 'required',
            'subject_id'        => 'required',
            'question.*'        => 'required',
            //'batch_setting_id'  => 'required',
            //'section_id'        => 'required',

            //'activate_status'   => $request->previous_admitted == "" ?'required':'nullable',
        ]);

        $subject = new McqQuestionSubject();
        $subject->class_id              = $request->class_id;
        $subject->session_id            = $request->session_id;
        $subject->subject_id            = $request->subject_id;
        $subject->chapter_id            = $request->chapter_id;
        $subject->topic                 = $request->topic;
        $subject->examination_type_id   = $request->examination_type_id;
        $subject->question_no           = $request->question_no;
        $subject->created_by            = Auth::user()->id;
        $subject->status                = 1;
        $subject->save();

        foreach ($request->question as $key => $qus) {
            $mcqQ =  new McqQuestion();
            $mcqQ->class_id         = $request->class_id;
            $mcqQ->session_id       = $request->session_id;
            $mcqQ->mcq_subject_id   = $subject->id;
            $mcqQ->question         = $qus;
            $mcqQ->describe         = $request->describe[$key];

            if (!empty($input['image'][$key])) {
                $image = $input['image'][$key];

                if ($image) {
                    $uniqname = uniqid();
                    $ext = strtolower($image->getClientOriginalExtension());
                    $filepath = 'public/images/questions/';
                    $imagename = $filepath . $uniqname . '.' . $ext;
                    $image->move($filepath, $imagename);
                    $mcqQ->image  = $imagename;
                }
            }


            $mcqQ->created_by       = Auth::user()->id;
            $mcqQ->status           = 1;
            $mcqQ->save();
            // dd($mcqQ);

            foreach ($request->input($key . '_pattern') as $index => $patt) {
                $mcqQOpt =  new McqQuestionOption();
                $mcqQOpt->mcq_subject_id    = $subject->id;
                $mcqQOpt->mcq_question_id   = $mcqQ->id;
                $mcqQOpt->pattern           = $patt;
                $mcqQOpt->option            = $request->input($key . '_option')[$index];
                $mcqQOpt->answer            = $request->input($key . '_answer')[$index];
                $mcqQOpt->created_by        = Auth::user()->id;
                $mcqQOpt->status            = 1;
                $mcqQOpt->save();
            }
        } //end main foreach




        // return
        //     response([
        //         'success' => true,
        //         'saved' => true,
        //         'message' => 'Mcq Question created Successfully Added!',
        //         'redirect' => route('admin.mcq.index'),
        //     ]);


        $notification = array(
            'message' => 'Mcq Question created Successfully Added!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.mcq.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\McqQuestionSubject  $mcqQuestionSubject
     * @return \Illuminate\Http\Response
     */
    public function show(McqQuestionSubject $mcqQuestionSubject)
    {
        // return 'got you';
        $data['question'] = $mcqQuestionSubject;
        return view('backend.questions.mcq_question.show', $data);
    }




    public function exam(McqQuestionSubject $mcqQuestionSubject)
    {
        $examTotalTime  =   "30:00";
        $examStarTime   =   strtotime("10:00 pm");
        $nowTime        =   time();
        $examEndTime    =   strtotime("10:30 pm");
        $remainingTime  =   $examEndTime - $nowTime;
        $data['remaingTime'] = number_format(($remainingTime / 60), 2, ':', '');
        $data['question'] = $mcqQuestionSubject;
        return view('backend.questions.mcq_exam.create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\McqQuestionSubject  $mcqQuestionSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(McqQuestionSubject $mcqQuestionSubject)
    {
        $data['question'] = $mcqQuestionSubject->load('mcqQuestions');

        if (request()->ajax()) {
            return view('backend.questions.mcq_question.edit-ajax', $data);
        }

        return view('backend.questions.mcq_question.edit', $data);
    }


    public function update(Request $request, McqQuestion $mcqQuestion)
    {
        $request->validate([
            'question' => 'required',
            'pattern.*' => 'required',
            'option.*' => 'required',
            'answer.*' => 'required',
        ]);

        // custom validation for correct ans check
        if (!in_array(true, $request->answer)) {
            $notification = array(
                'message' => 'At laest one correct ans required',
                'alert-type' => 'info'
            );
            return back()->with($notification);
        }

        $mcqQuestion->question = $request->question;
        // THIS FOR THE DESCRIBE 
        $mcqQuestion->describe = $request->describe;

        if ($request->has('image')) {
            $uniqname = uniqid();
            $ext = strtolower($request->image->getClientOriginalExtension());
            $filepath = 'public/images/questions/';
            $imagename = $filepath . $uniqname . '.' . $ext;
            $request->image->move($filepath, $imagename);

            $mcqQuestion->image = $imagename;
        }
        $mcqQuestion->save();



        // DB::transaction(function () use ($mcqQuestion) {

        //     McqQuestionOption::destroy($mcqQuestion->options->pluck('id'));

        //     foreach (request('pattern') as $key => $item) {
        //         $option = new McqQuestionOption();
        //         $option->mcq_question_id   = $mcqQuestion->id;
        //         $option->mcq_subject_id    = $mcqQuestion->mcq_subject_id;
        //         $option->pattern = request('pattern')[$key];
        //         $option->option = request('option')[$key];
        //         $option->answer = request('answer')[$key];
        //         $option->created_by = Auth::id();
        //         $option->status = 1;
        //         $option->save();
        //     }
        // });

        DB::transaction(function () use ($mcqQuestion, $request) {

            $mcqQuestion->question = $request->question;
            $mcqQuestion->describe = $request->describe;
            $mcqQuestion->save();

            // remove deleted items
            $remove_ids =  $mcqQuestion->options->except($request->option_ids)->pluck('id');
            if (count($remove_ids)) {
                McqQuestionOption::destroy($remove_ids);
            }

            $currect_opt_id = optional($mcqQuestion->options)->where('answer', 1)->first()->id;

            // update existing or create new options
            foreach ($request->option_ids as $index => $id) {
                if ($id == 'new') {
                    // create new onw
                    $option = new McqQuestionOption();
                    $option->mcq_question_id   = $mcqQuestion->id;
                    $option->mcq_subject_id    = $mcqQuestion->mcq_subject_id;
                    $option->created_by = Auth::id();
                    $option->status = 1;
                } else {
                    $option = McqQuestionOption::find($id);
                }

                $option->pattern = request('pattern')[$index];
                $option->option = request('option')[$index];
                $option->answer = request('answer')[$index];
                $option->save();
            }

            $now_opt_id = $mcqQuestion->refresh()->options->where('answer', 1)->first()->id;

            if ($currect_opt_id == $now_opt_id) {
                // return 'no need to update result';
            } else {
                // return 'currect ans has been changed please update neccessery data';

                foreach ($mcqQuestion->submissions as $ans) {
                    $ans->correct_option_id = $now_opt_id;
                    if ($now_opt_id  == $ans->given_option_id) {
                        $ans->result = 1;
                    } else {
                        $ans->result = 0;
                    }

                    $ans->save();
                }
            }
        });


        $notification = array(
            'message' => 'Question updated succesfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\McqQuestionSubject  $mcqQuestionSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $findmcq = McqQuestionSubject::find($id);


        $findexamsettingcount       = ExamSetting::where('question_subject_id', $id)->where('fee_cat_id', 4)->count();


        if ($findexamsettingcount > 0) {

            $findexamsetting       = ExamSetting::where('question_subject_id', $id)->where('fee_cat_id', 4)->first();

            $mcqanssummery = McqExamStudentAnsSummary::where('mcq_question_subject_id', $id)->where('mcq_exam_setting_id', $findexamsetting->id)->first();
            $mcqanssummeryans = McqExamStudentAnswer::where('mcq_question_subject_id', $id)->where('mcq_exam_setting_id', $findexamsetting->id)->count();

            $feeamountcount = FeeAmountSetting::where('fee_cat_id', 4)->where('origin_id', $findexamsetting->id)->count();

            $findstudentmcqsetting = StudentQuestionSetting::where('exam_setting_id', $findexamsetting->id)->where('fee_cat_id', 4)->count();


            if ($feeamountcount > 0) {
                FeeAmountSetting::where('fee_cat_id', 4)->where('origin_id', $findexamsetting->id)->delete();
            }


            if ($mcqanssummeryans > 0) {
                McqExamStudentAnswer::where('mcq_question_subject_id', $id)->where('mcq_exam_setting_id', $findexamsetting->id)->delete();
                McqExamStudentAnsSummary::where('mcq_question_subject_id', $id)->where('mcq_exam_setting_id', $findexamsetting->id)->delete();
            }


            if ($findstudentmcqsetting > 0) {
                StudentQuestionSetting::where('exam_setting_id', $findexamsetting->id)->where('fee_cat_id', 4)->delete();
            }


            ExamSetting::where('question_subject_id', $id)->where('fee_cat_id', 4)->delete();
        }



        McqQuestionOption::where('mcq_subject_id', $id)->delete();
        McqQuestion::where('mcq_subject_id', $id)->delete();



        McqQuestionSubject::find($id)->delete();



        // rollback if any function can't do the action
        // DB::transaction(function () use ($McqQuestionSubject) {

        // get each mcqQuestionSubject mcqQuestion
        // foreach ($McqQuestionSubject->mcqQuestions as $mcqQuestion) {
        // get mcqQuestions
        //   foreach ($mcqQuestion->options as $option) {
        // delete options
        //       $option->delete();
        //}
        // delete mcqQuestion
        //     $mcqQuestion->delete();
        // }

        // Delete McqQuestionSubjectSettings & Answers
        //   foreach ($McqQuestionSubject->mcqQuestionSubjectExamSettings as $settings) {
        //  foreach ($settings->mcqQuestionSettingAns as $ans) {
        //      foreach ($ans->mcqExamStudentAns as $ansOptions) {
        // Delete UserAnsSummeryOptions
        //      $ansOptions->delete();
        //   }
        // Delete UserAnsSummery
        //   $ans->delete();
        //   }
        // Delete examSetting
        //  $settings->delete();
        //  }
        // Finally the the question.
        //     $McqQuestionSubject->delete();
        //  });

        $notification = array(
            'message' => 'Question has been deleted',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }



    public function mcqQuestionDelete($id)
    {

        McqQuestionOption::where('mcq_question_id', $id)->delete();
        McqQuestion::where('id', $id)->delete();

        $notification = array(
            'message' => 'Question has been deleted',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }



    public function imageDelete(Request $request, McqQuestion $mcqQuestion)
    {
        // return $mcqQuestion;

        if (File::exists($mcqQuestion->image)) {
            unlink($mcqQuestion->image);
        }
        $mcqQuestion->image = null;
        $mcqQuestion->save();

        $notification = array(
            'message' => 'Image removed',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }


    public function addOption(Request $request, McqQuestionSubject $McqQuestionSubject)
    {

        $request->validate([
            'question' => 'required',
            'pattern.*' => 'required',
            'option.*' => 'required',
            'answer.*' => 'required',
        ]);

        // custom validation for correct ans check
        if (!in_array(true, $request->answer)) {
            return response(array(
                'success' => false,
                'message' => 'At laest one correct ans required',
                'alert-type' => 'info'
            ));
        }

        DB::transaction(function () use ($request, $McqQuestionSubject) {
            $question = new McqQuestion();
            $question->mcq_subject_id = $McqQuestionSubject->id;
            $question->class_id = $McqQuestionSubject->class_id;
            $question->session_id = $McqQuestionSubject->session_id;
            $question->batch_setting_id = $McqQuestionSubject->batch_setting_id;
            $question->section_id = $McqQuestionSubject->section_id;
            $question->describe = $request->describe;
            $question->question = $request->question;
            $question->created_by = Auth::id();
            $question->status = 1;

            if ($request->has('image')) {
                $uniqname = uniqid();
                $ext = strtolower($request->image->getClientOriginalExtension());
                $filepath = 'public/images/questions/';
                $imagename = $filepath . $uniqname . '.' . $ext;
                $request->image->move($filepath, $imagename);

                $question->image = $imagename;
            }
            $question->save();

            foreach ($request->pattern as $key => $item) {
                $option = new McqQuestionOption();
                $option->mcq_question_id = $question->id;
                $option->mcq_subject_id = $question->mcq_subject_id;
                $option->pattern = $request->pattern[$key];
                $option->option = $request->option[$key];
                $option->answer = $request->answer[$key];
                $option->created_by = Auth::id();
                $option->status = 1;
                $option->save();
            }
        });


        if ($request->ajax()) {
            return response([
                'success' => true,
                'message' => 'New question has been added',
            ]);
        }


        // return $option;

        $notification = array(
            'message' => 'New question has been added',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
