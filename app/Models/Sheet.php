<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use App\Model\SheetType;
class Sheet extends Model
{
	protected $fillable = ['sheet_no','subject_id','class_id','session_id','chapter_id','topic','sheet_file','thumbnail','description','sheet_type_id','created_by','verified','status','deleted_at'];

    public function subjects()
	{
		return $this->belongsTo(Subject::class,'subject_id');
	}
    public function classes()
	{
		return $this->belongsTo(Classes::class,'class_id');
	}

	public function sessiones()
	{
		return $this->belongsTo(Sessiones::class,'session_id');
	}
	public function sheetTypes()
	{
		return $this->belongsTo(SheetType::class,'sheet_type_id');
	}
	
	public function chapter()
	{
		return $this->belongsTo(Chapter::class,'chapter_id');
	}
	

}
