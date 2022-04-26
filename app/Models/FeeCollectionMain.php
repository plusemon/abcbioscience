<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\StudentWaiver;
use App\Model\FeeCategory;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Batch;
use App\Models\Sessiones;
use App\Models\BatchSetting;
use App\Model\FeeCollection;
use App\Models\Student;
use App\Models\Month;

class FeeCollectionMain extends Model
{
    protected $table = 'fee_collection_main';

    public function students()
    {
        return $this->belongsTo(Student::class,'student_id','id');
    }

    public function feeCollections()
    {
        return $this->hasMany(FeeCollection::class,'fee_collection_main_id','id');
    }

    public function classes()
	{
		return $this->belongsTo(Classes::class,'class_id','id');
	}

	public function sessiones()
	{
		return $this->belongsTo(Sessiones::class,'session_id','id');
	}
	public function sections()
	{
		return $this->belongsTo(Section::class,'section_id','id');
	}

	public function batch()
	{
		return $this->belongsTo(Batch::class,'batch_id','id');
	}


	public function batchsetting()
	{
		return $this->belongsTo(BatchSetting::class,'batch_setting_id','id');
	}
	public function months()
	{
		return $this->belongsTo(Month::class,'receive_month_id','id');
	}


	
	
}
