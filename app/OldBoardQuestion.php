<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldBoardQuestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'name',
        'content',
        'status',
    ];

    
}
