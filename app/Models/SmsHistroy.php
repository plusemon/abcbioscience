<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class SmsHistroy extends Model
{
    public function user()
	{
		return $this->belongsTo(User::class,'user_id','id');
	}
	
	
	public function student()
	{
		return $this->belongsTo(Student::class,'student_id','id');
	}
	
	
}
