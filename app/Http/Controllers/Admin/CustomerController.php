<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CustomerImport;
use App\Models\Customer;
use App\Models\CustomerAnswer;
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
        $survey = Survey::where('type', 3)->get();
        return view('admin.pages.customers.index', compact('survey'));

    }

    function list() {
        $customers = Customer::query();

        return DataTables::eloquent($customers)
            ->addIndexColumn()
            ->addColumn('action', function ($customer) {
                $tools = '<span data-toggle-for="tooltip" title="Sửa thông tin" href="' . route('admin.customer.edit', $customer->id) . '"class="btn text-success customer-edit"><i class="fas fa-user-edit" data-toggle="modal" data-target="#customer-model"></i></span>

                    <span data-toggle-for="tooltip" title="Tải khảo sát" class="btn text-info customer-survey" data-customer-id="' . $customer->id . '" data-toggle="modal" data-target="#customer-survey-model"><i class="far fa-file-alt"></i></span>

                    <a data-toggle-for="tooltip" title="Xem thống kê" target="_blank" class="customer-result" href="' . route('admin.customer_test.get_test_by_customer', $customer->id) . '" class="btn text-primary"><i class="far fa-chart-bar"></i></i></a>

                    <a data-toggle-for="tooltip" data-target="#customer-history-modal" data-toggle="modal" title="Xem lịch sử" href="' . route('history.customer_info_history', $customer->id) . '" class="btn text-warning customer-history"><i class="fa fa-history"></i></a>

                    <a data-toggle-for="tooltip" title="Xóa khách hàng" href="' . route('admin.customer.destroy', $customer->id) . '" class="btn text-danger customer-delete"><i class="far fa-trash-alt"></i></a>';

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

        $customer = Customer::create($request->all());
        return ['msg' => 'Tạo mới thành công', 'customer' => $customer];
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
            'pharmacy_name' => 'max:255',

        ], [
            'fullname.required' => 'Không được để trống tên',
            'address.max' => 'Địa chỉ tối đa 255 ký tự',
            'phone.max' => 'Số điện thoại tối đa 20 ký tự',
            'zone.max' => 'Đại bàn tối đa 255 ký tự',
            'pharmacy_name.max' => 'Tên tối đa 255 ký tự',
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

        return view('admin.pages.customers.test', compact('survey', 'customer', 'new_test'));
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

        $test = CustomerTest::findOrFail($request->test_id);

        if (empty($request->answer)) {
            return ['error' => 'Không tìm thấy câu trả lời!'];
        };

        $test_id = $request->test_id;

        $result = 1;

        $data = [];
        foreach ($request->answer as $answer) {

            // CustomerAnswer::create([
            //     'option_choice' => $answer['option_id'],
            //     'comment' => $answer['comment'],
            //     'customer_test_id' => $test_id,
            //     'question_id' => $answer['question_id'],
            // ]);

            $data[] = [
                'option_choice' => $answer['option_id'],
                'comment' => $answer['comment'],
                'customer_test_id' => $test_id,
                'question_id' => $answer['question_id'],
            ];
        }
        CustomerAnswer::insert($data);
        $test->status = 2;
        $test->save();

        return ['msg' => 'Cập nhật thành công kết quả!'];
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'customer_list' => 'mimes:xls,xlsx',
        ], [
            'customer_list.mimes' => 'File phải có định dạng xls hoặc xlsx',
        ]);

        $file = $request->file('customer_list');
        Excel::import(new CustomerImport, $file);

        return redirect()->back()->with(['success' => 'Import dữ liệu thành công']);
    }

    public function editCustomerField(Request $request, $id)
    {
        if (Auth::user()->is_admin !== 1) {
            return ['error' => 'Bạn không có quyền sửa'];
        }
        $request->validate([
            'phone' => 'max:20|string',
            'zone' => 'max:50|string',
            'fullname' => 'max:50|string',
            'address' => 'max:255|string',
        ], [
            'phone.max' => 'Số điện thoại tối đa 20 ký tự',
            'zone.max' => 'Địa bàn tốt đa 50 ký tự',
            'fullname' => 'Tên khách hàn tối đa 50 ký tự',
            'address.max' => 'Địa chỉ khách hàng tối đa 255 ký tự',
        ]);

        $customer = Customer::findOrFail($id);

        if ($request->has('fullname')) {
            $customer->update(['fullname' => $request->fullname]);
        };

        if ($request->has('zone')) {
            $customer->update(['zone' => $request->zone]);
        };

        if ($request->has('phone')) {
            $customer->update(['phone' => $request->phone]);
        };

        if ($request->has('address')) {
            $customer->update(['address' => $request->address]);
        };

        if ($request->has('pharmacy_name')) {
            $customer->update(['pharmacy_name' => $request->pharmacy_name]);
        };
        return ['success' => 'Cập nhật thành công'];
    }

}