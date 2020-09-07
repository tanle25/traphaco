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
        $history_list = Activity::with('subject')
            ->with('causer')
            ->where('subject_type', Customer::class)
            ->orderByDesc('id')
            ->get();
        return view('admin.pages.history.customer_info', compact('history_list'));
        //return $history_list;
    }

}