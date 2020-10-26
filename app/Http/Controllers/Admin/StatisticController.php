<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveyRound;
use App\Services\StatisticServices\AssessmentService;
use App\Services\StatisticServices\StatisticForManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ReflectionClass;
use ZipArchive;

class StatisticController extends Controller
{
    public function showForm()
    {
        $survey_rounds = SurveyRound::all()->sortByDesc('id');
        return view('admin.pages.statistic.index', compact('survey_rounds'));
    }

    private function exportByStatisticType($class_name, $survey_round_id)
    {

        // Nếu có 1 id thì tạo 1 file excel và trả về người dùng
        if (count($survey_round_id) == 1) {
            // try {
            // Khởi tạo dynamic instance
            $refl = new ReflectionClass($class_name);
            $service = $refl->newInstanceArgs(['survey_round_id' => $survey_round_id[0]]);

            $file_name = $service->exportExcel();
            if (count($file_name) == 1) {
                return response()->download(storage_path('app/temp/' . $file_name[0]))->deleteFileAfterSend(true);
            } else {
                $zipped_file = $this->zipFile($file_name, 'thong_ke.zip');
                return response()->download(storage_path('thong_ke.zip'))->deleteFileAfterSend(true);
            }
            // } catch (\Exception $e) {
            //     return $e;
            //     return redirect()
            //         ->back()
            //         ->withInput()
            //         ->with('error', 'Có lỗi trong quá trình tổng hợp. Vui lòng kiểm tra lại đợt đánh giá!');
            // }
        }
        try {
            // Tạo mới file zip
            $file_list = [];
            foreach ($survey_round_id as $id) {
                $refl = new ReflectionClass($class_name);
                $service = $refl->newInstanceArgs(['survey_round_id' => $id]);
                $file_name = $service->exportExcel();
                array_push($file_list, ...$file_name);
            };
            $zipped_file = $this->zipFile($file_list, 'thong_ke.zip');

            return response()->download(storage_path('thong_ke.zip'))->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            return $e;
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Có lỗi trong quá trình tổng hợp. Vui lòng kiểm tra lại đợt đánh giá!');
        }
    }

    protected function zipFile($file_list = [], $file_zip_name)
    {
        $zip = new ZipArchive;
        $zip->open(storage_path($file_zip_name), ZipArchive::CREATE | ZipArchive::OVERWRITE);
        // Tạo file excel thống kê và zip vào file trên
        foreach ($file_list as $file_name) {
            $zip->addFile(storage_path('app/temp/' . $file_name), $file_name);
        }
        $zip->close();
        foreach ($file_list as $file_name) {
            Storage::delete('temp/' . $file_name);
        }
        return storage_path($file_zip_name);
    }

    public function exportExcelAssessmentResult(Request $request)
    {
        $survey_round_id = $request->survey_round_id;
        $type = $request->survey_round_type;
        switch ($type) {
            case 1:
                return $this->exportByStatisticType(AssessmentService::class, $survey_round_id);
                break;

            case 2:
                return $this->exportByStatisticType(StatisticForManager::class, $survey_round_id);
                break;
            default:
                return redirect()->back()->with('error', 'Lỗi không rõ loại khảo sát');
                break;
        }
    }

}