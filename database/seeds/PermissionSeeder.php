<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        //user permission
        Permission::firstOrCreate(['name' => 'thêm user']);
        Permission::firstOrCreate(['name' => 'sửa user']);
        Permission::firstOrCreate(['name' => 'xóa user']);
        Permission::firstOrCreate(['name' => 'xem user']);
        Permission::firstOrCreate(['name' => 'quản_lý_quyền user']);

        //department permission
        Permission::firstOrCreate(['name' => 'xem phòng ban']);
        Permission::firstOrCreate(['name' => 'thêm phòng ban']);
        Permission::firstOrCreate(['name' => 'sửa phòng ban']);
        Permission::firstOrCreate(['name' => 'xóa phòng ban']);

        Permission::firstOrCreate(['name' => 'xem bộ đề']);
        Permission::firstOrCreate(['name' => 'thêm bộ đề']);
        Permission::firstOrCreate(['name' => 'sửa bộ đề']);
        Permission::firstOrCreate(['name' => 'xóa bộ đề']);

        //Khách hàng
        Permission::firstOrCreate(['name' => 'xem khách hàng']);
        Permission::firstOrCreate(['name' => 'thêm khách hàng']);
        Permission::firstOrCreate(['name' => 'sửa khách hàng']);
        Permission::firstOrCreate(['name' => 'xóa khách hàng']);

        Permission::firstOrCreate(['name' => 'xem bài khảo sát khách hàng']);
        Permission::firstOrCreate(['name' => 'thêm bài khảo sát khách hàng']);
        Permission::firstOrCreate(['name' => 'sửa bài khảo sát khách hàng']);
        Permission::firstOrCreate(['name' => 'xóa bài khảo sát khách hàng']);

        Permission::firstOrCreate(['name' => 'xem thống kê khách hàng']);
        Permission::firstOrCreate(['name' => 'xuất_excel thống kê khách hàng']);

        // Đánh giá user
        Permission::firstOrCreate(['name' => 'xem đợt đánh giá']);
        Permission::firstOrCreate(['name' => 'thêm đợt đánh giá']);
        Permission::firstOrCreate(['name' => 'sửa đợt đánh giá']);
        Permission::firstOrCreate(['name' => 'xóa đợt đánh giá']);

        Permission::firstOrCreate(['name' => 'xem báo cáo đợt đánh giá']);
        Permission::firstOrCreate(['name' => 'xuất_excel báo cáo đợt đánh giá']);

        // bài đánh giá
        Permission::firstOrCreate(['name' => 'xem bài đánh giá']);
        Permission::firstOrCreate(['name' => 'thêm bài đánh giá']);
        Permission::firstOrCreate(['name' => 'sửa bài đánh giá']);
        Permission::firstOrCreate(['name' => 'gửi bài đánh giá']);
        Permission::firstOrCreate(['name' => 'xóa bài đánh giá']);

        Permission::firstOrCreate(['name' => 'sửa bài đánh giá đã làm']);
        Permission::firstOrCreate(['name' => 'xem thống kê cá nhân']);
        Permission::firstOrCreate(['name' => 'xuất_excel thống kê cá nhân']);

        // Xem và chỉnh sửa quyền
        Permission::firstOrCreate(['name' => 'quản_lý quyền']);

        // gets all permissions via Gate::before rule; see AuthServiceProvider
    }
}