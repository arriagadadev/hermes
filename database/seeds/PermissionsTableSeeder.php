<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'organization_view', 'description' => '']);
        Permission::create(['name' => 'organization_edit', 'description' => '']);
        Permission::create(['name' => 'organization_delete', 'description' => '']);

        Permission::create(['name' => 'users_view', 'description' => '']);
        Permission::create(['name' => 'users_edit', 'description' => '']);
        Permission::create(['name' => 'users_add', 'description' => '']);
        Permission::create(['name' => 'users_create', 'description' => '']);
        Permission::create(['name' => 'users_remove', 'description' => '']);

        Permission::create(['name' => 'devices_create', 'description' => '']);
        Permission::create(['name' => 'devices_edit', 'description' => '']);
        Permission::create(['name' => 'devices_delete', 'description' => '']);
        Permission::create(['name' => 'devices_insert_measurements', 'description' => '']);
        Permission::create(['name' => 'devices_export_measurements', 'description' => '']);
    }
}
