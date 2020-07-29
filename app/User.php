<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'department_id', 'position_id', 'is_admin', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function asCandiateTests()
    {
        return $this->hasMany('App\Models\Test', 'candiate_id', 'id');
    }

    public function asExaminerTests()
    {
        return $this->hasMany('App\Models\Test', 'examiner_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\UserPosition', 'position_id', 'id');
    }
}