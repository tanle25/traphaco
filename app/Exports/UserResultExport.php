<?php
namespace App\Exports;

use App\Exports\Sheets\UserResult1;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UserResultExport implements WithMultipleSheets
{
    use Exportable;

    public function __construct($survey_round_id, $survey_id)
    {
        $this->survey_id = $survey_id;
        $this->survey_round_id = $survey_round_id;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new UserResult1($this->survey_round_id, $this->survey_id);

        return $sheets;
    }

}