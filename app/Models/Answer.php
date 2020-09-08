<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Answer extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['question_id', 'option_choice', 'comment'];

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected $table = 'answers';

    protected $fillable = ['test_id', 'question_id', 'option_choice', 'comment'];

    public $timestamps = true;

    protected static $recordEvents = ['created', 'updated', 'deleted'];

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