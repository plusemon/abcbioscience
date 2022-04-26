<?php

namespace App\Model;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Sessiones;
use App\Model\FeeCategory;
use App\Models\BatchSetting;

use Illuminate\Database\Eloquent\Model;

class ResultGroup extends Model
{
     protected $guarded = [];

     public function classes()
     {
          return $this->belongsTo(Classes::class, 'class_id', 'id');
     }

     public function sessiones()
     {
          return $this->belongsTo(Sessiones::class, 'session_id', 'id');
     }
     public function sections()
     {
          return $this->belongsTo(Section::class, 'section_id', 'id');
     }

     public function batchsetting()
     {
          return $this->belongsTo(BatchSetting::class, 'batch_setting_id', 'id');
     }


     public function mcqexamsetting()
     {
          return $this->belongsTo(ExamSetting::class, 'mcq_exam_setting_id', 'id');
     }  
     
     
     public function offlinemcqexamsetting()
     {
          return $this->belongsTo(ExamSetting::class, 'mcq_exam_setting_id', 'id');
     }
     
     
     public function writtenexamsetting()
     {
          return $this->belongsTo(ExamSetting::class, 'written_exam_setting_id', 'id');
     }





}
