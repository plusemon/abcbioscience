<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldSchoolSubject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_id',
        'name',
        'status',
    ];


    public function questions()
    {
        return $this->hasMany(OldSchoolQuestion::class,'subject_id');
    }

    public function class()
    {
        return $this->belongsTo(OldSchoolClass::class, 'class_id');
    }
}
