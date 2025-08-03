<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SteeringSide;

class SteeringSideSeeder extends Seeder
{
    public function run(): void
    {
        $sides = [
            [
                'name' => 'Left-Hand Drive',
                'slug' => 'left-hand-drive',
                'description' => 'Steering wheel on the left side',
                'sort_order' => 1,
            ],
            [
                'name' => 'Right-Hand Drive',
                'slug' => 'right-hand-drive',
                'description' => 'Steering wheel on the right side',
                'sort_order' => 2,
            ],
        ];

        foreach ($sides as $side) {
            SteeringSide::create($side);
        }
    }
}
