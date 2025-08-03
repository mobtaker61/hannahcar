<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegionalSpec;

class RegionalSpecSeeder extends Seeder
{
    public function run(): void
    {
        $specs = [
            [
                'name' => 'GCC',
                'slug' => 'gcc',
                'description' => 'Gulf Cooperation Council specifications',
                'sort_order' => 1,
            ],
            [
                'name' => 'American',
                'slug' => 'american',
                'description' => 'American market specifications',
                'sort_order' => 2,
            ],
            [
                'name' => 'European',
                'slug' => 'european',
                'description' => 'European market specifications',
                'sort_order' => 3,
            ],
            [
                'name' => 'Japanese',
                'slug' => 'japanese',
                'description' => 'Japanese market specifications',
                'sort_order' => 4,
            ],
            [
                'name' => 'Canadian',
                'slug' => 'canadian',
                'description' => 'Canadian market specifications',
                'sort_order' => 5,
            ],
            [
                'name' => 'Australian',
                'slug' => 'australian',
                'description' => 'Australian market specifications',
                'sort_order' => 6,
            ],
        ];

        foreach ($specs as $spec) {
            RegionalSpec::create($spec);
        }
    }
}
