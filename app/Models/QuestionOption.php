<?php

namespace App\Models;

use App\Models\CustomerAnswer;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    protected $table = 'question_options';

    protected $fillable = ['content', 'question_id', 'score'];

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }

    public function countCustomerChosen()
    {
        $count = CustomerAnswer::where('option_choice', $this->id)->where('comment', null)->get()->count();
        return $count;
    }

    public function getCustomerChoosen()
    {
        return CustomerAnswer::with('customer_test.customer')
            ->where('option_choice', $this->id)
            ->where('comment', null)
            ->get();
    }
}