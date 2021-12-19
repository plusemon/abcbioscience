<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\WaiverType;
class Waiver extends Model
{
    public function waiverTypies()
    {
        return $this->belongsTo(WaiverType::class,'waiver_type_id','id');
    }
}
