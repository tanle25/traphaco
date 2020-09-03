<?php

namespace App\Models;

use App\Models\Test;
use Illuminate\Database\Eloquent\Model;

class SurveyRound extends Model
{
    protected $fillable = ['name', 'created_by', 'content'];

    protected $table = 'survey_round';

    public function author()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    public function getSurveyList()
    {
        return Test::join('survey_round', 'survey_round.id', '=', 'tests.survey_round')
            ->join('survey', 'survey.id', '=', 'tests.survey_id')
            ->where('survey_round.id', $this->id)
            ->select('survey.*')
            ->groupBy('survey.id')
            ->get();
    }
    public function getSurveyListAndTime()
    {
        return Test::join('survey_round', 'survey_round.id', '=', 'tests.survey_round')
            ->join('survey', 'survey.id', '=', 'tests.survey_id')
            ->join('test_time', 'test_time.survey_id', '=', 'survey.id')
            ->where('survey_round.id', $this->id)
            ->where('test_time.survey_round_id', $this->id)
            ->select('survey.*', 'test_time.start_at', 'test_time.end_at')
            ->groupBy('survey.id')
            ->get();
    }

}
