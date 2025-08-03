<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InteriorColor;

class InteriorColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            [
                'name' => 'Beige',
                'slug' => 'beige',
                'hex_code' => '#F5F5DC',
                'sort_order' => 1,
            ],
            [
                'name' => 'Black',
                'slug' => 'black',
                'hex_code' => '#000000',
                'sort_order' => 2,
            ],
            [
                'name' => 'Grey',
                'slug' => 'grey',
                'hex_code' => '#808080',
                'sort_order' => 3,
            ],
            [
                'name' => 'Brown',
                'slug' => 'brown',
                'hex_code' => '#A52A2A',
                'sort_order' => 4,
            ],
            [
                'name' => 'White',
                'slug' => 'white',
                'hex_code' => '#FFFFFF',
                'sort_order' => 5,
            ],
            [
                'name' => 'Red',
                'slug' => 'red',
                'hex_code' => '#FF0000',
                'sort_order' => 6,
            ],
            [
                'name' => 'Blue',
                'slug' => 'blue',
                'hex_code' => '#0000FF',
                'sort_order' => 7,
            ],
            [
                'name' => 'Green',
                'slug' => 'green',
                'hex_code' => '#008000',
                'sort_order' => 8,
            ],
        ];

        foreach ($colors as $color) {
            InteriorColor::create($color);
        }
    }
}
