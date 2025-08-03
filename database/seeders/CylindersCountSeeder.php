<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CylindersCount;

class CylindersCountSeeder extends Seeder
{
    public function run(): void
    {
        $counts = [
            [
                'count' => 3,
                'name' => '3-Cylinder',
                'sort_order' => 1,
            ],
            [
                'count' => 4,
                'name' => '4-Cylinder',
                'sort_order' => 2,
            ],
            [
                'count' => 5,
                'name' => '5-Cylinder',
                'sort_order' => 3,
            ],
            [
                'count' => 6,
                'name' => '6-Cylinder',
                'sort_order' => 4,
            ],
            [
                'count' => 8,
                'name' => '8-Cylinder',
                'sort_order' => 5,
            ],
            [
                'count' => 10,
                'name' => '10-Cylinder',
                'sort_order' => 6,
            ],
            [
                'count' => 12,
                'name' => '12-Cylinder',
                'sort_order' => 7,
            ],
            [
                'count' => 16,
                'name' => '16-Cylinder',
                'sort_order' => 8,
            ],
        ];

        foreach ($counts as $count) {
            CylindersCount::create($count);
        }
    }
}
