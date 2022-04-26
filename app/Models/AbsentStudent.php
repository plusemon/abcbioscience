<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Sessiones;
use App\Models\Section;
use App\Models\BatchSetting;
use App\Models\StudentInfo;
use App\Models\Month;

use App\Models\Student;
use App\Model\AbsentMonth;

use App\User;
class AbsentStudent extends Model
{
    public function absentMonths()
    {
        return $this->hasMany(AbsentMonth::class,'absent_id','id')->where('status',1)->whereNull('deleted_at');
        //return $this->hasMany(AbsentMonth::class,'absent_id','id')->where('year',date("Y"))->where('status',1)->whereNull('deleted_at');
    }

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


	public function createdBy()
	{
		return $this->belongsTo(User::class,'created_by','id');
	}

}
