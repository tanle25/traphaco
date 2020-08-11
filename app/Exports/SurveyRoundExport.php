<?php

namespace App\Exports;

use App\Models\Survey;
use App\Models\Test;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class SurveyRoundExport implements FromView, WithDrawings, WithEvents
{
    public function __construct($id, $candiate_id, $survey_id)
    {
        $this->id = $id;
        $this->candiate_id = $candiate_id;
        $this->survey_id = $survey_id;
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

    /**
     *
     */
    public function view(): View
    {
        $tests = Test::with('survey')
            ->where('tests.survey_round', $this->id)
            ->where('tests.candiate_id', $this->candiate_id)
            ->where('tests.survey_id', $this->survey_id)
            ->select('*')
            ->get();

        $survey = Survey::findOrFail($this->survey_id);
        $candiate = User::findorfail($this->candiate_id);

        return view('excel.user_score_result', [
            'survey' => $survey,
            'survey_round' => $this->id,
            'candiate_id' => $this->candiate_id,
            'candiate' => $candiate,
        ]);
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
        $event->sheet->getDelegate()->mergeCells('A3:G3');
        $event->sheet->getDelegate()->mergeCells('A4:G4');
        $event->sheet->getDelegate()->mergeCells('A5:C5');
        $event->sheet->getDelegate()->mergeCells('D5:G5');
        $event->sheet->getDelegate()->mergeCells('A6:A7');
        $event->sheet->getDelegate()->mergeCells('B6:B7');
        $event->sheet->getDelegate()->mergeCells('C6:F6');
        $event->sheet->getDelegate()->mergeCells('G6:G7');
    }
}