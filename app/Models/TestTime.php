<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestTime extends Model
{
    protected $table = "test_time";

    protected $fillable = [
        'survey_round_id',
        'survey_id',
        'start_at',
        'end_at',
    ];
    public $timestamps = false;
}