<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\StudentWaiver;
use App\Model\FeeCategory;
use App\Model\FeeAmountSetting;
use App\Model\BatchType;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Batch;
use App\Models\Sessiones;
use App\Models\BatchSetting;
use App\Model\FeeCollection;
use App\Models\Student;
use App\Models\Month;
class PaymentMethod extends Model
{
    public function students()
    {
        return $this->belongsTo(Student::class,'student_id','id');
    }
    public function feeCategores()
    {
        return $this->belongsTo(FeeCategory::class,'fee_cat_id','id');
    }
    public function feeSettings()
    {
        return $this->belongsTo(FeeAmountSetting::class,'fee_amount_setting_id','id');
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
	public function months()
	{
		return $this->belongsTo(Month::class,'origin','id');
	}



	public function waiveredStudent($fee_cat_id,$amount,$student_id,$class_id,$session_id,$batch_setting_id,$month_id)
    {
       	$waive =  StudentWaiver::where('student_id',$student_id)
			->where('class_id',$class_id)
			->where('session_id',$session_id)
			->where('batch_setting_id',$batch_setting_id)
			->where('fee_cat_id',$fee_cat_id)
			->where(function ($query) use ($month_id) {
				$query->where('start_month_id', '<=', $month_id);
				$query->where('end_month_id', '>=', $month_id);
			})
			->where('activate_status',1)
			->whereNull('deleted_at')
			->first();
		return $waive?$waive:NULL;
    }

	public function paidAmount($main_id,$fee_cat_id,$month_id)
    {
       	$paidAmount =  FeeCollection::where('fee_collection_main_id',$main_id)
			->where('fee_cat_id',$fee_cat_id)
			->where('receive_month_id',$month_id)
			->where('status',1)
			->whereNull('deleted_at')
			->get();
		return 	$paidAmount->sum('payment_amount');
    }


	public function totalPaidAmount($fee_cat_id,$student_id,$class_id,$session_id,$batch_setting_id,$month_id)
    {
       	$paidAmount =  FeeCollection::where('student_id',$student_id)
			->where('class_id',$class_id)
			->where('session_id',$session_id)
			->where('batch_setting_id',$batch_setting_id)
			->where('fee_cat_id',$fee_cat_id)
			->where('receive_month_id',$month_id)
			->where('status',1)
			->whereNull('deleted_at')
			->get();
		return 	$paidAmount->sum('payment_amount');
    }

}
