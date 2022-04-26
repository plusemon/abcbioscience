<?php

namespace App\Traits;

    use App\Model\McqExamStudentAnsSummary;
    use Auth;
    use Validator;
    use DB;

    trait McqExamStudentAnswerSummary
    {

        protected $class_id;
        protected $session_id;
        protected $student_id;
        protected $batch_setting_id;
        protected $batch_type_id;
        protected $question_subject_id;
        protected $examination_type_id;
        protected $exam_setting_id;
        protected $subject_id;
        protected $status;

        
        public function insertStudentInTblMacExamStudentAnsSurrary()
        {
            if($this->existStudentData())
            {   
                $this->existStudentData()->created_by = 8;
                $this->existStudentData()->save();
                $ustatus = McqExamStudentAnsSummary::find($this->existStudentData()->id);
                if($ustatus->status == 1 || $ustatus->status == '1')
                {
                    $ustatus->status = NULL;
                }else{
                    $ustatus->status = 1;
                }
                $ustatus->save();
                return true;
            }else{
                $mcqSummary = new McqExamStudentAnsSummary();
                $mcqSummary->class_id               = $this->class_id;
                $mcqSummary->session_id             = $this->session_id;
                $mcqSummary->student_id             = $this->student_id;
                $mcqSummary->batch_setting_id       = $this->batch_setting_id;
                $mcqSummary->batch_type_id          = $this->batch_type_id;
                $mcqSummary->mcq_question_subject_id = $this->question_subject_id;
                $mcqSummary->examination_type_id    = $this->examination_type_id;
                $mcqSummary->mcq_exam_setting_id    = $this->exam_setting_id;
                $mcqSummary->mcq_subject_id         = $this->subject_id;
                $mcqSummary->status                 = $this->status;
                $mcqSummary->created_by             = Auth::user()->id;
                $mcqSummary->save();
                return $mcqSummary;
            }
        }

        public function existStudentData()
        {
            return  McqExamStudentAnsSummary::whereNull('deleted_at')
            ->where('class_id',$this->class_id)
            ->where('session_id',$this->session_id)
            ->where('student_id',$this->student_id)
            ->where('batch_setting_id',$this->batch_setting_id)
            ->where('batch_type_id',$this->batch_type_id)
            ->where('mcq_question_subject_id',$this->question_subject_id)
            ->where('examination_type_id',$this->examination_type_id)
            ->where('mcq_exam_setting_id',$this->exam_setting_id)
            ->where('mcq_subject_id',$this->subject_id)
            //->where('status',1)
            ->first();
        }
    }
