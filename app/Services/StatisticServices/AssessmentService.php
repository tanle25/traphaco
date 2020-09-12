<?php

namespace App\Services\StatisticServices;

use App\Exports\AssessmentExport;
use App\Models\Test;
use App\Services\StatisticServices\BaseService;
use Excel;

/**
 * Class chịu trách nhiệm tổng hợp bài đánh giá dành cho user
 *
 */
class AssessmentService extends BaseService
{
    public function exportExcel()
    {
        //return $this->getUserTest();
        $tests = $this->getUserTest();
        return Excel::download(new AssessmentExport($tests), 'thong_ke_danh_gia_user.xlsx');
    }

    /**
     * Lấy danh sách các bài tất cả test và người được đánh giá
     *
     */
    public function getAllUserTest()
    {
        $test = Test::with('candiate')
            ->where('survey_round', $this->survey_round_id)
            ->get();

        return $test;
    }

    /**
     * Lấy danh sách các bài đánh giá cá nhân
     *
     */
    public function getUserTest()
    {
        $test = Test::with('candiate', 'survey', 'survey.section', 'candiate.department', 'candiate.position')
            ->where('survey_round', $this->survey_round_id)
            ->get()
            ->groupBy('candiate_id');
        return $test;
    }
}