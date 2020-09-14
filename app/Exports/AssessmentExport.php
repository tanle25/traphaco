<?php

namespace App\Exports;

use App\Exports\Sheets\AssessmentSheet1;
use App\Exports\Sheets\AssessmentSheet2;
use App\Exports\Sheets\AssessmentSheet3;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AssessmentExport implements WithMultipleSheets
{

    public function __construct($tests, $survey_round)
    {
        $this->tests = $tests;
        $this->survey_round = $survey_round;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new AssessmentSheet1($this->tests);
        $sheets[] = new AssessmentSheet2($this->tests);
        $sheets[] = new AssessmentSheet3($this->tests, $this->survey_round);

        return $sheets;
    }

}