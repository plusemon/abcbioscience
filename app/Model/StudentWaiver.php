<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Sessiones;
use App\Models\Section;
use App\Models\Batch;
use App\Models\BatchSetting;
use App\Models\StudentInfo;
use App\Models\Month;
use App\Models\StudentType;
use App\Models\Student;
use App\Model\Waiver;
use App\Model\FeeSetting;
use App\Model\FeeAmountSetting;
use App\User;
class StudentWaiver extends Model
{
    public function user()
	{
		return $this->belongsTo(User::class,'user_id','id');
	}
    public function students()
	{
		return $this->belongsTo(Student::class,'student_id','id');
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
	public function feeCategories()
	{
		return $this->belongsTo(FeeCategory::class,'fee_cat_id','id');
	}

	public function waivers()
	{
		return $this->belongsTo(Waiver::class,'waiver_id','id');
	}
	
	public function feeAmountSettings()
	{
		return $this->belongsTo(FeeAmountSetting::class,'fee_amount_setting_id','id');
	}

	public function feeSetting()
	{
		return $this->belongsTo(FeeSetting::class,'fee_setting_id','id');
	}


	public function batchsetting()
	{
		return $this->belongsTo(BatchSetting::class,'batch_setting_id','id');
	}

	public function studentinfo()
	{
		return $this->belongsTo(StudentInfo::class,'user_id','id');
	}


	public function month()
	{
		return $this->belongsTo(Month::class,'start_month_id','id');
	}
	public function startMonth()
	{
		return $this->belongsTo(Month::class,'start_month_id','id');
	}
	public function endMonth()
	{
		return $this->belongsTo(Month::class,'end_month_id','id');
	}


	public function studentype()
	{
		return $this->belongsTo(StudentType::class,'student_type_id','id');
	}
	public function createdBy()
	{
		return $this->belongsTo(User::class,'created_by','id');
	}




}
