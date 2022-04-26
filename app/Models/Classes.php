<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
     protected $fillable = [
        'name','status'
    ];


    public function classes()
    {
      return $this->hasMany(OldQuestion::class,'class_id');
    }

    public function ebook()
    {
        return $this->hasMany(Ebook::class,'class_id');
    }


}
