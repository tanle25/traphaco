<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ['content', 'created_by'];

    public $timestamps = true;

    public function options()
    {
        return $this->hasMany('App\Models\QuestionOption', 'question_id', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo('App\User', 'create_by', 'id');
    }

    public function maxScore()
    {
        $list_option = $this->options->sortByDesc('score');
        return $list_option->first()->score;
    }

}