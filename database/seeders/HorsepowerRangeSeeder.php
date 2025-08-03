<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HorsepowerRange;

class HorsepowerRangeSeeder extends Seeder
{
    public function run(): void
    {
        $ranges = [
            [
                'name' => '0-99hp',
                'min_horsepower' => 0,
                'max_horsepower' => 99,
                'display_name' => 'Under 100hp',
                'sort_order' => 1,
            ],
            [
                'name' => '100-199hp',
                'min_horsepower' => 100,
                'max_horsepower' => 199,
                'display_name' => '100-200hp',
                'sort_order' => 2,
            ],
            [
                'name' => '200-299hp',
                'min_horsepower' => 200,
                'max_horsepower' => 299,
                'display_name' => '200-300hp',
                'sort_order' => 3,
            ],
            [
                'name' => '300-399hp',
                'min_horsepower' => 300,
                'max_horsepower' => 399,
                'display_name' => '300-400hp',
                'sort_order' => 4,
            ],
            [
                'name' => '400-499hp',
                'min_horsepower' => 400,
                'max_horsepower' => 499,
                'display_name' => '400-500hp',
                'sort_order' => 5,
            ],
            [
                'name' => '500-599hp',
                'min_horsepower' => 500,
                'max_horsepower' => 599,
                'display_name' => '500-600hp',
                'sort_order' => 6,
            ],
            [
                'name' => '600hp+',
                'min_horsepower' => 600,
                'max_horsepower' => null,
                'display_name' => '600hp+',
                'sort_order' => 7,
            ],
        ];

        foreach ($ranges as $range) {
            HorsepowerRange::create($range);
        }
    }
}
