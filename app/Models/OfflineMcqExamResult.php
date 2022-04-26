<?php

namespace App\Models;

use App\Model\ExamSetting;
use App\User;
use Illuminate\Database\Eloquent\Model;

class OfflineMcqExamResult extends Model
{
    
    protected $table = "offlinemcq_exam_results";
    
    
    protected $casts = [
        'submission_files' => 'array'
    ];



    // relational functions

    public  function student()
    {
        return $this->belongsTo(Student::class);
    }

    public  function batch()
    {
        return $this->belongsTo(BatchSetting::class, 'batch_setting_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function session()
    {
        return $this->belongsTo(Sessiones::class);
    }

    public function topic()
    {
        return $this->belongsTo(ExamSetting::class, 'exam_setting_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
