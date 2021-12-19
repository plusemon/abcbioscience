<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldQuestionSubject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['year_id', 'name', 'status'];

    public function questions()
    {
        return $this->hasMany(OldBoardQuestion::class, 'subject_id');
    }
}
