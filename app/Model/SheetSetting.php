<?php

namespace App\Model;

use App\Models\Sheet;
use App\Models\Classes;
use App\Models\Subject;
use App\Model\BatchType;
use App\Model\SheetType;
use App\Models\Sessiones;
use App\Model\FeeCategory;
use App\Models\BatchSetting;
use App\Model\FeeAmountSetting;

use Illuminate\Database\Eloquent\Model;
class SheetSetting extends Model
{
    protected $fillable = ['fee_cat_id','batch_setting_id','batch_type_id','sheet_id','subject_id','class_id','session_id','sheet_type_id','publish_date','taken_by','publish_by','download_times','created_by','verified','status','deleted_at'];


    public function feeCategores()
	{
        return $this->belongsTo(FeeCategory::class,'fee_cat_id','id');
	}

    public function sheets()
	{
        return $this->belongsTo(Sheet::class,'sheet_id','id');
	}

    public function amounts()
	{
        return $this->hasOne(FeeAmountSetting::class,'origin_id','id')
        ->whereNull('deleted_at')
        ->where('fee_cat_id',$this->fee_cat_id)
        ->where('batch_setting_id',$this->batch_setting_id)
        ->where('batch_type_id',$this->batch_type_id)
        ->where('class_id',$this->class_id)
        ->where('session_id',$this->session_id);
	}


    public function classes()
	{
		return $this->belongsTo(Classes::class,'class_id','id');
	}

	public function sessiones()
	{
		return $this->belongsTo(Sessiones::class,'session_id','id');
	}

	public function batchsetting()
	{
		return $this->belongsTo(BatchSetting::class,'batch_setting_id','id');
	}
	public function batchTypies()
	{
		return $this->belongsTo(BatchType::class,'batch_type_id','id');
	}

	public  function subjects()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
	public  function  sheetTypes()
    {
        return $this->belongsTo(SheetType::class,'sheet_type_id','id');
    }

    public function sheet()
    {
        return $this->hasOne(StudentSheetSetting::class);
    }
}
