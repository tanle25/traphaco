<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveyRound;
use App\Services\StatisticServices\AssessmentService;
use Excel;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function showForm()
    {
        $survey_rounds = SurveyRound::all()->sortByDesc('id');
        return view('admin.pages.statistic.index', compact('survey_rounds'));
    }

    public function exportExcelAssessmentResult(Request $request)
    {
        $survey_round_id = $request->survey_round_id;
        $service = new AssessmentService($survey_round_id);
        $result_instance = $service->exportExcel();

        return Excel::download($result_instance, 'thong_ke_danh_gia_user.xlsx');

        return $service->exportExcel();
    }
}