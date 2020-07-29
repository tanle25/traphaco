<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyRound;
use App\User;
use DataTables;
use Illuminate\Http\Request;

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
            ->addColumn('action', function (SurveyRound $surveyround) {
                return '<a href="' . route('admin.survey_round.edit', $surveyround->id) . '"class="btn text-success"><i class="fas fa-user-edit"></i></a>
                        <span href="' . route('admin.survey_round.destroy', $surveyround->id) . '" class="btn text-danger round-survey-delete"><i class="far fa-trash-alt"></i></span>';
            })
            ->editColumn('created_by', function (SurveyRound $surveyround) {
                return $surveyround->author->fullname;
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
            "name.required" => 'Tên đợt khảo sát không được để trống',
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

        return view('admin.pages.survey_round.edit', compact('survey_round', 'survey', 'users'));
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
            "name.required" => 'Tên đợt khảo sát không được để trống',
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
}