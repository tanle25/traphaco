<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CustomerImport;
use App\Models\Customer;
use App\Models\CustomerTest;
use App\Models\Survey;
use Auth;
use DataTables;
use Excel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show list customer

        // show button add customer

        //show btn edit customer

        //show btn import excel
        $survey = Survey::where('type', 3)->get();
        //return view

        return view('admin.pages.customers.index', compact('survey'));

    }

    function list() {
        $customers = Customer::query();

        return DataTables::eloquent($customers)
            ->addColumn('action', function ($customer) {
                if (Auth::user()->is_admin == 1) {
                    $tools = '<span href="' . route('admin.customer.edit', $customer->id) . '"class="btn text-success customer-edit"><i class="fas fa-user-edit" data-toggle="modal" data-target="#customer-model" ></i></span>

                    <span class="btn text-info customer-survey" data-customer-id="' . $customer->id . '" data-toggle="modal" data-target="#customer-survey-model"><i class="far fa-file-alt"></i></span>

                    <a href="' . route('admin.customer.destroy', $customer->id) . '" class="btn text-danger customer-delete"><i class="far fa-trash-alt"></i></a>';
                } else {
                    $tools = '<span href="' . route('admin.customer.edit', $customer->id) . '"class="btn text-success customer-edit"><i class="fas fa-user-edit" data-toggle="modal" data-target="#customer-model" ></i></span>

                    <span href="' . route('admin.customer.destroy', $customer->id) . '" class="btn text-danger
                    customer-delete"><i class="far fa-file-alt"></i></span>';
                }

                return $tools;
            })
            ->rawColumns(['action'])
            ->make(true);
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
        $request->validate([
            'fullname' => 'required|max:100',
            'address' => 'max:255',
            'phone' => 'max:20',
            'zone' => 'max:255',
        ], [
            'fullname.required' => 'Không được để trống tên',
            'address.max' => 'Địa chỉ tối đa 255 ký tự',
            'phone.max' => 'Số điện thoại tối đa 20 ký tự',
            'zone.max' => 'Đại bàn tối đa 255 ký tự',
        ]);

        Customer::create($request->all());
        return ['msg' => 'Tạo mới thành công'];
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
        $customer = Customer::findOrFail($id);
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $customer = Customer::findOrFail($request->id);

        $validated_data = $request->validate([
            'fullname' => 'required|max:100',
            'address' => 'max:255',
            'phone' => 'max:20',
            'zone' => 'max:255',
        ], [
            'fullname.required' => 'Không được để trống tên',
            'address.max' => 'Địa chỉ tối đa 255 ký tự',
            'phone.max' => 'Số điện thoại tối đa 20 ký tự',
            'zone.max' => 'Đại bàn tối đa 255 ký tự',
        ]);

        $customer->update($validated_data);
        return ['msg' => 'Cập nhật thành công'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();

        return redirect()->back()->with(['success' => 'Xóa khách hàng thành công']);
    }

    public function createTestAndSend(Request $request)
    {
        $request->validate([
            'survey_id' => 'required|integer',
            'customer_id' => 'required|integer',
        ], [
            'survey_id.required' => 'Không tìm thấy bài khảo sát',
            'customer_id.required' => 'Không tìm thấy khách hàng',
        ]);

        $survey = Survey::findOrFail($request->survey_id);
        if ($survey->type !== 3) {
            return ['error' => 'Không tìm thấy dữ liệu!'];
        }

        $customer = Customer::findOrFail($request->customer_id);

        $new_test = new CustomerTest;
        $new_test->survey_id = $request->survey_id;
        $new_test->customer_id = $request->customer_id;
        $new_test->created_by = $request->created_by;
        $new_test->status = 1;

        $new_test->save();

        return view('admin.pages.customers.test', compact('survey', 'customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCustomerAnswer(Request $request)
    {
        $request->validate([
            'test_id' => 'required|numeric',
        ]);

        $test = Test::findOrFail($request->test_id);

        if (empty($request->answer)) {
            return ['error' => 'Không tìm thấy câu trả lời!'];
        };

        foreach ($request->answer as $answer) {
            Answer::create([
                'option_choice' => $answer['option_id'],
                'comment' => $answer['comment'],
                'test_id' => $request->test_id,
                'question_id' => $answer['question_id'],
            ]);
            $test->status = 2;
            $test->save();
        }

        return ['msg' => 'Cập nhật thành công kết quả!', 'score' => $total_score];
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'customer_list' => 'mimes:xls,xlsx',
        ], [
            'customer_list.mimes' => 'File phải có định dạng xls hoặc xlsx',
        ]);

        $file = $request->file('customer_list');
        Excel::queueImport(new CustomerImport, $file);

        try {
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect()->back()->with(['error' => 'Import dữ liệu không thành công  <br> Ban kiem tra lai dinh dang']);

        }
        return redirect()->back()->with(['success' => 'Import dữ liệu thành công']);
    }

    public function editCustomerField(Request $request){
        
    }
}