<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Section;
use App\Models\BatchSetting;
use App\Model\BatchType;
use App\Model\StudentQuestionSetting;
use App\Model\PaymentHistory;
use App\Model\FeeAmountSetting;
use App\Model\McqExamStudentAnsSummary;
use App\Model\StudentWaiver;
use App\Model\StudentSheetSetting;
class Student extends Model
{

	public function user()
	{
		return $this->belongsTo(User::class,'user_id','id');
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

	public function batch()
	{
		return $this->belongsTo(Batch::class,'batch_id','id');
	}

	public function batchsetting()
	{
		return $this->belongsTo(BatchSetting::class,'batch_setting_id','id');
	}

	public function batchTypes()
	{
		return $this->belongsTo(BatchType::class,'batch_type_id','id');
	}

	public function studentinfo()
	{
		return $this->belongsTo(StudentInfo::class,'user_id','id');
	}


	public function month()
	{
		return $this->belongsTo(Month::class,'start_month_id','id');
	}


	public function studentype()
	{
		return $this->belongsTo(StudentType::class,'student_type_id','id');
	}




	//maybe not using...
	public function checkExistingStudent()
    {
        return StudentQuestionSetting::where('student_id',$this->id)
        ->where('batch_setting_id',$this->batch_setting_id)
        ->where('batch_type_id',$this->batch_type_id)
        ->where('class_id',$this->class_id)
        ->where('session_id',$this->session_id)
        ->where('exam_capability',1)
        ->first();
    }
	public function checkExistingStudentForMcq($exam_setting_id)
    {
        return StudentQuestionSetting::where('student_id',$this->id)
        ->where('batch_setting_id',$this->batch_setting_id)
        ->where('batch_type_id',$this->batch_type_id)
        ->where('class_id',$this->class_id)
        ->where('session_id',$this->session_id)
        ->where('exam_setting_id',$exam_setting_id)
        ->where('fee_cat_id',4)
        ->where('exam_capability',1)
        ->first();
    }


    public function checkExistingForWrittenStudent($exam_setting_id)
    {
        return StudentQuestionSetting::where('student_id',$this->id)
        ->where('batch_setting_id',$this->batch_setting_id)
        ->where('batch_type_id',$this->batch_type_id)
        ->where('class_id',$this->class_id)
        ->where('session_id',$this->session_id)
        ->where('exam_setting_id',$exam_setting_id)
        ->where('fee_cat_id',5)
        ->where('exam_capability',1)
        ->first();
    }



		/************************************ Due Monthly Fee********************************** */
		public function waiveredStudent($fee_cat_id,$student_id,$class_id,$session_id,$batch_setting_id,$batch_type_id,$month_id)
		{
			   $waive =  StudentWaiver::where('student_id',$student_id)
				->where('class_id',$class_id)
				->where('session_id',$session_id)
				->where('batch_setting_id',$batch_setting_id)
				->where('batch_type_id',$batch_type_id)
				->where('fee_cat_id',$fee_cat_id)
				->where(function ($query) use ($month_id) {
					$query->where('start_month_id', '<=', $month_id);
					$query->where('end_month_id', '>=', $month_id);
				})
				->where('activate_status',1)
				->whereNull('deleted_at')
				->first();
			return $waive?$waive:NULL;
		}

		public function montlyFee($fee_cat_id,$class_id,$session_id,$batch_setting_id,$batch_type_id)
		{
			$paidAmount =  FeeAmountSetting::whereNull('deleted_at')
				->where('class_id',$class_id)
				->where('session_id',$session_id)
				->where('batch_setting_id',$batch_setting_id)
				->where('batch_type_id',$batch_type_id)
				->where('fee_cat_id',$fee_cat_id)
				//->where('origin_id',$month_id)
				->where('status',1)
				->first();
			return 	$paidAmount?$paidAmount->amount:0;
		}


		public function montlyPaidAmount($fee_cat_id,$student_id,$class_id,$session_id,$batch_setting_id,$batch_type_id,$month_id)
		{
			   $paidAmount =  PaymentHistory::where('student_id',$student_id)
				->where('class_id',$class_id)
				->where('session_id',$session_id)
				->where('batch_setting_id',$batch_setting_id)
				->where('batch_type_id',$batch_type_id)
				->where('fee_cat_id',$fee_cat_id)
				->where('origin_id',$month_id)
				->where('status',1)
				->whereNull('deleted_at')
				->get();
			return 	$paidAmount->sum('amount');
		}
		/************************************ Due Monthly Fee********************************** */



		/************************************ Sheet********************************** */
		public function checkExistingStudentForSheet($sheet_type_id)
		{
			return StudentSheetSetting::where('student_id',$this->id)
			->where('batch_setting_id',$this->batch_setting_id)
			->where('batch_type_id',$this->batch_type_id)
			->where('sheet_type_id',$sheet_type_id)
			->where('class_id',$this->class_id)
			->where('session_id',$this->session_id)
			->where('download_capability',1)
			->first();
		}
	
		/************************************ Sheet********************************** */


		public function written_result($exam_setting_id)
		{
			 return WrittenExamResult::where('exam_setting_id', $exam_setting_id)
			->where('student_id', $this->id)
			->first();
		}

		public function mcq_result($exam_setting_id)
		{
			return McqExamStudentAnsSummary::where('mcq_exam_setting_id',$exam_setting_id)
			->where('student_id', $this->id)
			->first();
		}



}
