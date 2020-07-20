<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'username' => 'admin123',
                'name' => 'Admin',
                'email' => 'admin@123.com',
                'is_admin' => '1',
                'password' => Hash::make('admin123'),
            ],
            [
                'username' => 'user123',
                'name' => 'User',
                'email' => 'user@123.com',
                'is_admin' => '0',
                'password' => Hash::make('user123'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}