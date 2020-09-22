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
        return $this->belongsToMany(
            'App\Models\Question',
            'survey_section_has_questions',
            'survey_section_id',
            'question_id')
            ->orderBy('order')
            ->orderBy('id');
    }

    public function getScoreFromLevel($survey_round, $candiate, $level)
    {
        $questions = $this->questions;
        if ($questions->isEmpty() || $questions == null) {
            return null;
        }

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

    public function getScoreByPercent($survey_round, $candiate)
    {
        $score = $this->getAvgScore($survey_round, $candiate) / 3 * 100;
        return round($score, 2);
    }

}