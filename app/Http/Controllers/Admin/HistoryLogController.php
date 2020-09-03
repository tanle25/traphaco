<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Spatie\Activitylog\Models\Activity;

class HistoryLogController extends Controller
{

    public function index()
    {
        //activity()->log('Look mum, I logged something');

        return \Auth::user()->actions;
    }

    public function customerInfoHistory()
    {
        $history_list = Activity::where('subject_type', Customer::class)->get();
        return $history_list;
    }

}