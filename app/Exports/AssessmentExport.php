<?php

namespace App\Exports;

use App\Exports\Sheets\AssessmentSheet1;
use App\Exports\Sheets\AssessmentSheet2;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AssessmentExport implements WithMultipleSheets
{

    public function __construct($tests)
    {
        $this->tests = $tests;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new AssessmentSheet1($this->tests);
        $sheets[] = new AssessmentSheet2($this->tests);

        return $sheets;
    }

}