<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveySection extends Model
{
    protected $table = 'survey_section';

    protected $fillable = ['survey_id', 'content', 'title'];

    public $timestamps = true;

    public function questions()
    {
        return $this->belongsToMany('App\Models\Question', 'survey_section_has_questions', 'survey_section_id', 'question_id');
    }

}