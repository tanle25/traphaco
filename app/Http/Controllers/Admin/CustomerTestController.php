<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CustomerTestExport;
use App\Http\Controllers\Controller;
use App\Models\CustomerAnswer;
use App\Models\CustomerTest;
use Auth;
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
            ->orderByDesc('survey.id')
            ->groupBy('survey.id');

        return DataTables::eloquent($tests)
            ->addIndexColumn()
            ->addColumn('action', function ($test) {
                $tools = '<a data-toggle-for="tooltip" title="Xem thống kê" target="_blank" href="' . route('admin.customer_test.get_result_by_survey', $test->survey_id) . '"class="btn text-success customer-result-show"><i class="fas fa-chart-pie" data-toggle="modal" data-target="#customer-model" ></i></a>
                    <a data-toggle-for="tooltip" title="Xuất excel thống kê" href="' . route('admin.customer_test.details.export', $test->survey_id) . '" class="btn text-danger customer-result-excel"><i class="far fa-file-excel"></i></a>';

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
        $request->validate([
            'test_id' => 'required|numeric',
        ]);
        $test = CustomerTest::findOrFail($id);
        if (empty($request->answer)) {
            return ['error' => 'Không tìm thấy câu trả lời!'];
        };

        $test_id = $id;
        DB::beginTransaction();
        $result = [];
        try {
            foreach ($request->answer as $answer) {

                CustomerAnswer::updateOrCreate([
                    'customer_test_id' => $test_id,
                    'question_id' => $answer['question_id'],
                ], [
                    'option_choice' => $answer['option_id'],
                    'comment' => $answer['comment'],
                ]);

                $result[] = $answer['option_id'];

            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return ['msg' => 'Cập nhật thành công kết quả!'];

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
        $customer_tests = CustomerTest::with(['author', 'customer', 'survey'])
            ->where('customer_id', $customer_id)
            ->get()
            ->sortByDesc('id');

        if (Auth::user()->cannot('xem thống kê khách hàng')) {
            $customer_tests = $customer_tests->where('created_by', Auth::user()->id);
        }

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

        return view('admin.pages.customer_tests.test_details', compact('test'))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTestsBySurvey($survey_id)
    {
        $customer_tests = CustomerTest::with(['survey', 'author'])->where('survey_id', $survey_id)->get()->sortByDesc('id');

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

        return redirect()->route('admin.customer.index');
    }

}