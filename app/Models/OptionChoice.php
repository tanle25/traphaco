<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionChoice extends Model
{
    protected $table = 'option_choices';

    public function answer()
    {
        return $this->belongsTo('App\Models\Answer', 'answer_id', 'id');
    }

    public function option()
    {
        return $this->belongsTo('App\Models\QuestionOption', 'option_id', 'id');
    }
}