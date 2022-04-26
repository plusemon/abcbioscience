<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeWork extends Model
{
    public function classes()
    {
        return $this->belongsTo(Classes::class,'classes_id','id');
    }

    public function sessiones()
    {
        return $this->belongsTo(Sessiones::class,'sessiones_id','id');
    }
     

    public function batchsetting()
    {
        return $this->belongsTo(BatchSetting::class,'batch_setting_id','id');
    }

    public  function  subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }


    public  function  chapter()
    {
        return $this->belongsTo(Chapter::class,'chapter_id');
    }




    public function homework()
    {
        return $this->hasMany(HomeWorkDetail::class);
    }


}
