<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamGroupStudent extends Model
{
    protected $table = "examgroupstudents";
    
    protected $fillable = ['id','name','mobile','section','roll'];
    
}
