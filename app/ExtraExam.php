<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraExam extends Model
{
    protected $fillable = ['exam_name','mcq_mark','written_mark','exam_date'];
}
