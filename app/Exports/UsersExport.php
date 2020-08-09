<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class UsersExport implements FromView, WithDrawings, WithEvents
{
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
        return view('excel.user_list', [
            'users' => User::all(),
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