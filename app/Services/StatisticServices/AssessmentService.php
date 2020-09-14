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
        $tests = $this->getUserTest();
        $survey_round = $this->getSurveyRoundInstance();
        return Excel::download(new AssessmentExport($tests, $survey_round), 'thong_ke_danh_gia_user.xlsx');
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

        $test = Test::with(
            'survey.section.questions',
            'answer.selected_option',
            'candiate',
            'answer',
            'examiner',
            'survey',
            'survey.section',
            'candiate.department',
            'candiate.position')
            ->where('survey_round', $this->survey_round_id)
            ->get();

        return $test;
    }
}