<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function user()
	{
		return $this->belongsTo(User::class,'user_id','id');
	}

	public function classes()
	{
		return $this->belongsTo(Classes::class,'classes_id','id');
	}

	public function sessiones()
	{
		return $this->belongsTo(Sessiones::class,'sessiones_id','id');
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

	public function attendancedetail()
	{
		return $this->hasMany(AttendanceDetail::class,'attendance_id');
	}
}
