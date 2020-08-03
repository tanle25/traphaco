<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = ['test_id', 'question_id', 'option_choice', 'comment'];

    public $timestamps = true;

    public function test()
    {
        return $this->belongsTo('App\Models\Test', 'test_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }

    public function selected_option()
    {
        return $this->hasOne('App\Models\QuestionOption', 'id', 'option_choice');
    }

}