<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransmissionType;

class TransmissionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Automatic',
                'slug' => 'automatic',
                'description' => 'Automatic transmission',
                'sort_order' => 1,
            ],
            [
                'name' => 'Manual',
                'slug' => 'manual',
                'description' => 'Manual transmission',
                'sort_order' => 2,
            ],
            [
                'name' => 'CVT',
                'slug' => 'cvt',
                'description' => 'Continuously Variable Transmission',
                'sort_order' => 3,
            ],
            [
                'name' => 'Semi-Automatic',
                'slug' => 'semi-automatic',
                'description' => 'Semi-automatic transmission',
                'sort_order' => 4,
            ],
            [
                'name' => 'DCT',
                'slug' => 'dct',
                'description' => 'Dual Clutch Transmission',
                'sort_order' => 5,
            ],
            [
                'name' => 'AMT',
                'slug' => 'amt',
                'description' => 'Automated Manual Transmission',
                'sort_order' => 6,
            ],
        ];

        foreach ($types as $type) {
            TransmissionType::create($type);
        }
    }
}
