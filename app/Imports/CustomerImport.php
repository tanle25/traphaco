<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

class CustomerImport implements ToModel, WithChunkReading, ShouldQueue, SkipsOnFailure, WithValidation
{
    use SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new Customer([
            'DMS_code' => $row[1],
            'CRM_code' => $row[2],
            'fullname' => $row[3],
            'address' => $row[4],
            'phone' => $row[5],
            'zone' => $row[6],
            'sale_chanel' => $row[7],
        ]);

    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            //'1' => 'max:10|unique:customers,DMS_code',
            //'2' => 'max:10|unique:customers,CRM_code',
            '3' => 'max:50',
            '4' => 'max:255',
            '5' => 'max:20',
            '6' => 'max:50',

            // Above is alias for as it always validates in batches
            //'*.1' => 'max:10|unique:customers,DMS_code',
            //'*.2' => 'max:10|unique:customers,CRM_code',
            '*.3' => 'max:50',
            '*.4' => 'max:255',
            '*.5' => 'max:20',
            '*.6' => 'max:50',

            // Can also use callback validation rules

        ];
    }
}