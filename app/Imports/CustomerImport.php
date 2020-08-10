<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

/**
 *
 *
 *
 *
 */
class CustomerImport implements ToModel, WithChunkReading, SkipsOnFailure, WithValidation, WithStartRow, ShouldQueue
{
    use SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        return Customer::firstOrCreate([
            'DMS_code' => $row[1],
            'CRM_code' => $row[2],
        ], [
            'DMS_code' => $row[1],
            'CRM_code' => $row[2],
            'contract_code' => $row[3],
            'pharmacy_name' => $row[4],
            'fullname' => $row[5],
            'address' => $row[6],
            'phone' => $row[7],
            'zone' => $row[8],
            'sale_chanel' => $row[9],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 4;
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