<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    
    public function year()
    {
        return $this->hasMany(OldQuestion::class,'year_id');
    }


}
