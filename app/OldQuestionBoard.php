<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldQuestionBoard extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'status'];

    public function years()
    {
        return $this->hasMany(OldQuestionYear::class, 'board_id');
    }
}
