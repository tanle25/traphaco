<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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
        Permission::firstOrCreate(['name' => 'thêm user']);
        Permission::firstOrCreate(['name' => 'sửa user']);
        Permission::firstOrCreate(['name' => 'xóa user']);
        Permission::firstOrCreate(['name' => 'xem user']);

        $role2 = Role::firstOrCreate(['name' => 'quản lý user']);
        $role2->givePermissionTo('thêm user');
        $role2->givePermissionTo('sửa user');
        $role2->givePermissionTo('xóa user');
        $role2->givePermissionTo('xem user');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
    }
}