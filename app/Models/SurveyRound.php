<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyRound extends Model
{
    protected $fillable = ['name', 'created_by', 'content'];

    protected $table = 'survey_round';

    public function author()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}