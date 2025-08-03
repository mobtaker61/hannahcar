<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ایجاد رول‌ها (اگر وجود نداشته باشند)
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $employeeRole = Role::firstOrCreate(['name' => 'Employee']);
        $sellerRole = Role::firstOrCreate(['name' => 'Seller']);

        // ایجاد مجوزها
        $permissions = [
            'view_dashboard',
            'manage_users',
            'manage_roles',
            'manage_vehicles',
            'view_vehicles',
            'manage_imports',
            'manage_parts',
            'view_parts',
            'manage_inspections',
            'view_reports',
            'manage_settings',
            'view_vin_history',
            'manage_pricing',
            'view_pricing',
            'view_analytics'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // اختصاص تمام مجوزها به Admin
        $adminRole->givePermissionTo(Permission::all());

        // اختصاص مجوزهای محدود به Employee
        $employeeRole->givePermissionTo([
            'view_dashboard',
            'manage_vehicles',
            'manage_imports',
            'manage_parts',
            'manage_inspections',
            'view_reports',
            'view_vin_history',
            'view_analytics'
        ]);

        // اختصاص مجوزهای محدود به Seller
        $sellerRole->givePermissionTo([
            'view_dashboard',
            'view_vehicles',
            'view_parts',
            'view_pricing',
            'view_vin_history'
        ]);
    }
}
