<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAnswer extends Model
{
    protected $table = "customer_answers";

    protected $fillable = ['customer_test_id', 'question_option', 'question_id', 'option_choice', 'comment'];

    public $timestamps = true;

}