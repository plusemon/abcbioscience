<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Sessiones;
use App\Models\Section;
use App\Models\BatchSetting;
use App\Models\Subject;
use App\Models\ExamType;
use App\User;
use App\Model\McqQuestion;
class McqQuestionSubject extends Model
{
	public function mcqQuestions()
	{
		return $this->hasMany(McqQuestion::class,'mcq_subject_id','id')->whereNull('deleted_at');
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

	public  function  subjects()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }

	public  function  examtypies()
    {
        return $this->belongsTo(ExamType::class,'examination_type_id','id');
    }
}
