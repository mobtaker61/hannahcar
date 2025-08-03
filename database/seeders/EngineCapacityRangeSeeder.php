<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EngineCapacityRange;

class EngineCapacityRangeSeeder extends Seeder
{
    public function run(): void
    {
        $ranges = [
            [
                'name' => '0-999cc',
                'min_capacity' => 0,
                'max_capacity' => 999,
                'display_name' => 'Under 1.0L',
                'sort_order' => 1,
            ],
            [
                'name' => '1000-1499cc',
                'min_capacity' => 1000,
                'max_capacity' => 1499,
                'display_name' => '1.0L - 1.5L',
                'sort_order' => 2,
            ],
            [
                'name' => '1500-1999cc',
                'min_capacity' => 1500,
                'max_capacity' => 1999,
                'display_name' => '1.5L - 2.0L',
                'sort_order' => 3,
            ],
            [
                'name' => '2000-2499cc',
                'min_capacity' => 2000,
                'max_capacity' => 2499,
                'display_name' => '2.0L - 2.5L',
                'sort_order' => 4,
            ],
            [
                'name' => '2500-2999cc',
                'min_capacity' => 2500,
                'max_capacity' => 2999,
                'display_name' => '2.5L - 3.0L',
                'sort_order' => 5,
            ],
            [
                'name' => '3000-3999cc',
                'min_capacity' => 3000,
                'max_capacity' => 3999,
                'display_name' => '3.0L - 4.0L',
                'sort_order' => 6,
            ],
            [
                'name' => '4000cc+',
                'min_capacity' => 4000,
                'max_capacity' => null,
                'display_name' => '4.0L+',
                'sort_order' => 7,
            ],
        ];

        foreach ($ranges as $range) {
            EngineCapacityRange::create($range);
        }
    }
}
