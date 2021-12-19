<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class OldQuestion extends Model
{
    public  function  user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public  function  subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }

    public  function  questiontype()
    {
        return $this->belongsTo(QuestionType::class,'question_type_id');
    }

    public  function  year()
    {
        return $this->belongsTo(Year::class,'year_id');
    }

    public  function  examtype()
    {
        return $this->belongsTo(ExamType::class,'exam_type_id');
    }

    public  function boardquestiontype()
    {
        return $this->belongsTo(BoardQuestionType::class,'board_question_type_id');
    }

    public  function  classes()
    {
        return $this->belongsTo(Classes::class,'class_id');
    }
    
    public  function  boardname()
    {
        return $this->belongsTo(BoardName::class,'board_name_id');
    }



}
