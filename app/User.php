<?php

namespace App;

use App\Models\Test;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use CausesActivity;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password', 'department_id', 'position_id', 'is_admin', 'username',
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

    public function getTotalScoreBySurveyRound($id)
    {
        $user_id = $this->id;
        $tests = Test::where('candiate_id', '=', $user_id)
            ->where('survey_round', '=', $id)
            ->get();
        $total_score = $tests->reduce(function ($carry, $item) {
            return $carry += $item->score * $item->multiplier;
        }, 0);
        $total_multiplier = $tests->reduce(function ($carry, $item) {
            return $carry += $item->multiplier;
        }, 0);
        return round($total_score / $total_multiplier, 2);
    }
}