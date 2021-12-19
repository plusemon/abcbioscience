<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceDetail extends Model
{
     public function student()
     {
        return $this->belongsTo(Student::class,'student_id');
     }
     
    public function mainattendance()
    {
        return $this->belongsTo(Attendance::class,'attendance_id');
    }

}
