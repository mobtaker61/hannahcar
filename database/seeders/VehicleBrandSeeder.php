<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleBrand;

class VehicleBrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Mercedes-Benz',
                'slug' => 'mercedes-benz',
                'description' => 'German luxury automobile manufacturer',
                'website' => 'https://www.mercedes-benz.com',
                'sort_order' => 1,
            ],
            [
                'name' => 'BMW',
                'slug' => 'bmw',
                'description' => 'German multinational corporation which produces luxury vehicles',
                'website' => 'https://www.bmw.com',
                'sort_order' => 2,
            ],
            [
                'name' => 'Audi',
                'slug' => 'audi',
                'description' => 'German automobile manufacturer of luxury vehicles',
                'website' => 'https://www.audi.com',
                'sort_order' => 3,
            ],
            [
                'name' => 'Toyota',
                'slug' => 'toyota',
                'description' => 'Japanese multinational automotive manufacturer',
                'website' => 'https://www.toyota.com',
                'sort_order' => 4,
            ],
            [
                'name' => 'Honda',
                'slug' => 'honda',
                'description' => 'Japanese multinational conglomerate manufacturer',
                'website' => 'https://www.honda.com',
                'sort_order' => 5,
            ],
            [
                'name' => 'Nissan',
                'slug' => 'nissan',
                'description' => 'Japanese multinational automobile manufacturer',
                'website' => 'https://www.nissan.com',
                'sort_order' => 6,
            ],
            [
                'name' => 'Lexus',
                'slug' => 'lexus',
                'description' => 'Japanese luxury vehicle division of Toyota',
                'website' => 'https://www.lexus.com',
                'sort_order' => 7,
            ],
            [
                'name' => 'Infiniti',
                'slug' => 'infiniti',
                'description' => 'Japanese luxury vehicle division of Nissan',
                'website' => 'https://www.infiniti.com',
                'sort_order' => 8,
            ],
            [
                'name' => 'Volkswagen',
                'slug' => 'volkswagen',
                'description' => 'German multinational automotive manufacturing company',
                'website' => 'https://www.volkswagen.com',
                'sort_order' => 9,
            ],
            [
                'name' => 'Porsche',
                'slug' => 'porsche',
                'description' => 'German automobile manufacturer specializing in high-performance sports cars',
                'website' => 'https://www.porsche.com',
                'sort_order' => 10,
            ],
            [
                'name' => 'Ferrari',
                'slug' => 'ferrari',
                'description' => 'Italian luxury sports car manufacturer',
                'website' => 'https://www.ferrari.com',
                'sort_order' => 11,
            ],
            [
                'name' => 'Lamborghini',
                'slug' => 'lamborghini',
                'description' => 'Italian manufacturer of luxury sports cars',
                'website' => 'https://www.lamborghini.com',
                'sort_order' => 12,
            ],
        ];

        foreach ($brands as $brand) {
            VehicleBrand::create($brand);
        }
    }
}
