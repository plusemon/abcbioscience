<?php

namespace App;

use App\OldSchool;
use Illuminate\Database\Eloquent\Model;

class OldSchoolSession extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id',
        'year',
        'status',
    ];

    public function classes()
    {
        return $this->hasMany(OldSchoolClass::class, 'session_id');
    }

    public function school()
    {
        return $this->belongsTo(OldSchool::class, 'school_id');
    }
}
