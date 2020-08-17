<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//use Spatie\Activitylog\Traits\LogsActivity;

class CustomerTest extends Model
{
    // use LogsActivity;

    protected $table = "customer_tests";

    protected $fillable = ['survey_id', 'customer_id', 'created_by'];

    public $timestamps = true;

    //protected static $logOnlyDirty = true;

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function survey()
    {
        return $this->belongsTo('App\Models\Survey', 'survey_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\CustomerAnswer', 'customer_test_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

}