<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LanguageSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            SettingSeeder::class,
            MenuSeeder::class,
            MenuItemSeeder::class,
            PageSeeder::class,
            HeroSliderSeeder::class,
            HomepageBlockSeeder::class,
            CategorySeeder::class,
            ArticleSeeder::class,
            ServiceSeeder::class,
            // Vehicle related seeders
            RegionalSpecSeeder::class,
            BodyTypeSeeder::class,
            SeatsCountSeeder::class,
            FuelTypeSeeder::class,
            TransmissionTypeSeeder::class,
            EngineCapacityRangeSeeder::class,
            HorsepowerRangeSeeder::class,
            CylindersCountSeeder::class,
            SteeringSideSeeder::class,
            ExteriorColorSeeder::class,
            InteriorColorSeeder::class,
            VehicleBrandSeeder::class,
            VehicleModelSeeder::class,
            VehicleSeeder::class,
            // Inquiry forms
            InquiryFormSeeder::class,
        ]);
    }
}
