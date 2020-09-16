<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Customer;
use App\Models\CustomerAnswer;
use App\Models\CustomerTest;
use App\Models\Test;
use Spatie\Activitylog\Models\Activity;

class HistoryLogController extends Controller
{

    public function index()
    {
        //activity()->log('Look mum, I logged something');
        return \Auth::user()->actions;
    }

    public function customerInfoHistory($id)
    {
        $history_list = Activity::with('subject')
            ->with('causer')
            ->where('subject_type', Customer::class)
            ->where('subject_id', $id)
            ->orderByDesc('id')
            ->get();
        return view('admin.pages.history.customer_info', compact('history_list'))->render();
    }

    /**
     * @param Test $test_id
     *
     * @return history of test
     */
    public function getUserTestHistory($test_id)
    {
        $test = Test::with('survey')->findOrFail($test_id);

        $history_list = Activity::with('causer')
            ->with('subject')
            ->join('answers', 'activity_log.subject_id', '=', 'answers.id')
            ->join('tests', 'answers.test_id', '=', 'tests.id')
            ->where('tests.id', $test_id)
            ->where('subject_type', Answer::class)
            ->select('activity_log.*')
            ->get();

        //return $history_list;

        return view('admin.pages.history.test_history_ajax', compact('test', 'history_list'));
        $test = Test::findOrfail($test_id);
    }

    /**
     * @param Test $test_id
     *
     * @return history of test
     */
    public function getCustomerTestHistory($test_id)
    {
        $test = CustomerTest::with('survey')->findOrFail($test_id);

        $history_list = Activity::with('causer')
            ->with('subject')
            ->join('customer_answers', 'activity_log.subject_id', '=', 'customer_answers.id')
            ->join('customer_tests', 'customer_answers.customer_test_id', '=', 'customer_tests.id')
            ->where('customer_tests.id', $test_id)
            ->where('subject_type', CustomerAnswer::class)
            ->select('activity_log.*')
            ->get();

        //return $history_list;

        return view('admin.pages.history.customer_test_history_ajax', compact('test', 'history_list'));
        $test = Test::findOrfail($test_id);
    }

}