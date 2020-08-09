<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    protected $table = 'question_options';

    protected $fillable = ['content', 'question_id', 'score'];

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }
}