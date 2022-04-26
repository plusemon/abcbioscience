<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Sessiones;
use App\Models\Section;
use App\Models\BatchSetting;
use App\Model\BatchType;
use App\Models\Subject;
use App\Models\ExamType;
use App\User;
use App\Model\McqQuestionOption;
use App\Model\McqQuestionSubject;
use App\Model\FeeCategory;
use App\Model\FeeAmountSetting;
use App\Model\ExamSetting;
class StudentQuestionSetting extends Model
{
    public function feeCategores()
    {
        return $this->belongsTo(FeeCategory::class,'fee_cat_id','id');
    }

    public function mcqQuestionSubjects()
	{
        return $this->belongsTo(McqQuestionSubject::class,'question_subject_id','id')->whereNull('deleted_at');
	}

    public function amounts()
	{
        return $this->hasOne(FeeAmountSetting::class,'origin_id','id')
        ->whereNull('deleted_at')
        ->where('fee_cat_id',$this->fee_cat_id)
        ->where('batch_setting_id',$this->batch_setting_id)
        ->where('batch_type_id',$this->batch_type_id)
        ->where('class_id',$this->class_id)
        ->where('session_id',$this->session_id);
	}

    public function options()
    {
        return $this->hasMany(McqQuestionOption::class,'mcq_question_id','id')->whereNull('deleted_at');
    }
    public function classes()
	{
		return $this->belongsTo(Classes::class,'class_id','id');
	}

	public function sessiones()
	{
		return $this->belongsTo(Sessiones::class,'session_id','id');
	}
	public function sections()
	{
		return $this->belongsTo(Section::class,'section_id','id');
	}

	public function batchsetting()
	{
		return $this->belongsTo(BatchSetting::class,'batch_setting_id','id');
	}
	public function batchTypies()
	{
		return $this->belongsTo(BatchType::class,'batch_type_id','id');
	}

	public  function subjects()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }

	public  function  examtypies()
    {
        return $this->belongsTo(ExamType::class,'examination_type_id','id');
    }

	public  function  examSettings()
    {
        return $this->belongsTo(ExamSetting::class,'exam_setting_id','id');
    }

}
