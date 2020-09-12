<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SurveyRoundExport;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Survey;
use App\Models\SurveyRound;
use App\Models\Test;
use App\Models\TestTime;
use App\User;
use DataTables;
use DB;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RoundSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.survey_round.index');
    }

    public function getList()
    {
        $survey_rounds = SurveyRound::query();

        return DataTables::eloquent($survey_rounds)
            ->addIndexColumn()
            ->addColumn('action', function (SurveyRound $surveyround) {
                return '<a data-toggle-for="tooltip" title="Xem thông tin" href="' . route('admin.survey_round.details', $surveyround->id) . '"class="btn text-primary survey-round-result"><i class="far fa-chart-bar "></i></a>
                        <a data-toggle-for="tooltip" title="Sửa" href="' . route('admin.survey_round.edit', $surveyround->id) . '"class="btn text-success survey-round-edit"><i class="fas fa-edit"></i></a>
                        <span data-toggle-for="tooltip" title="Xóa" href="' . route('admin.survey_round.destroy', $surveyround->id) . '" class="btn text-danger round-survey-delete"><i class="far fa-trash-alt"></i></span>';
            })
            ->editColumn('created_by', function (SurveyRound $surveyround) {
                return $surveyround->author->fullname ?? '';
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
            'name' => 'required|max:255',
        ], [
            "name.required" => 'Tên đợt đánh giá không được để trống',
        ]);

        $new_survey_round = Surveyround::create($request->all());

        return redirect()->route('admin.survey_round.edit', $new_survey_round->id);

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
        $survey_round = SurveyRound::findOrFail($id);

        $survey = Survey::all()->sortByDesc('id');

        $users = User::all()->sortBy('id');

        $departments = Department::all();

        return view('admin.pages.survey_round.edit', compact('survey_round', 'survey', 'users', 'departments'));
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
        if ($id) {
            $survey_round = SurveyRound::findOrFail($id);
        };
        $request->validate([
            'name' => 'required|max:255',
        ], [
            "name.required" => 'Tên đợt đánh giá không được để trống',
        ]);

        $survey_round->update($request->all());

        return back()->with(['success' => 'Cập nhật thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SurveyRound::findOrFail($id)->delete();
        return ['msg' => 'Xóa thành công'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        if (!$id) {
            return '';
        }
        $survey_round = SurveyRound::findOrFail($id);
        return view('admin.pages.survey_round.details', compact('survey_round'));
    }

    public function getSurveyRoundResultTable($id)
    {
        if (!$id) {
            return '';
        }
        $list_candiate = SurveyRound::join('tests', 'tests.survey_round', '=', 'survey_round.id')
            ->join('users', 'tests.candiate_id', '=', 'users.id')
            ->join('survey', 'survey.id', '=', 'tests.survey_id')
            ->where('survey_round.id', $id)
            ->where('tests.status', '<>', 1)
            ->groupBy('users.id')
            ->select([
                'users.id as candiate_id',
                'survey_round.name as survey_round_name',
                'survey_round.id as survey_round_id',
                'tests.score',
                DB::raw('GROUP_CONCAT( DISTINCT survey.name) as survey_name'),
                'users.fullname as candiate_name',
            ]);

        return DataTables::eloquent($list_candiate)
            ->addIndexColumn()
            ->addColumn('action', function ($candiate) {
                $link = route('admin.survey_round.candiate_details', ['candiate_id' => $candiate->candiate_id, 'id' => $candiate->survey_round_id]);
                return '<a data-toggle-for="tooltip" title="Xem thống kê" href="' . $link . '"class="btn text-success"><i class="far fa-chart-bar"></i></a>';
            })
            ->editColumn('candiate_id', function ($candiate) {
                return $candiate->candiate_id;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $candiate_id
     * @return \Illuminate\Http\Response
     */

    public function getUserDetails($id, $candiate_id)
    {
        $candiate = User::find($candiate_id);
        if (!$candiate) {
            return abort(404);
        }

        $tests = Test::with('survey')->leftJoin('answers', 'answers.test_id', '=', 'tests.id')
            ->join('survey', 'tests.survey_id', '=', 'survey.id')
            ->where('tests.survey_round', $id)
            ->where('tests.candiate_id', $candiate_id)
            ->select('*')
            ->groupBy('survey.id')
            ->get();

        return view('admin.pages.survey_round.user_details', compact('tests', 'candiate'));
    }

    public function exportUserTestDetails($id, $candiate_id, $survey_id)
    {
        return Excel::download(new SurveyRoundExport($id, $candiate_id, $survey_id), 'thong_ke_danh_gia.xlsx');

    }

    public function updateTime(Request $request)
    {
        $data = [];
        foreach ($request->time as $item) {
            $start = Carbon::createFromFormat('d/m/Y H:i', $item['start_at'])->format('Y-m-d H:i');
            $end = Carbon::createFromFormat('d/m/Y H:i', $item['end_at'])->format('Y-m-d H:i');

            $data[] = [
                'survey_round_id' => $request->survey_round_id,
                'survey_id' => $item['survey'],
                'start_at' => $start,
                'end_at' => $end,
            ];
        }
        foreach ($data as $item) {
            TestTime::updateOrCreate([
                'survey_round_id' => $item['survey_round_id'],
                'survey_id' => $item['survey_id'],
            ], [
                'start_at' => $item['start_at'],
                'end_at' => $item['end_at'],
            ]);
        }

        return back()->with('success', 'Cập nhật thành công');

    }

}