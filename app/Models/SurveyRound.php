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
}