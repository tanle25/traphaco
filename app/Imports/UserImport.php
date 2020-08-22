<?php

namespace App\Imports;

use App\User;
//use Illuminate\Contracts\Queue\ShouldQueue;
use Hash;
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
class UserImport implements ToModel, WithChunkReading, SkipsOnFailure, WithValidation, WithStartRow
{
    use SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $customer = User::where('username', $row[2])
            ->get();

        if ($customer->isNotEmpty()) {
            User::where('username', $row[2])
                ->update([
                    'fullname' => $row[1],
                    'password' => Hash::make($row[3]),
                    'is_admin' => $row[4] ?? null,
                ]);
            return null;
        } else {
            return new User([
                'username' => $row[2],
                'fullname' => $row[1],
                'password' => Hash::make($row[3]),
                'is_admin' => $row[4] ?? null,
            ]);
        }

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
        return 2;
    }

    public function rules(): array
    {
        return [
            '1' => "required",
            '2' => "required|unique:users,username",
            '3' => 'required',
        ];
    }
}