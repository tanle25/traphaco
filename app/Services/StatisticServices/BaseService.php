<?php

namespace App\Services\StatisticServices;

use App\Models\SurveyRound;

/**
 * Class chịu trách nhiệm tổng hợp bài đánh giá dựa trên đợt khảo sát
 *
 */
abstract class BaseService
{

    public $survey_round_id;

    public function __construct($survey_round_id)
    {
        $this->survey_round_id = $survey_round_id;
    }

    abstract public function exportExcel();

    /**
     * Get survey_round model
     *
     */
    public function getSurveyRoundInstance()
    {
        return SurveyRound::where('id', $this->survey_round_id)->get();
    }

}