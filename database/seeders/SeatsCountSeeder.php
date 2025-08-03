<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeatsCount;

class SeatsCountSeeder extends Seeder
{
    public function run(): void
    {
        $counts = [
            [
                'count' => 2,
                'name' => 'Two Seater',
                'sort_order' => 1,
            ],
            [
                'count' => 4,
                'name' => 'Four Seater',
                'sort_order' => 2,
            ],
            [
                'count' => 5,
                'name' => 'Five Seater',
                'sort_order' => 3,
            ],
            [
                'count' => 6,
                'name' => 'Six Seater',
                'sort_order' => 4,
            ],
            [
                'count' => 7,
                'name' => 'Seven Seater',
                'sort_order' => 5,
            ],
            [
                'count' => 8,
                'name' => 'Eight Seater',
                'sort_order' => 6,
            ],
            [
                'count' => 9,
                'name' => 'Nine Seater',
                'sort_order' => 7,
            ],
            [
                'count' => 10,
                'name' => 'Ten Seater',
                'sort_order' => 8,
            ],
        ];

        foreach ($counts as $count) {
            SeatsCount::create($count);
        }
    }
}
