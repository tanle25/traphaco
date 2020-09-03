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
use Illuminate\Support\Carbon;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('marked')) {
            if ($request->marked == 1) {
                return view('admin.pages.user_tests.list', ['marked' => 1]);
            }

            if ($request->marked == 0) {
                return view('admin.pages.user_tests.list', ['marked' => 0]);
            }

        }

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

    public function listTest(Request $request)
    {
        if ($request->has('marked')) {
            if ($request->marked == 1) {
                $test = Test::where('status', '3');
            } elseif ($request->marked == 0) {
                $test = Test::where('status', '2');
            } else {
                $test = Test::query();
            }
        }
        $examiner = Auth::user();

        $tests = $test->join('survey', 'tests.survey_id', '=', 'survey.id')
            ->join('users as c', 'tests.candiate_id', '=', 'c.id')
            ->leftJoin('departments as d1', 'c.department_id', '=', 'd1.id')
            ->leftJoin('user_position as d2', 'c.position_id', '=', 'd2.id')
            ->join('survey_round', 'tests.survey_round', '=', 'survey_round.id')
            ->join('test_time', function ($join) {
                $join->on('test_time.survey_id', '=', 'survey.id')
                    ->on('test_time.survey_round_id', '=', 'survey_round.id');
            })
            ->where('examiner_id', '=', $examiner->id)
            ->where('status', '<>', 1)
            ->select([
                'tests.status as status',
                'survey_round.name as survey_round',
                'tests.multiplier as multiplier',
                'tests.id as id',
                'survey.name as survey_name',
                DB::raw("CONCAT(c.fullname, '   ',  COALESCE(d1.department_name, ''),'  ',COALESCE(d2.name, '')) as candiate"),
                'test_time.start_at as start_at',
                'test_time.end_at as end_at',
            ]);

        return DataTables::eloquent($tests)
            ->addIndexColumn()
            ->filterColumn('candiate', function ($query, $keyword) {
                $sql = "CONCAT(c.fullname, '   ',  COALESCE(d1.department_name, ''),'  ',COALESCE(d2.name, '')) like ?";
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
                if ($test->status == 3) {
                    return '<span class="badge badge-success">Đã chấm xong</span>';
                };
                if ($test->end_at < Carbon::now()) {
                    return '<span class="badge badge-danger">Quá thời gian</span>';
                };
                if ($test->status == 2) {
                    return '<span class="badge badge-info">Chưa chấm</span>';
                };
            })
            ->editColumn('multiplier', function (Test $test) {
                $href = route('admin.test.update', $test->id);
                return $test->multiplier;
            })
            ->editColumn('end_at', function (Test $test) {
                return Carbon::parse($test->end_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function (Test $test) {
                if ($test->status == 3) {
                    return '<a href="' . route('answer.re_ans', $test->id) . '"class="btn text-info send-test"><i class="far fa-edit"></i></a>';
                }
                if ($test->end_at < Carbon::now()) {
                    return '';
                };
                return '<a href="' . route('answer.mark', $test->id) . '"class="btn text-info send-test"><i class="far fa-edit"></i></a>';
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

        $test = Test::findOrFail($request->test_id);

        if ($test->getEndTime() < Carbon::now()) {
            return ['error' => "Đã quá thời gian làm bài T.T"];
        }

        if (empty($request->answer)) {
            return ['error' => 'Không tìm thấy câu trả lời!'];
        };

        DB::beginTransaction();

        try {
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
                    $test->status = 3;
                    $test->save();
                };
            }
            DB::commit();
        } catch (Exception $th) {
            DB::rollback();
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
        $test = Test::findOrFail($id);

        if (Auth::user()->id !== $test->examiner->id || $test->examiner->status == 1) {
            return abort(404);
        }

        $survey = $test->survey;

        return view('admin.pages.user_tests.edit', compact('test', 'survey'));
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