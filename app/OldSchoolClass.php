<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldSchoolClass extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'session_id',
        'name',
        'status',
    ];

    public function subjects()
    {
        return $this->hasMany(OldSchoolSubject::class,'class_id');
    }

    public function session()
    {
        return $this->belongsTo(OldSchoolSession::class, 'session_id');
    }
}
