<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\Test;
use App\User;
use DataTables;
use DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show report

        //Show
    }

    public function getList(Request $request)
    {
        $tests = Test::join('survey', 'tests.survey_id', '=', 'survey.id')
            ->join('users as c', 'tests.candiate_id', '=', 'c.id')
            ->join('users as e', 'tests.examiner_id', '=', 'e.id')
            ->leftJoin('departments as d1', 'c.department_id', '=', 'd1.id')
            ->leftJoin('user_position as p1', 'c.position_id', '=', 'p1.id')
            ->leftJoin('departments as d2', 'e.department_id', '=', 'd2.id')
            ->leftJoin('user_position as p2', 'e.position_id', '=', 'p2.id')
            ->where('tests.survey_round', '=', $request->survey_round_id)
            ->select([
                'tests.status as status',
                'tests.multiplier as multiplier',
                'tests.id as id',
                'survey.name as survey_name',
                DB::raw("CONCAT(c.fullname, '   ',  COALESCE(d1.department_name, ''),'  ',COALESCE(p1.name, '')) as candiate"),
                DB::raw("CONCAT(e.fullname,  COALESCE(d2.department_name, ''),'  ',COALESCE(p2.name, '')) as examiner"),
            ]);
        // Using datatable dependency
        // Đoạn code này dùng để setup dữ liệu data table
        // Link tham khảo: https://yajrabox.com/docs/laravel-datatables/master/filter-column
        return DataTables::eloquent($tests)
            ->filterColumn('candiate', function ($query, $keyword) {
                $sql = "CONCAT(c.fullname, '   ',  COALESCE(d1.department_name, ''),'  ',COALESCE(p1.name, '')) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('examiner', function ($query, $keyword) {
                $sql = "CONCAT(e.fullname,  COALESCE(d2.department_name, ''),'  ',COALESCE(p2.name, '')) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('survey_name', function ($query, $keyword) {
                $sql = "survey.name like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('status', function (Test $test) {
                if ($test->status == 1) {
                    return '<span class="badge badge-primary">Mới tạo</span>';
                };
                if ($test->status == 2) {
                    return '<span class="badge badge-info">Đang chấm</span>';
                };
                if ($test->status == 3) {
                    return '<span class="badge badge-success">Đã chấm xong</span>';
                };
            })
            ->editColumn('multiplier', function (Test $test) {
                $href = route('admin.test.update', $test->id);
                return "<input type='number' href='{$href}' class='multipiler-input' data-test-id='{$test->id}' value='{$test->multiplier}' id=''>";
            })
            ->addColumn('action', function (Test $test) {
                return '<span href="' . route('admin.test.send_survey', $test->id) . '"class="btn text-success send-test"><i class="far fa-paper-plane"></i></span>
                        <span href="' . route('admin.test.destroy', $test->id) . '" class="btn text-danger test-delete"><i class="far fa-trash-alt"></i></span>';
            })
            ->rawColumns(['action', 'status', 'multiplier'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get Survey
        $survey = Survey::all()->sortByDesc('id');
        //Get User
        //Get Send view with examiner choose, user choice
        return view('admin.pages.survey_round.create');
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
            'candiate_id' => 'required',
            'examiner_id' => 'required',
            'survey_id' => 'required|numeric',
        ], [
            'candiate_id.required' => 'Người được chấm không được để trống',
            'examiner_id.required' => 'Người chấm không được để trống',
            'survey_id.required' => 'Bài khảo sát không được để trống',
        ]);

        $list_candiate = $request->candiate_id;
        $list_examiner = $request->examiner_id;
        $survey_id = $request->survey_id;
        $survey_round_id = $request->survey_round_id;

        foreach ($list_candiate as $candiate_id) {
            $candiate = User::find($candiate_id);
            if ($candiate) {
                foreach ($list_examiner as $examiner_id) {
                    if ($this->isExsistTest($survey_round_id, $survey_id, $candiate_id, $examiner_id)) {
                        continue;
                    }
                    if ($candiate_id == $examiner_id) {
                        continue;
                    }
                    $examiner = User::find($examiner_id);
                    if ($examiner) {
                        if ($examiner->position && $candiate->position) {
                            try {
                                if ($examiner->position->level > $candiate->position->level) {
                                    $multiplier = 1;
                                }
                                if ($examiner->position->level < $candiate->position->level) {
                                    $multiplier = 3;
                                }
                                if ($examiner->position->level == $candiate->position->level) {
                                    $multiplier = 2;
                                }
                            } catch (Exception $e) {
                                break;
                            }

                        } else {
                            $multiplier = 1;
                        }
                        Test::create([
                            'survey_round' => $survey_round_id,
                            'candiate_id' => $candiate_id,
                            'examiner_id' => $examiner_id,
                            'survey_id' => $survey_id,
                            'status' => 1,
                            'multiplier' => $multiplier,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.survey_round.edit', $survey_round_id);

    }

    protected function isExsistTest($survey_round_id, $survey_id, $candiate_id, $examiner_id)
    {
        $test = Test::where([
            ['survey_round', '=', $survey_round_id],
            ['survey_id', '=', $survey_id],
            ['candiate_id', '=', $candiate_id],
            ['examiner_id', '=', $examiner_id],
        ])->get();

        if ($test->isNotEmpty()) {
            return true;
        }
        return false;
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
            'value' => 'required|integer|max:3|',
        ], [
            'value.required' => 'Trọng số không được để trống',
            'value.integer' => 'Trọng số phải là kiểu số nguyên',
            'value.max' => 'Trọng số có giá trị tối đa là 3',
        ]);
        $test = Test::findOrFail($id)->update(['multiplier' => $request->value]);
        return ['msg' => 'Cập nhật thành công trọng số'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Test::findOrFail($id)->delete();
        return ['msg' => 'Xóa thành công'];
    }

    public function sendTest($id)
    {
        $test = Test::findOrFail($id);
        if ($test->status == 1) {
            $test->update(['status' => 2]);
            return ['msg' => 'Gửi thành công bài test'];
        }
        return ['warning' => 'Bài test đã được gửi'];

    }

    /**
     * Send test to user
     *
     * @param  int  $survey_round
     * @return \Illuminate\Http\Response
     */
    public function sendSurveyToAllUser($survey_round)
    {
        Test::where('survey_round', $survey_round)->update(['status' => 2]);
        return redirect()->route('admin.survey_round.edit', $survey_round)->with('success', "Đã gửi đến tất cả user trong danh sách");
    }

}