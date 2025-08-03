<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FuelType;

class FuelTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Petrol',
                'slug' => 'petrol',
                'description' => 'Gasoline fuel',
                'sort_order' => 1,
            ],
            [
                'name' => 'Diesel',
                'slug' => 'diesel',
                'description' => 'Diesel fuel',
                'sort_order' => 2,
            ],
            [
                'name' => 'Hybrid',
                'slug' => 'hybrid',
                'description' => 'Combination of petrol/diesel and electric',
                'sort_order' => 3,
            ],
            [
                'name' => 'Electric',
                'slug' => 'electric',
                'description' => 'Fully electric vehicle',
                'sort_order' => 4,
            ],
            [
                'name' => 'Plug-in Hybrid',
                'slug' => 'plug-in-hybrid',
                'description' => 'Hybrid with plug-in charging capability',
                'sort_order' => 5,
            ],
            [
                'name' => 'Hydrogen',
                'slug' => 'hydrogen',
                'description' => 'Hydrogen fuel cell vehicle',
                'sort_order' => 6,
            ],
        ];

        foreach ($types as $type) {
            FuelType::create($type);
        }
    }
}
