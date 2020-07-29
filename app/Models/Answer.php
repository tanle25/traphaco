<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    public $timestamps = true;

    public function test()
    {
        return $this->belongsTo('App\Models\Test', 'test_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }

    public function option_choice()
    {
        return $this->hasOne('App\Models\OptionChoice', 'answer_id', 'id');
    }

}