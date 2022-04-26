<?php

namespace App\Models;

use App\OldSchool;
use Illuminate\Database\Eloquent\Model;

class BoardName extends Model
{
    public function questions()
    {
        return $this->hasMany(OldSchool::class,'id');
    }
}
