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
        $survey_sections = $this->section;
        $result = new Collection();
        if ($survey_sections->isEmpty()) {
            return null;
        }
        foreach ($survey_sections as $survey_section) {
            $result = $result->merge($survey_section->questions);
        }
        return $result;
    }

    public function getScoreFromLevel($survey_round, $candiate, $level)
    {
        $questions = $this->getQuestions();
        if ($questions->isEmpty() || $questions == null) {
            return null;
        }
        $max_score = $this->getMaxScore();

        $total = 0;
        foreach ($questions as $question) {
            $total += $question->getScoreFromLevel($survey_round, $candiate, $level);
        }

        if ($total !== 0) {
            return round($total / ($questions->count()), 2);
        }
        return null;
    }

    public function getAvgScore($survey_round, $candiate)
    {
        $high_score = $this->getScoreFromLevel($survey_round, $candiate, 3);
        $equal_score = $this->getScoreFromLevel($survey_round, $candiate, 2);
        $lower_score = $this->getScoreFromLevel($survey_round, $candiate, 1);

        if ($high_score * 3 + $equal_score * 2 + $lower_score == 0) {
            return null;
        }

        $avg_score = ($high_score * 3 + $equal_score * 2 + $lower_score) / (($high_score != 0 ? 3 : 0) + ($equal_score != 0 ? 2 : 0) + ($lower_score != 0 ? 1 : 0));

        return round($avg_score, 2);
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

    public function getScoreByPercent($survey_round, $candiate)
    {
        $score = $this->getAvgScore($survey_round, $candiate) / 3 * 100;
        return round($score, 2);
    }
}