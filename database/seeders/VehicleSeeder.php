<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use App\Models\RegionalSpec;
use App\Models\BodyType;
use App\Models\SeatsCount;
use App\Models\FuelType;
use App\Models\TransmissionType;
use App\Models\EngineCapacityRange;
use App\Models\HorsepowerRange;
use App\Models\CylindersCount;
use App\Models\SteeringSide;
use App\Models\ExteriorColor;
use App\Models\InteriorColor;
use App\Models\User;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        // Get reference data
        $gccSpec = RegionalSpec::where('slug', 'gcc')->first();
        $sedanBody = BodyType::where('slug', 'sedan')->first();
        $suvBody = BodyType::where('slug', 'suv')->first();
        $fiveSeats = SeatsCount::where('count', 5)->first();
        $sevenSeats = SeatsCount::where('count', 7)->first();
        $petrolFuel = FuelType::where('slug', 'petrol')->first();
        $automaticTrans = TransmissionType::where('slug', 'automatic')->first();
        $engine2_0 = EngineCapacityRange::where('display_name', '2.0L - 2.5L')->first();
        $engine3_0 = EngineCapacityRange::where('display_name', '2.5L - 3.0L')->first();
        $hp200_300 = HorsepowerRange::where('display_name', '200-300hp')->first();
        $hp300_400 = HorsepowerRange::where('display_name', '300-400hp')->first();
        $sixCylinders = CylindersCount::where('count', 6)->first();
        $eightCylinders = CylindersCount::where('count', 8)->first();
        $leftHand = SteeringSide::where('slug', 'left-hand-drive')->first();
        $whiteColor = ExteriorColor::where('slug', 'white')->first();
        $blackColor = ExteriorColor::where('slug', 'black')->first();
        $silverColor = ExteriorColor::where('slug', 'silver')->first();
        $beigeInterior = InteriorColor::where('slug', 'beige')->first();
        $blackInterior = InteriorColor::where('slug', 'black')->first();

        // Sample vehicles data
        $vehicles = [
            [
                'brand' => 'Mercedes-Benz',
                'model' => 'S-Class',
                'year' => 2024,
                'price' => 550000,
                'currency' => 'AED',
                'mileage' => 0,
                'status' => 'new',
                'body_type' => $sedanBody,
                'seats_count' => $fiveSeats,
                'fuel_type' => $petrolFuel,
                'transmission_type' => $automaticTrans,
                'engine_capacity_range' => $engine3_0,
                'horsepower_range' => $hp300_400,
                'cylinders_count' => $sixCylinders,
                'steering_side' => $leftHand,
                'exterior_color' => $blackColor,
                'interior_color' => $beigeInterior,
                'description' => 'Luxury flagship sedan with cutting-edge technology and premium comfort features.',
                'features' => ['Panoramic Sunroof', 'Burmester Sound System', 'MBUX Infotainment', 'Driver Assistance Package'],
                'featured_image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'brand' => 'BMW',
                'model' => 'X7',
                'year' => 2023,
                'price' => 480000,
                'currency' => 'AED',
                'mileage' => 15000,
                'status' => 'used',
                'body_type' => $suvBody,
                'seats_count' => $sevenSeats,
                'fuel_type' => $petrolFuel,
                'transmission_type' => $automaticTrans,
                'engine_capacity_range' => $engine3_0,
                'horsepower_range' => $hp300_400,
                'cylinders_count' => $sixCylinders,
                'steering_side' => $leftHand,
                'exterior_color' => $whiteColor,
                'interior_color' => $blackInterior,
                'description' => 'Luxury SUV with spacious interior and advanced driving dynamics.',
                'features' => ['xDrive All-Wheel Drive', 'BMW Live Cockpit', 'Gesture Control', 'Laser Headlights'],
                'featured_image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'brand' => 'Audi',
                'model' => 'RS7',
                'year' => 2024,
                'price' => 420000,
                'currency' => 'AED',
                'mileage' => 0,
                'status' => 'new',
                'body_type' => $sedanBody,
                'seats_count' => $fiveSeats,
                'fuel_type' => $petrolFuel,
                'transmission_type' => $automaticTrans,
                'engine_capacity_range' => $engine3_0,
                'horsepower_range' => $hp300_400,
                'cylinders_count' => $eightCylinders,
                'steering_side' => $leftHand,
                'exterior_color' => $silverColor,
                'interior_color' => $blackInterior,
                'description' => 'High-performance luxury sedan with stunning design and exceptional power.',
                'features' => ['Quattro All-Wheel Drive', 'Audi Virtual Cockpit', 'Bang & Olufsen Sound', 'Sport Suspension'],
                'featured_image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Land Cruiser',
                'year' => 2023,
                'price' => 380000,
                'currency' => 'AED',
                'mileage' => 25000,
                'status' => 'used',
                'body_type' => $suvBody,
                'seats_count' => $sevenSeats,
                'fuel_type' => $petrolFuel,
                'transmission_type' => $automaticTrans,
                'engine_capacity_range' => $engine3_0,
                'horsepower_range' => $hp200_300,
                'cylinders_count' => $sixCylinders,
                'steering_side' => $leftHand,
                'exterior_color' => $whiteColor,
                'interior_color' => $beigeInterior,
                'description' => 'Legendary off-road capability with luxury comfort and reliability.',
                'features' => ['Multi-Terrain Select', 'Crawl Control', 'KDSS Suspension', 'Premium Audio System'],
                'featured_image' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'brand' => 'Porsche',
                'model' => '911',
                'year' => 2024,
                'price' => 650000,
                'currency' => 'AED',
                'mileage' => 0,
                'status' => 'new',
                'body_type' => $sedanBody, // Using sedan for sports car
                'seats_count' => $fiveSeats,
                'fuel_type' => $petrolFuel,
                'transmission_type' => $automaticTrans,
                'engine_capacity_range' => $engine3_0,
                'horsepower_range' => $hp300_400,
                'cylinders_count' => $sixCylinders,
                'steering_side' => $leftHand,
                'exterior_color' => $blackColor,
                'interior_color' => $blackInterior,
                'description' => 'Iconic sports car with unmatched performance and precision engineering.',
                'features' => ['Porsche Active Suspension', 'Sport Chrono Package', 'Bose Sound System', 'PDK Transmission'],
                'featured_image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Camry',
                'year' => 2023,
                'price' => 120000,
                'currency' => 'AED',
                'mileage' => 15000,
                'status' => 'export',
                'body_type' => $sedanBody,
                'seats_count' => $fiveSeats,
                'fuel_type' => $petrolFuel,
                'transmission_type' => $automaticTrans,
                'engine_capacity_range' => $engine2_0,
                'horsepower_range' => $hp200_300,
                'cylinders_count' => $sixCylinders,
                'steering_side' => $leftHand,
                'exterior_color' => $whiteColor,
                'interior_color' => $beigeInterior,
                'description' => 'Reliable sedan perfect for export markets with excellent fuel efficiency.',
                'features' => ['Toyota Safety Sense', 'Entune Audio', 'Smart Key System', 'Backup Camera'],
                'featured_image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'brand' => 'Honda',
                'model' => 'Accord',
                'year' => 2022,
                'price' => 110000,
                'currency' => 'AED',
                'mileage' => 25000,
                'status' => 'export',
                'body_type' => $sedanBody,
                'seats_count' => $fiveSeats,
                'fuel_type' => $petrolFuel,
                'transmission_type' => $automaticTrans,
                'engine_capacity_range' => $engine2_0,
                'horsepower_range' => $hp200_300,
                'cylinders_count' => $sixCylinders,
                'steering_side' => $leftHand,
                'exterior_color' => $silverColor,
                'interior_color' => $blackInterior,
                'description' => 'Popular export model with great value and reliability.',
                'features' => ['Honda Sensing', 'Apple CarPlay', 'Android Auto', 'LaneWatch'],
                'featured_image' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            $brand = VehicleBrand::where('name', $vehicleData['brand'])->first();
            $model = VehicleModel::where('name', $vehicleData['model'])->where('brand_id', $brand->id)->first();

            if ($brand && $model) {
                Vehicle::create([
                    'slug' => Str::slug($vehicleData['brand'] . ' ' . $vehicleData['model'] . ' ' . $vehicleData['year']),
                    'brand_id' => $brand->id,
                    'model_id' => $model->id,
                    'year' => $vehicleData['year'],
                    'price' => $vehicleData['price'],
                    'currency' => $vehicleData['currency'],
                    'mileage' => $vehicleData['mileage'],
                    'description' => $vehicleData['description'],
                    'status' => $vehicleData['status'],
                    'publish_status' => 'published',
                    'is_featured' => true,
                    'is_available' => true,
                    'regional_spec_id' => $gccSpec->id,
                    'body_type_id' => $vehicleData['body_type']->id,
                    'seats_count_id' => $vehicleData['seats_count']->id,
                    'fuel_type_id' => $vehicleData['fuel_type']->id,
                    'transmission_type_id' => $vehicleData['transmission_type']->id,
                    'engine_capacity_range_id' => $vehicleData['engine_capacity_range']->id,
                    'horsepower_range_id' => $vehicleData['horsepower_range']->id,
                    'cylinders_count_id' => $vehicleData['cylinders_count']->id,
                    'steering_side_id' => $vehicleData['steering_side']->id,
                    'exterior_color_id' => $vehicleData['exterior_color']->id,
                    'interior_color_id' => $vehicleData['interior_color']->id,
                    'features' => $vehicleData['features'],
                    'featured_image' => $vehicleData['featured_image'],
                    'user_id' => $user->id,
                    'published_at' => now(),
                ]);
            }
        }
    }
}
