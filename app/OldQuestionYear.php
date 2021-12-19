<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldQuestionYear extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['board_id', 'year', 'status'];

    public function subjects()
    {
        return $this->hasMany(OldQuestionSubject::class, 'year_id');
    }

    public function board()
    {
        return $this->belongsTo(OldQuestionBoard::class, 'board_id');
    }
}
