<?php

namespace App\Models;

use App\Models\Test;
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

    public function getScoreFromLevel($survey_round, $candiate, $level)
    {
        $test = Test::join('survey', 'survey.id', '=', 'tests.survey_id')
            ->join('answers', 'answers.test_id', '=', 'tests.id')
            ->join('question_options', 'answers.option_choice', '=', 'question_options.id')
            ->where('answers.question_id', $this->id)
            ->where('survey_round', $survey_round)
            ->where('candiate_id', $candiate)
            ->where('multiplier', $level)
            ->select('question_options.score')
            ->get();

        if ($test->isEmpty()) {
            return null;
        }

        $sum = $test->reduce(function ($carry, $item) {
            return $carry + $item->score;
        }, 0);

        $max_sum = $test->count() * $this->maxScore();

        $score = round(($sum / $test->count()), 2);
        return $score;
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

        return $avg_score;
    }

    public function getScoreByPercent($survey_round, $candiate)
    {
        $score = $this->getAvgScore($survey_round, $candiate) / 3 * 100;
        return round($score, 2);
    }
}