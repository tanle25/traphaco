<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';

    protected $fillable = ['survey_round', 'candiate_id', 'examiner_id', 'multiplier', 'survey_id', 'status'];

    public $timestamps = true;

    public function candiate()
    {
        return $this->belongsTo('App\Models\User', 'candiate_id');
    }

    public function examiner()
    {
        return $this->belongsTo('App\Models\User', 'examiner_id');
    }

    public function survey()
    {
        return $this->belongsTo('App\Models\Survey', 'survey_id');
    }
}