<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;

class VehicleModelSeeder extends Seeder
{
    public function run(): void
    {
        $brands = VehicleBrand::all();

        $models = [
            'Mercedes-Benz' => [
                'S-Class', 'E-Class', 'C-Class', 'A-Class', 'G-Class', 'GLE', 'GLC', 'GLA', 'AMG GT', 'CLS'
            ],
            'BMW' => [
                '7 Series', '5 Series', '3 Series', '1 Series', 'X7', 'X5', 'X3', 'X1', 'M3', 'M5'
            ],
            'Audi' => [
                'A8', 'A6', 'A4', 'A3', 'Q8', 'Q7', 'Q5', 'Q3', 'RS7', 'RS6'
            ],
            'Toyota' => [
                'Camry', 'Corolla', 'Prius', 'RAV4', 'Highlander', 'Tacoma', 'Tundra', 'Land Cruiser'
            ],
            'Honda' => [
                'Accord', 'Civic', 'CR-V', 'Pilot', 'Odyssey', 'Ridgeline', 'Passport'
            ],
            'Nissan' => [
                'Altima', 'Sentra', 'Maxima', 'Rogue', 'Murano', 'Pathfinder', 'Frontier', 'Titan'
            ],
            'Lexus' => [
                'LS', 'ES', 'IS', 'GS', 'RX', 'NX', 'GX', 'LX', 'LC', 'RC'
            ],
            'Infiniti' => [
                'Q50', 'Q60', 'Q70', 'QX50', 'QX60', 'QX80', 'QX30'
            ],
            'Volkswagen' => [
                'Passat', 'Jetta', 'Golf', 'Tiguan', 'Atlas', 'Arteon', 'ID.4'
            ],
            'Porsche' => [
                '911', 'Cayenne', 'Macan', 'Panamera', 'Cayman', 'Boxster'
            ],
            'Ferrari' => [
                'F8', 'SF90', '812', 'Roma', 'Portofino', '296'
            ],
            'Lamborghini' => [
                'Huracán', 'Aventador', 'Urus', 'Revuelto', 'Huracán STO'
            ],
        ];

        foreach ($models as $brandName => $modelNames) {
            $brand = $brands->where('name', $brandName)->first();

            if ($brand) {
                foreach ($modelNames as $index => $modelName) {
                    VehicleModel::create([
                        'brand_id' => $brand->id,
                        'name' => $modelName,
                        'slug' => strtolower(str_replace(' ', '-', $modelName)),
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        }
    }
}
