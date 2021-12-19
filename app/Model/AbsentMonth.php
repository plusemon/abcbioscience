<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Models\Month;

class AbsentMonth extends Model
{
    protected $table = "absent_month";

    public function month()
	{
		return $this->belongsTo(Month::class,'month_id','id');
	}

}
