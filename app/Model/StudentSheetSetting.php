<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Sessiones;
use App\Models\Section;
use App\Models\BatchSetting;
use App\Model\BatchType;
use App\Models\Subject;
use App\Models\Sheet;
use App\Models\ExamType;
use App\User;
use App\Model\McqQuestionOption;
use App\Model\McqQuestionSubject;
use App\Model\FeeCategory;
use App\Model\SheetSetting;
use App\Model\FeeAmountSetting;
use App\Model\ExamSetting;
use App\Model\SheetType;
class StudentSheetSetting extends Model
{
    protected $fillable = ['student_id','subject_id','class_id','session_id','batch_setting_id','batch_type_id','fee_cat_id','sheet_id','sheet_type_id','fee_amount_setting_id','download_capability','download_count','download_time','created_by','verified','status','deleted_at'];


    public function feeCategores()
    {
        return $this->belongsTo(FeeCategory::class,'fee_cat_id','id');
    }

    public function sheets()
	{
        return $this->belongsTo(Sheet::class,'sheet_id','id')->whereNull('deleted_at');
	}
    public function sheetTypes()
	{
        return $this->belongsTo(SheetType::class,'sheet_type_id','id')->whereNull('deleted_at');
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

	public  function  examtypies()
    {
        return $this->belongsTo(ExamType::class,'examination_type_id','id');
    }

	public  function  sheetSettings()
    {
        return $this->belongsTo(SheetSetting::class,'sheet_setting_id','id');
    }


}
