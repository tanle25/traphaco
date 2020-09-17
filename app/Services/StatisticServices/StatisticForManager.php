<?php

namespace App\Services\StatisticServices;

use App\Exports\UserResultExport;
use App\Models\Test;
use App\Services\StatisticServices\BaseService;
use Excel;
use Str;

/**
 * Class chịu trách nhiệm tổng hợp bài đánh giá dành cho user
 *
 */
class StatisticForManager extends BaseService
{

    public function exportExcel()
    {
        $tests = $this->getUserTest();
        $survey_round = $this->getSurveyRoundInstance();
        $survey_list = $survey_round->getSurveyList();
        //return new AssessmentExport($tests, $survey_round);
        $result = [];
        foreach ($survey_list as $survey) {
            $name = $survey_round->name . '/' . $survey->name ?? '';
            $excel_file = Excel::store(new UserResultExport($this->survey_round_id, $survey->id), Str::slug($name, '_') . 'xlsx', 'temp');
            $result[] = $name;
        }

        return $result;
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