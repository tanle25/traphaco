<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserResultExport;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyRound;
use App\User;
use Excel;
use Illuminate\Http\Request;

class UserResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $survey_round_id
     * @return \Illuminate\Http\Response
     */
    public function show($survey_round_id)
    {
        $survey_round = SurveyRound::findOrFail($survey_round_id);
        return view('admin.pages.result.result_by_survey_round', compact('survey_round'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $survey_round_id, $survey_id
     * @return \Illuminate\Http\Response
     */
    public function showResultBySurvey($survey_round_id, $survey_id)
    {
        $survey_round = SurveyRound::findOrFail($survey_round_id);
        $survey = Survey::findOrFail($survey_id);
        $list_candiate = User::join('tests', 'tests.candiate_id', '=', 'users.id')
            ->where('tests.survey_round', $survey_round_id)
            ->where('tests.survey_id', $survey_id)
            ->select('users.*')
            ->groupBy('users.id')
            ->get();
        return view('admin.pages.result.survey_result', compact('list_candiate', 'survey_round', 'survey'));
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

    public function exportAll($survey_round_id, $survey_id)
    {
        ini_set('max_execution_time', '300');
        return Excel::download(new UserResultExport($survey_round_id, $survey_id), 'Kết_quả_đánh_giá.xlsx');
    }
}