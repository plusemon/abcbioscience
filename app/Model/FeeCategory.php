<?php

namespace App\Model;
use App\Model\Module;
use App\Model\FeeCategoryType;
use Illuminate\Database\Eloquent\Model;

class FeeCategory extends Model
{
   public function modules()
   {
       return $this->belongsTo(Module::class,'module_id','id');
   }
   public function catTypes()
   {
       return $this->belongsTo(FeeCategoryType::class,'fee_category_type_id','id');
   }
}
