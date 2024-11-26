<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            'user-list-all',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        try {
            $admin = Role::firstOrCreate(['name' => 'Admin']);
            $admin ? $admin->syncPermissions(Permission::pluck("id")->all()) : "";
        } catch (\Exception $e) {
            echo $e->getMessage() . ' on line ' . $e->getLine();
        }
    }
}
