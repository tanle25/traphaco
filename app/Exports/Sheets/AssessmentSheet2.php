<?php

namespace App\Exports\Sheets;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class AssessmentSheet2 implements FromView, WithEvents, WithDrawings
{
    public function __construct($tests)
    {
        $this->tests = $tests->groupBy('candiate_id');
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

    public function view(): View
    {
        return view('excel.assessment.sheet2', [
            'tests' => $this->tests,
        ]);
    }

    public static function afterSheet(AfterSheet $event)
    {
        // Các tài liệu về xử lý worksheet tra trên trang https://phpspreadsheet.readthedocs.io
        $worksheet = $event->sheet->getDelegate();
        $max_row = $worksheet->getHighestRow();
        $max_col_name = $worksheet->getHighestColumn();
        $max_col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($max_col_name);

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
        $worksheet->getStyle('A6:' . $max_col_name . $max_row)->applyFromArray($styleArray);

        $worksheet->getColumnDimension('A')->setWidth(5);
        $worksheet->getColumnDimension('B')->setWidth(20);
        $worksheet->getColumnDimension('C')->setWidth(20);
        $worksheet->getColumnDimension('D')->setWidth(10);
        $worksheet->getColumnDimension('E')->setWidth(10);
        $worksheet->getColumnDimension('F')->setWidth(10);
        $worksheet->getColumnDimension('G')->setWidth(10);

        $worksheet->getStyle('A6:G7')->getAlignment()->setVertical('center');
        $worksheet->getStyle('A6:G7')->getAlignment()->setHorizontal('center');

        $worksheet->getStyle('A6:' . $max_col_name . $max_row)->getAlignment()->setWrapText(true);

        $worksheet->getStyle('A8:' . $max_col_name . $max_row)->getAlignment()->setVertical('center');
        $worksheet->getStyle('A8:' . $max_col_name . $max_row)->getAlignment()->setHorizontal('left');

    }
}