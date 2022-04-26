<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = ['class_id','old_subject_id','thumbnail','ebook_file','status'];


    public function classes()
    {
        return $this->belongsTo(Classes::class,'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(OldSubject::class,'old_subject_id');
    }

}
