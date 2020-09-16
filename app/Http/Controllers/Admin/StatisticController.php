<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveyRound;
use App\Services\StatisticServices\AssessmentService;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

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
        // Nếu có 1 id thì tạo 1 file excel và trả về người dùng
        if (count($survey_round_id) == 1) {
            try {
                $service = new AssessmentService($survey_round_id[0]);
                $result_instance = $service->exportExcel();
                return Excel::download($result_instance, 'thong_ke.xlsx');

            } catch (\Exception $e) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Có lỗi trong quá trình tổng hợp. Vui lòng kiểm tra lại đợt đánh giá!');
            }
        }

        try {
            // Tạo mới file zip
            $zip = new ZipArchive;
            $zip->open(public_path('thong_ke.zip'), ZipArchive::CREATE | ZipArchive::OVERWRITE);
            // Tạo file excel thống kê và zip vào file trên
            foreach ($survey_round_id as $index => $id) {
                $service = new AssessmentService($id);
                $survey_round = SurveyRound::find($id);
                $name = 'Thống kê ' . $index . $survey_round->name . '.xlsx';
                $result_instance = $service->exportExcel();
                Excel::store($result_instance, $name, 'temp');
                //$relativeNameInZipFile = basename($name);
                $zip->addFile(storage_path('temp/' . $name), $name);
                Storage::delete('temp/' . $name);
            }
            $zip->close();
            // tải file zip
            return response()->download(public_path('thong_ke.zip'));

        } catch (\Exception $e) {
            return $e;
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Có lỗi trong quá trình tổng hợp. Vui lòng kiểm tra lại đợt đánh giá!');
        }

    }
}