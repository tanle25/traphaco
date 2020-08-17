<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CustomerTestExport;
use App\Http\Controllers\Controller;
use App\Models\CustomerTest;
use DataTables;
use DB;
use Excel;
use Illuminate\Http\Request;

class CustomerTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.customer_tests.index');
    }

    public function listTest()
    {
        $tests = CustomerTest::join('survey', 'customer_tests.survey_id', '=', 'survey.id')
            ->join('customers', 'customers.id', '=', 'customer_tests.customer_id')
            ->select([
                'survey.id as survey_id',
                'survey.name as survey_name',
                DB::raw('COUNT(distinct customers.id) as customer_count'),
            ])
            ->groupBy('survey.id');

        return DataTables::eloquent($tests)
            ->addIndexColumn()
            ->addColumn('action', function ($test) {
                // if (Auth::user()->is_admin == 1) {
                //     $tools = '<span href="' . route('admin.customer.edit', $customer->id) . '"class="btn text-success customer-edit"><i class="fas fa-user-edit" data-toggle="modal" data-target="#customer-model" ></i></span>

                //     <span class="btn text-info customer-survey" data-customer-id="' . $customer->id . '" data-toggle="modal" data-target="#customer-survey-model"><i class="far fa-file-alt"></i></span>

                //     <a href="' . route('admin.customer.destroy', $customer->id) . '" class="btn text-danger customer-delete"><i class="far fa-trash-alt"></i></a>';
                // } else {
                //     $tools = '<span href="' . route('admin.customer.edit', $customer->id) . '"class="btn text-success customer-edit"><i class="fas fa-user-edit" data-toggle="modal" data-target="#customer-model" ></i></span>

                //     <span class="btn text-info customer-survey" data-customer-id="' . $customer->id . '" data-toggle="modal" data-target="#customer-survey-model"><i class="far fa-file-alt"></i></span>';
                // }

                $tools = '<a target="_blank" href="' . route('admin.customer_test.get_result_by_survey', $test->survey_id) . '"class="btn text-success customer-edit"><i class="fas fa-chart-pie" data-toggle="modal" data-target="#customer-model" ></i></a>
                    <a href="' . route('admin.customer_test.details.export', $test->survey_id) . '" class="btn text-danger customer-delete"><i class="far fa-file-excel"></i></a>';

                return $tools;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $survey_id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return  null
     */
    public function exportAll($survey_id)
    {

        return Excel::download(new CustomerTestExport($survey_id), 'thong_ke.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CustomerTest::findOrFail($id)->delete();

        return ['success' => 'Xóa bài khảo sát thành công'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $customer_id
     * @return \Illuminate\Http\Response
     */
    public function getTestsByCustomer($customer_id)
    {
        $customer_tests = CustomerTest::where('customer_id', $customer_id)
            ->get()
            ->sortByDesc('id');

        return view('admin.pages.customer_tests.tests_by_customer', compact('customer_tests'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTestDetails($id)
    {
        $test = CustomerTest::findOrFail($id);

        return view('admin.pages.customer_tests.test_details', compact('test'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTestsBySurvey($survey_id)
    {
        $customer_tests = CustomerTest::where('survey_id', $survey_id)->get()->sortByDesc('id');

        return view('admin.pages.customer_tests.tests_by_survey', compact('customer_tests'));
    }

    public function removeAllEmpty()
    {
        $tests = CustomerTest::all();
        foreach ($tests as $test) {
            $answers = $test->answers;
            $validate = $answers->filter(function ($answer) {
                if ($answer->option_choice !== null || $answer->comment !== null) {
                    return true;
                }
                return false;
            });

            if ($validate->isEmpty()) {
                CustomerTest::where('id', $test->id)->delete();
            }
        }

        return 'hello';
    }

}