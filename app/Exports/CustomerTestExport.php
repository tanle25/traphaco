<?php
namespace App\Exports;

use App\Exports\Sheets\CustomerTestDetails;
use App\Exports\Sheets\CustomerTestResult;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CustomerTestExport implements WithMultipleSheets
{
    use Exportable;

    public function __construct($survey_id)
    {
        $this->survey_id = $survey_id;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new CustomerTestDetails($this->survey_id);

        $sheets[] = new CustomerTestResult($this->survey_id);

        return $sheets;
    }

}