<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'department_name',
        'manager_id',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function child()
    {
        return $this->hasMany('App\Models\Department', 'parent_id', 'id');
    }

    public function user_positions()
    {
        return $this->hasMany('App\Models\UserPosition', 'department_id', 'id');
    }

}