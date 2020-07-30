<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Test;
use App\User;
use Auth;
use DataTables;
use DB;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.user_tests.list');
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

    public function listTest()
    {
        $examiner = Auth::user();

        $tests = Test::join('survey', 'tests.survey_id', '=', 'survey.id')
            ->join('users as c', 'tests.candiate_id', '=', 'c.id')
            ->leftJoin('departments as d1', 'c.department_id', '=', 'd1.id')
            ->leftJoin('user_position as d2', 'c.position_id', '=', 'd2.id')
            ->join('survey_round', 'tests.survey_round', '=', 'survey_round.id')
            ->where('examiner_id', '=', $examiner->id)
            ->where('status', '<>', 1)
            ->select([
                'tests.status as status',
                'survey_round.name as survey_round',
                'tests.multiplier as multiplier',
                'tests.id as id',
                'survey.name as survey_name',
                DB::raw("CONCAT(c.fullname, '   ',  COALESCE(d1.department_name, ''),'  ',COALESCE(d2.name, '')) as candiate"),
            ]);

        return DataTables::eloquent($tests)
            ->filterColumn('candiate', function ($query, $keyword) {
                $sql = "CONCAT(c.fullname, '   ',  COALESCE(d1.department_name, ''),'  ',COALESCE(p1.name, '')) like ?";
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
                    return '<span class="badge badge-info">Chưa chấm</span>';
                };
                if ($test->status == 3) {
                    return '<span class="badge badge-success">Đã chấm xong</span>';
                };
            })
            ->editColumn('multiplier', function (Test $test) {
                $href = route('admin.test.update', $test->id);
                return $test->multiplier;
            })
            ->addColumn('action', function (Test $test) {
                return '<a href="' . route('answer.mark', $test->id) . '"class="btn text-success send-test"><i class="far fa-paper-plane"></i></a>';
            })
            ->rawColumns(['action', 'status', 'multiplier'])
            ->make(true);
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
            'test_id' => 'required|numeric',
        ]);

        if (empty($request->answer)) {
            return ['error' => 'Không tìm thấy câu trả lời!'];
        };

        foreach ($request->answer as $answer) {
            $oldAns = Answer::where([
                ['test_id', '=', $request->test_id],
                ['question_id', '=', $answer['question_id']],
            ])->first();
            if ($oldAns) {
                $oldAns->update([
                    'option_choice' => $answer['option_id'],
                    'comment' => $answer['comment'],
                ]);
            } else {
                Answer::create([
                    'option_choice' => $answer['option_id'],
                    'comment' => $answer['comment'],
                    'test_id' => $request->test_id,
                    'question_id' => $answer['question_id'],
                ]);
            };
        }

        return ['msg' => 'Cập nhật thành công kết quả!'];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTest($id)
    {
        $test = Test::findOrFail($id);

        if (Auth::user()->id !== $test->examiner->id || $test->examiner->status == 1) {
            return abort(404);
        }

        $survey = $test->survey;

        return view('admin.pages.user_tests.mark', compact('test', 'survey'));
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
        //
    }
}