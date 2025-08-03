<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BodyType;

class BodyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Sedan',
                'slug' => 'sedan',
                'description' => 'Four-door passenger car with a separate trunk',
                'sort_order' => 1,
            ],
            [
                'name' => 'Hatchback',
                'slug' => 'hatchback',
                'description' => 'Car with a rear door that opens upward',
                'sort_order' => 2,
            ],
            [
                'name' => 'SUV',
                'slug' => 'suv',
                'description' => 'Sport Utility Vehicle - high ground clearance',
                'sort_order' => 3,
            ],
            [
                'name' => 'Pickup Truck',
                'slug' => 'pickup-truck',
                'description' => 'Truck with an open cargo area',
                'sort_order' => 4,
            ],
            [
                'name' => 'Coupe',
                'slug' => 'coupe',
                'description' => 'Two-door car with a sloping rear roofline',
                'sort_order' => 5,
            ],
            [
                'name' => 'Convertible',
                'slug' => 'convertible',
                'description' => 'Car with a retractable roof',
                'sort_order' => 6,
            ],
            [
                'name' => 'Crossover',
                'slug' => 'crossover',
                'description' => 'Car-based SUV with unibody construction',
                'sort_order' => 7,
            ],
            [
                'name' => 'Wagon',
                'slug' => 'wagon',
                'description' => 'Car with extended cargo area',
                'sort_order' => 8,
            ],
            [
                'name' => 'Van',
                'slug' => 'van',
                'description' => 'Large passenger or cargo vehicle',
                'sort_order' => 9,
            ],
            [
                'name' => 'Sports Car',
                'slug' => 'sports-car',
                'description' => 'High-performance car designed for speed',
                'sort_order' => 10,
            ],
        ];

        foreach ($types as $type) {
            BodyType::create($type);
        }
    }
}
