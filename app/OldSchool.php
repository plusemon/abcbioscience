<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldSchool extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['institute','type','status'];

    public function sessions()
    {
        return $this->hasMany(OldSchoolSession::class,'school_id');
    }

   
}
