<?php

namespace App\Exports\Sheets;

use App\Models\CustomerTest;
use App\Models\Survey;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class CustomerTestResult implements FromView, WithEvents, WithDrawings
{
    public function __construct($survey_id)
    {
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

    public function view(): View
    {
        $tests = CustomerTest::with('answers')
            ->where('survey_id', $this->survey_id)
            ->orderBy('customer_id')
            ->get();
        $survey = Survey::findOrFail($this->survey_id);

        return view('excel.customer_test_result_sheet', [
            'tests' => $tests,
            'survey' => $survey,
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
        // Các tài liệu về xử lý worksheet tra trên trang https://phpspreadsheet.readthedocs.io
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
        $worksheet->getStyle('A7:E' . $max_row)->applyFromArray($styleArray);
        $worksheet->getColumnDimension('B')->setWidth(40);
        $worksheet->getColumnDimension('E')->setWidth(80);
        $worksheet->getColumnDimension('C')->setWidth(10);
        $worksheet->getStyle('A7:E' . $max_row)->getAlignment()->setWrapText(true);

        $worksheet->getStyle('A7:E' . $max_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $worksheet->getStyle('A3:E7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A7:A' . $max_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('C7:D' . $max_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    }

}