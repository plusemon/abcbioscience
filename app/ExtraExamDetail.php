<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraExamDetail extends Model
{
    protected $fillable = ['extra_exam_id','name','mobile','section','roll','mcq_mark','written_mark'];
}
