<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }
}
