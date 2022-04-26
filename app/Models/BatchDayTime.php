<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchDayTime extends Model
{
     protected $fillable = [
        'name','status'
    ];


    public function day()
    {
    	return $this->belongsTo(Day::class,'day_id');
    }
}
