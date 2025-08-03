<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExteriorColor;

class ExteriorColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            [
                'name' => 'White',
                'slug' => 'white',
                'hex_code' => '#FFFFFF',
                'sort_order' => 1,
            ],
            [
                'name' => 'Black',
                'slug' => 'black',
                'hex_code' => '#000000',
                'sort_order' => 2,
            ],
            [
                'name' => 'Silver',
                'slug' => 'silver',
                'hex_code' => '#C0C0C0',
                'sort_order' => 3,
            ],
            [
                'name' => 'Grey',
                'slug' => 'grey',
                'hex_code' => '#808080',
                'sort_order' => 4,
            ],
            [
                'name' => 'Red',
                'slug' => 'red',
                'hex_code' => '#FF0000',
                'sort_order' => 5,
            ],
            [
                'name' => 'Blue',
                'slug' => 'blue',
                'hex_code' => '#0000FF',
                'sort_order' => 6,
            ],
            [
                'name' => 'Green',
                'slug' => 'green',
                'hex_code' => '#008000',
                'sort_order' => 7,
            ],
            [
                'name' => 'Yellow',
                'slug' => 'yellow',
                'hex_code' => '#FFFF00',
                'sort_order' => 8,
            ],
            [
                'name' => 'Orange',
                'slug' => 'orange',
                'hex_code' => '#FFA500',
                'sort_order' => 9,
            ],
            [
                'name' => 'Brown',
                'slug' => 'brown',
                'hex_code' => '#A52A2A',
                'sort_order' => 10,
            ],
            [
                'name' => 'Purple',
                'slug' => 'purple',
                'hex_code' => '#800080',
                'sort_order' => 11,
            ],
            [
                'name' => 'Pink',
                'slug' => 'pink',
                'hex_code' => '#FFC0CB',
                'sort_order' => 12,
            ],
        ];

        foreach ($colors as $color) {
            ExteriorColor::create($color);
        }
    }
}
