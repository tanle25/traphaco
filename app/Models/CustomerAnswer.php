<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use Spatie\Activitylog\Traits\LogsActivity;

class CustomerAnswer extends Model
{
    //use LogsActivity;

    //protected static $logAttributes = ['question_option', 'question_id', 'option_choice', 'comment'];

    // protected static $logOnlyDirty = true;

    protected $table = "customer_answers";

    protected $fillable = ['customer_test_id', 'question_option', 'question_id', 'option_choice', 'comment'];

    public $timestamps = true;

    public function option_choice_model()
    {
        return $this->belongsTo('App\Models\QuestionOption', 'option_choice', 'id');
    }

    public function customer_test()
    {
        return $this->belongsTo('App\Models\CustomerTest', 'customer_test_id', 'id');
    }

}