<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\FeeSetting;
use App\Models\Sessiones;
use App\Models\Subject;
use App\Models\Classes;

class BatchSetting extends Model
{
   

	protected $fillable = [
        'classes_id','sessiones_id','batch_id','class_type','amount','status','created_at'
    ];

    public function classes()
    {
    	return $this->belongsTo(classes::class,'classes_id');
    }

    public function sessiones()
    {
    	return $this->belongsTo(Sessiones::class,'sessiones_id');
    }

    public function section()
    {
    	return $this->belongsTo(Section::class,'section_id');
    }

    public function batch()
    {
    	return $this->belongsTo(Batch::class,'batch_id');
    } 

    public function classtype()
    {
    	return $this->belongsTo(StudentType::class,'class_type_id','id');
    }

    public function dayandtime()
    {
    	return $this->hasMany(BatchDayTime::class,'batch_setting_id');
    }

    /**Moinul */
    public function feeSettings()
    {
        return $this->hasMany(FeeSetting::class,'batch_setting_id','id');
    }
    public function feeSettingAmount($fee_cat_id)
    {
        $val = FeeSetting::where('batch_setting_id',$this->id)->where('fee_cat_id',$fee_cat_id)
                        ->whereNull('deleted_at')->where('status',1)->first();
        return $val?$val->amount:0;
    }
    /**Moinul */
    
    
    public function student()
    {
        return $this->hasMany(Student::class,'batch_setting_id');
    }
    
    
    
    

}
