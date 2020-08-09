<?php

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
        // $faker = Faker\Factory::create();
        // $limit = 200;

        $user = [
            [
                'username' => 'admin123',
                'fullname' => 'Admin',
                'email' => 'admin@123.com',
                'is_admin' => '1',
                'password' => Hash::make('admin123'),
            ],
            [
                'username' => 'user123',
                'fullname' => 'User',
                'email' => 'user@123.com',
                'is_admin' => '0',
                'password' => Hash::make('user123'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }

        // for ($i = 0; $i < $limit; $i++) {
        //     DB::table('users')->insert([
        //         'fullname' => $faker->name,
        //         'email' => $faker->unique()->email,
        //         'username' => $faker->unique()->username,
        //         'password' => Hash::make($faker->password),
        //         'is_admin' => '0',
        //     ]);
        // }

    }
}
