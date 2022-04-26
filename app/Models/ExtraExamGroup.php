<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraExamGroup extends Model
{
    
    protected $fillable = ['id','name'];
    
    protected $table = "extra_exam_groupes";
}
