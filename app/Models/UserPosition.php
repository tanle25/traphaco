<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    protected $table = 'user_position';

    protected $fillable = ['level', 'name', 'department_id'];

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }

}