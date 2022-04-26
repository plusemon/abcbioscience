<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeWorkDetail extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }


    public function mainhomework()
    {
        return $this->belongsTo(HomeWork::class,'home_work_id');
    }
}
