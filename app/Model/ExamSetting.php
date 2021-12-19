<?php

namespace App\Model;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Model\BatchType;
use App\Models\ExamType;
use App\Models\Sessiones;
use App\Model\FeeCategory;
use App\Models\BatchSetting;
use App\Model\FeeAmountSetting;
use App\Models\WrittenQuestion;
use App\Model\McqQuestionOption;
use App\Model\McqQuestionSubject;
use App\Models\WrittenExamResult;
use  App\Model\StudentQuestionSetting;
use Illuminate\Database\Eloquent\Model;
use  App\Model\McqExamStudentAnsSummary;
use Illuminate\Support\Facades\Auth;

class ExamSetting extends Model
{

	/**
	 * Formated casts Attributes
	 * Emon Khan
	 * return formatted model values
	 */

	protected $casts = [
		'exam_start_date_time' => 'datetime:d-m-Y h:i a',
		'exam_end_date_time' => 'datetime:d-m-Y h:i a'
	];

	// public function getStartDateTimeAttribute($value)
	// {
	// 	return Carbon::make($value)->format('d-m-Y h:i a');
	// }

	// public function getEndDateTimeAttribute($value)
	// {
	// 	return Carbon::make($value)->format('d-m-Y h:i a');
	// }

	// get the result by exam_setting_id

	public function result()
	{
		return $this->hasOne(WrittenExamResult::class, 'exam_setting_id');
	}

	/*********************************************************************/



	public function feeCategores()
	{
		return $this->belongsTo(FeeCategory::class, 'fee_cat_id', 'id');
	}

	public function mcqQuestionSubjects()
	{
		return $this->belongsTo(McqQuestionSubject::class, 'question_subject_id', 'id')->whereNull('deleted_at');
	}

	public function writtenQuestionSubjects()
	{
		return $this->belongsTo(WrittenQuestion::class, 'question_subject_id', 'id')->whereNull('deleted_at');
	}

	public function amounts()
	{
		return $this->hasOne(FeeAmountSetting::class, 'origin_id', 'id')
			->whereNull('deleted_at')
			->where('fee_cat_id', $this->fee_cat_id)
			->where('batch_setting_id', $this->batch_setting_id)
			->where('batch_type_id', $this->batch_type_id)
			->where('class_id', $this->class_id)
			->where('session_id', $this->session_id);
	}

	public function options()
	{
		return $this->hasMany(McqQuestionOption::class, 'mcq_question_id', 'id')->whereNull('deleted_at');
	}
	public function classes()
	{
		return $this->belongsTo(Classes::class, 'class_id', 'id');
	}

	public function sessiones()
	{
		return $this->belongsTo(Sessiones::class, 'session_id', 'id');
	}
	public function sections()
	{
		return $this->belongsTo(Section::class, 'section_id', 'id');
	}

	public function batchsetting()
	{
		return $this->belongsTo(BatchSetting::class, 'batch_setting_id', 'id');
	}
	public function batchTypies()
	{
		return $this->belongsTo(BatchType::class, 'batch_type_id', 'id');
	}

	public  function subjects()
	{
		return $this->belongsTo(Subject::class, 'subject_id', 'id');
	}

	public  function  examtypies()
	{
		return $this->belongsTo(ExamType::class, 'examination_type_id', 'id');
	}


	/**student able to attent to exam or not */
	public function checkCapabilityToAttentInExam()
	{
		$auth = optional(auth()->user()->activestudents)->pluck('id')->toArray();
		$data = StudentQuestionSetting::where('exam_setting_id', $this->id)->whereIn('student_id', $auth)->whereNull('deleted_at')->first();
		return $data ? $data->exam_capability : NULL;
	}
	/**student able to attent to exam or not */

	/** */
	public function checkExamCompletedOrNot()
	{
		$auth = optional(auth()->user()->activestudents)->pluck('id')->toArray();
		return $this->hasMany(McqExamStudentAnsSummary::class, 'mcq_exam_setting_id', 'id')->whereIn('student_id', $auth);
		return McqExamStudentAnsSummary::where('mcq_exam_setting_id', $this->id)
			->where('batch_setting_id', $this->batch_setting_id)
			->where('batch_type_id', $this->batch_type_id)
			->where('class_id', $this->class_id)
			->where('session', $this->session)
			->whereIn('student_id', $auth)
			->whereNull('deleted_at')
			->count();
	}
	/** */

	public function writtenexam()
	{
		return $this->belongsTo(WrittenQuestion::class, 'question_subject_id');
	}

	public function mcqexam()
	{
		return $this->belongsTo(McqQuestionSubject::class, 'question_subject_id');
	}

	public function is_written_exam_completed()
	{
		$userId = Auth::id();
		return WrittenExamResult::where('created_by', $userId)
			->where('exam_setting_id', $this->id)
			->whereStatus(1)
			->count();
	}

	public function is_mcq_exam_completed()
	{
		$userId = Auth::id();
		return McqExamStudentAnsSummary::where('created_by', $userId)
			->where('mcq_exam_setting_id', $this->id)
			->where('verified', 1)
			->whereStatus(1)
			->count();
	}
}
