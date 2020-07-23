<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'id' => 1,
                'department_name' => 'Ban Giám đốc',
                'parent_id' => null,
                'manager_id' => null,
                'sort' => '1',
            ],
            [
                'id' => 2,
                'department_name' => 'Phòng tổ chức',
                'parent_id' => 1,
                'manager_id' => null,
                'sort' => '1',
            ],
            [
                'id' => 3,
                'department_name' => 'Phòng kinh doanh',
                'parent_id' => 1,
                'manager_id' => null,
                'sort' => '1',
            ],
            [
                'id' => 4,
                'department_name' => 'Phòng Kỹ thuật',
                'parent_id' => 1,
                'manager_id' => null,
                'sort' => '1',
            ],
            [
                'id' => 5,
                'department_name' => 'Phòng hậu cần',
                'parent_id' => 1,
                'manager_id' => null,
                'sort' => '1',
            ],
        ];
        foreach ($departments as $department) {
            DB::table('departments')->insert($department);
        }
        $user_postions = [
            [
                'name' => 'Tổng giám đốc',
                'level' => 1,
                'department_id' => 1,
            ],
            [
                'name' => 'Phó tổng giám đốc',
                'level' => 1,
                'department_id' => 1,
            ],

            [
                'name' => 'Trưởng phòng',
                'level' => 3,
                'department_id' => 2,
            ],
            [
                'name' => 'Phó trưởng phòng',
                'level' => 4,
                'department_id' => 2,
            ],
            [
                'name' => 'Tổ trưởng',
                'level' => 5,
                'department_id' => 2,
            ],
            [
                'name' => 'Nhân viên',
                'level' => 9,
                'department_id' => 2,
            ],

            [
                'name' => 'Trưởng phòng',
                'level' => 3,
                'department_id' => 3,
            ],
            [
                'name' => 'Phó trưởng phòng',
                'level' => 4,
                'department_id' => 3,
            ],
            [
                'name' => 'Tổ trưởng',
                'level' => 5,
                'department_id' => 3,
            ],
            [
                'name' => 'Nhân viên',
                'level' => 9,
                'department_id' => 3,
            ],

            [
                'name' => 'Trưởng phòng',
                'level' => 3,
                'department_id' => 4,
            ],
            [
                'name' => 'Phó trưởng phòng',
                'level' => 4,
                'department_id' => 4,
            ],
            [
                'name' => 'Tổ trưởng',
                'level' => 5,
                'department_id' => 4,
            ],
            [
                'name' => 'Nhân viên',
                'level' => 9,
                'department_id' => 4,
            ],

            [
                'name' => 'Trưởng phòng',
                'level' => 3,
                'department_id' => 5,
            ],
            [
                'name' => 'Phó trưởng phòng',
                'level' => 4,
                'department_id' => 5,
            ],
            [
                'name' => 'Tổ trưởng',
                'level' => 5,
                'department_id' => 5,
            ],
            [
                'name' => 'Nhân viên',
                'level' => 9,
                'department_id' => 5,
            ],

        ];
        foreach ($user_postions as $user_position) {
            DB::table('user_position')->insert($user_position);
        }

    }
}