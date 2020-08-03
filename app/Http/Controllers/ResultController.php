<?php

namespace App\Http\Controllers;

use App\Models\SurveyRound;
use App\Models\Test;
use Auth;
use DataTables;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.result.index');
    }

    public function listResult()
    {
        $candiate = Auth::user();

        $survey_rounds = SurveyRound::join('tests', 'survey_round.id', '=', 'tests.survey_round')
            ->join('survey', 'tests.survey_id', '=', 'survey.id')
            ->where('tests.candiate_id', '=', $candiate->id)
            ->select('survey_round.id')
            ->groupBy('survey_round.id');

        return DataTables::eloquent($survey_rounds)
            ->addColumn('test_list', function (SurveyRound $survey_round) {
                $candiate = Auth::user();
                $tests = Test::where('candiate_id', '=', $candiate->id)
                    ->where('survey_round', '=', $survey_round->id)
                    ->select('survey_id')
                    ->distinct()
                    ->get();
                $result = $tests->reduce(function ($carry, $item) {
                    return $carry . htmlspecialchars($item->survey->name) . '<br>';
                }, '');
                return $result;
            })
            ->addColumn('survey_round_name', function ($survey_round) {
                return SurveyRound::find($survey_round->id)->name;
            })
            ->addColumn('total_score', function (SurveyRound $survey_round) {
                $candiate = Auth::user();
                return $candiate->getTotalScoreBySurveyRound($survey_round->id);
            })
            ->addColumn('action', function (SurveyRound $survey_round) {
                return '';
            })
            ->rawColumns(['action', 'test_list'])
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
        //
    }
}