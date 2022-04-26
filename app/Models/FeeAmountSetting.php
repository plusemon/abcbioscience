<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\FeeCategory;
use App\Model\PayTime;
use App\Model\BatchType;
use App\Model\PaymentHistory;
use App\Models\Classes;
use App\Model\StudentWaiver;
use App\Models\Section;
use App\Models\Batch;
use App\Models\Sessiones;
use App\Models\BatchSetting;
use App\Models\WrittenQuestion;
use App\Model\FeeCollection;
use App\Model\McqQuestionSubject;
class FeeAmountSetting extends Model
{
    public function feeCategores()
    {
        return $this->belongsTo(FeeCategory::class,'fee_cat_id','id');
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
	public function payTypes()
	{
		return $this->belongsTo(PayTime::class,'pay_time_id','id');
	}



	public function waiveredStudent($fee_cat_id,$amount,$student_id,$class_id,$session_id,$batch_setting_id,$batch_type_id,$month_id)
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

	public function waiverPaidAmount($fee_cat_id,$student_id,$class_id,$session_id,$batch_setting_id,$batch_type_id,$month_id)
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


	/******* when collect other fee amount***** */
	public function feeCategory($fee_cat_id)
	{

		if($fee_cat_id == 4) // mcq question
		{
			if($this->origin_id != NULL || $this->origin_id != "")
			{
				$e = ExamSetting::where('id',$this->origin_id)->where('fee_cat_id',4)
						->where('fee_cat_id',$this->fee_cat_id)
						->where('batch_setting_id',$this->batch_setting_id)
						->where('batch_type_id',$this->batch_type_id)
						->where('class_id',$this->class_id)
						->where('session_id',$this->session_id)
						->first();
				$question_subject_id = $e?$e->question_subject_id:NULL;

				$data = McqQuestionSubject::find($question_subject_id);
				$d['id'] 	= $data?$data->id : NULL;
				$d['name'] 	= $data?$data->question_no : NULL;
				return $d;
			}
		}
		else if($fee_cat_id == 5) // written question
		{
			if($this->origin_id != NULL || $this->origin_id != "")
			{
				$e = ExamSetting::where('id',$this->origin_id)->where('fee_cat_id',5)
						->where('fee_cat_id',$this->fee_cat_id)
						->where('batch_setting_id',$this->batch_setting_id)
						->where('batch_type_id',$this->batch_type_id)
						->where('class_id',$this->class_id)
						->where('session_id',$this->session_id)
						->first();
				$question_subject_id = $e?$e->question_subject_id:NULL;
				$data = WrittenQuestion::find($question_subject_id);
				$d['id'] 	= $data?$data->id : NULL;
				$d['name'] 	= $data?$data->question_no : NULL;
				return $d;
			}
			else{

			}
		}
		else if($fee_cat_id == 6) // sheet
		{
			$d['id'] 	=  NULL;
			$d['name'] 	= "not created";
			return $d;
		}else{
			$fee = FeeCategory::find($fee_cat_id);
			$d['id'] 	= $fee?$fee->id : NULL;
			$d['name'] 	= $fee?$fee->name : NULL;
			return $d;
		}
	}

	public function othersWaiveredStudent($fee_cat_id,$amount,$student_id,$class_id,$session_id,$batch_setting_id,$batch_type_id)
    {
		$waive =  StudentWaiver::where('student_id',$student_id)
		->where('class_id',$class_id)
		->where('session_id',$session_id)
		->where('batch_setting_id',$batch_setting_id)
		->where('batch_type_id',$batch_type_id)
		->where('fee_cat_id',$fee_cat_id)
		/* ->where(function ($query) use ($month_id) {
			$query->where('start_month_id', '<=', $month_id);
			$query->where('end_month_id', '>=', $month_id);
		}) */
		->where('activate_status',1)
		->whereNull('deleted_at')
		->first();
		return $waive?$waive:NULL;
    }
	public function othersWaiverPaidAmount($fee_cat_id,$student_id,$class_id,$session_id,$batch_setting_id,$batch_type_id,$origin_id)
	{
		   $paidAmount =  PaymentHistory::where('student_id',$student_id)
			->where('class_id',$class_id)
			->where('session_id',$session_id)
			->where('batch_setting_id',$batch_setting_id)
			->where('batch_type_id',$batch_type_id)
			->where('fee_cat_id',$fee_cat_id)
			->where('origin_id',$origin_id)
			->where('status',1)
			->whereNull('deleted_at')
			->get();
		return 	$paidAmount->sum('amount');
	}
	/******* when collect other fee amount***** */
}
