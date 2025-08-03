<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ایجاد کاربر Admin
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@hannahcar.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // اختصاص رول Admin به کاربر
        $adminRole = Role::where('name', 'Admin')->first();
        if ($adminRole) {
            $adminUser->assignRole($adminRole);
        }

        // ایجاد کاربر Employee
        $employeeUser = User::firstOrCreate(
            ['email' => 'employee@hannahcar.com'],
            [
                'name' => 'Employee User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // اختصاص رول Employee به کاربر
        $employeeRole = Role::where('name', 'Employee')->first();
        if ($employeeRole) {
            $employeeUser->assignRole($employeeRole);
        }

        // ایجاد کاربر Seller
        $sellerUser = User::firstOrCreate(
            ['email' => 'seller@hannahcar.com'],
            [
                'name' => 'Seller User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // اختصاص رول Seller به کاربر
        $sellerRole = Role::where('name', 'Seller')->first();
        if ($sellerRole) {
            $sellerUser->assignRole($sellerRole);
        }

        // ایجاد کاربر تست
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Users created successfully!');
        $this->command->info('Admin: admin@hannahcar.com / password');
        $this->command->info('Employee: employee@hannahcar.com / password');
        $this->command->info('Seller: seller@hannahcar.com / password');
        $this->command->info('Test: test@example.com / password');
    }
}
