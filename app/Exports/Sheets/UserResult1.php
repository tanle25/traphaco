<?php

namespace App\Exports\Sheets;

use App\Models\Survey;
use App\Models\SurveyRound;
use App\Models\Test;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class UserResult1 implements FromView, WithEvents, WithDrawings
{
    public function __construct($survey_round_id, $survey_id)
    {
        $this->survey_id = $survey_id;
        $this->survey_round_id = $survey_round_id;
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            // Array callable, refering to a static method.
            AfterSheet::class => [self::class, 'afterSheet'],
        ];
    }

    public function view(): View
    {
        $survey_round = SurveyRound::findOrFail($this->survey_round_id);
        $survey = Survey::findOrFail($this->survey_id);
        $list_candiate = User::join('tests', 'tests.candiate_id', '=', 'users.id')
            ->where('tests.survey_round', $this->survey_round_id)
            ->where('tests.survey_id', $this->survey_id)
            ->select('users.*')
            ->groupBy('users.id')
            ->get();

        $tests = Test::with(
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
            ->where('survey_id', $this->survey_id)
            ->get()
            ->groupBy(['candiate_id']);

        $result = [];
        foreach ($tests as $candiate_test) {

            $candiate_score = [];
            $candiate_score['candiate_name'] = $candiate_test->first() ? $candiate_test->first()->candiate->fullname : "";
            $candiate_score['score_from_level_3'] = $this->getScoreByTest($candiate_test, 3);
            $candiate_score['score_from_level_2'] = $this->getScoreByTest($candiate_test, 2);
            $candiate_score['score_from_level_1'] = $this->getScoreByTest($candiate_test, 1);

            $denominator = ($candiate_score['score_from_level_3'] != 0 ? 3 : 0) + ($candiate_score['score_from_level_2'] != 0 ? 2 : 0) + ($candiate_score['score_from_level_1'] != 0 ? 1 : 0); //m???u s???
            if ($denominator === 0) {
                $denominator = 1;
            }

            $avg_score = ($candiate_score['score_from_level_3'] * 3 + $candiate_score['score_from_level_2'] * 2 + $candiate_score['score_from_level_1']) / ($denominator) ?? 0;
            $candiate_score['avg_score'] = round($avg_score, 2);
            $candiate_score['percent'] = round(($avg_score / 3 * 100), 2);
            $result[] = $candiate_score;
        }
        return view('excel.user_result_sheet_1', compact('result', 'survey_round', 'survey'));

    }

    private function getScoreByTest($test_list, $multiplier)
    {
        $count = $test_list->where('multiplier', $multiplier)->count();
        if ($count == 0) {
            $count = 1;
        }

        $result = $test_list->reduce(function ($total, $item) use ($multiplier) {
            if ($item->multiplier === $multiplier) {
                return $total + $item->totalScore();
            }
            return $total;
        }, 0);
        return $result / $count ?? 0;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/logo_vi.png'));
        $drawing->setHeight(40);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public static function afterSheet(AfterSheet $event)
    {
        // C??c t??i li???u v??? x??? l?? worksheet tra tr??n trang https://phpspreadsheet.readthedocs.io
        $worksheet = $event->sheet->getDelegate();
        $max_row = $event->sheet->getDelegate()->getHighestRow();
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
                'inside' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];
        $worksheet->getStyle('A7:H' . $max_row)->applyFromArray($styleArray);
        $worksheet->getColumnDimension('A')->setWidth(4);
        $worksheet->getColumnDimension('B')->setWidth(25);
        $worksheet->getColumnDimension('C')->setWidth(12);
        $worksheet->getColumnDimension('D')->setWidth(12);
        $worksheet->getColumnDimension('E')->setWidth(12);
        $worksheet->getColumnDimension('F')->setWidth(18);
        $worksheet->getColumnDimension('G')->setWidth(11);

        $worksheet->getStyle('C8')->getFont()->setBold(true);
        $worksheet->getStyle('A7:H' . $max_row)->getAlignment()->setWrapText(true);

        $worksheet->getStyle('A7:H' . $max_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $worksheet->getStyle('A3:H7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A7:A' . $max_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('C7:H' . $max_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $worksheet->getRowDimension('5')->setRowHeight(40);
        $worksheet->getStyle('B5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    }

}