<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Survey extends Model
{
    protected $table = 'survey';

    protected $fillable = ['title', 'name', 'content', 'created_by', 'type'];

    public $timestamps = true;

    public function section()
    {
        return $this->hasMany('App\Models\SurveySection', 'survey_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function getQuestions()
    {
        $survey_sections = $this->survey_section;
        $result = new Collection();

        foreach ($survey_sections as $survey_section) {
            $result = $result->merge($survey_section->question);
        }
        return $result;
    }

    public function getMaxScore()
    {
        $result = 0;
        $survey_sections = $this->section;
        foreach ($survey_sections as $survey_section) {
            foreach ($survey_section->questions as $question) {
                $result += $question->maxScore();
            }
        }
        if ($result == 0) {
            $result = 1;
        }
        return $result;
    }
}