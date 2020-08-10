<?php
namespace App\Exports;

use App\Models\CustomerTest;
use App\Models\Survey;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerTestExport implements FromView
{
    public function __construct($survey_id)
    {
        $this->survey_id = $survey_id;
    }

    public function view(): View
    {
        $tests = CustomerTest::with('answers')
            ->where('survey_id', $this->survey_id)
            ->orderBy('customer_id')
            ->get();
        $survey = Survey::findOrFail($this->survey_id);

        return view('excel.customer_test_details', [
            'tests' => $tests,
            'survey' => $survey,
        ]);
    }
}