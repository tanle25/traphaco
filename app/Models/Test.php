<?php

namespace App\Models;

use App\Models\TestTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{

    use SoftDeletes;

    protected $table = 'tests';

    protected $fillable = ['survey_round', 'candiate_id', 'examiner_id', 'multiplier', 'survey_id', 'status'];

    public $timestamps = true;

    public function candiate()
    {
        return $this->belongsTo('App\User', 'candiate_id');
    }

    public function examiner()
    {
        return $this->belongsTo('App\User', 'examiner_id');
    }

    public function survey()
    {
        return $this->belongsTo('App\Models\Survey', 'survey_id');
    }

    public function answer()
    {
        return $this->hasMany('App\Models\Answer', 'test_id', 'id');
    }

    public function totalScore()
    {
        $total_score = 0;
        foreach ($this->answer as $answer) {
            $total_score += $answer->selected_option->score ?? 0;
        }
        return $total_score;
    }

    public function getStartTime()
    {
        $time = TestTime::where('survey_round_id', $this->survey_round)
            ->where('survey_id', $this->survey_id)
            ->first();
        return $time->start_at;
    }

    public function getEndTime()
    {
        $time = TestTime::where('survey_round_id', $this->survey_round)
            ->where('survey_id', $this->survey_id)
            ->first();
        return $time->end_at;
    }

}