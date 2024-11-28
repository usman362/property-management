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
            'view-dashboard',
            'view-buildings',
            'add-buildings',
            'edit-buildings',
            'delete-buildings',
            'view-apartments',
            'add-apartments',
            'edit-apartments',
            'delete-apartments',
            'view-tenants',
            'add-tenants',
            'edit-tenants',
            'delete-tenants',
            'view-maintenance',
            'add-maintenance',
            'edit-maintenance',
            'delete-maintenance',
            'view-users',
            'add-users',
            'edit-users',
            'delete-users',
            'view-roles',
            'view-permissions',
            'add-roles',
            'edit-roles',
            'delete-roles',
            'view-apartment-comments',
            'action-apartment-comments',
            'view-applications',
            'action-applications',
            'view-maintenance-report',
            'view-tenant-report',
            'view-basic-settings',
            'view-color-settings',
            'view-profile-settings',
            'view-password-settings',
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
