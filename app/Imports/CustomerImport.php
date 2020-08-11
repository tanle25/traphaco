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
        if ($row[1] == '' && $row[2] == '' && $row[3] == '') {
            return new Customer([
                'DMS_code' => $row[1],
                'CRM_code' => $row[2],
                'contract_code' => $row[3],
                'pharmacy_name' => $row[4],
                'fullname' => $row[5],
                'address' => $row[6],
                'phone' => \str_replace('.', '', $row[7]),
                'zone' => $row[8],
                'sale_chanel' => $row[9],
            ]);
        }

        return Customer::where('DMS_code', $row[1])
            ->orWhere('CRM_code', $row[2])
            ->orWhere('contract_code', $row[3])
            ->updateOrCreate([
                'DMS_code' => $row[1],
                'CRM_code' => $row[2],
                'contract_code' => $row[3],
                'pharmacy_name' => $row[4],
                'fullname' => $row[5],
                'address' => $row[6],
                'phone' => \str_replace('.', '', $row[7]),
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

            // Can also use callback validation rules

        ];
    }
}