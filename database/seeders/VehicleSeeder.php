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

        // Available images from storage
        $availableImages = [
            'vehicles/featured/2h48qZHz3lPKIebKPP1cKwNqhfcDa7kwPMHayid1.jpg',
            'vehicles/featured/9qRA3hZbHsb42bZG5O13fi8cvN6e5crmsKNlqszj.jpg',
            'vehicles/featured/CLmSjDTPnuRXZ0C4c2oAtUxh5FQLbTazdPETFiNb.jpg',
            'vehicles/featured/FMyldq5iLsKoBTK4VHlKGY6QQ5Uu5yaiQqqpJ06A.jpg',
            'vehicles/featured/Nk3fbcbE1n9tDqNhtTlCfqYz2RJbZ3x6QMlccI6L.jpg',
            'vehicles/featured/VheymAi0a7AoklLJtt1IHndY8nkLXuas4nyo0JOt.jpg',
            'vehicles/featured/YsgD7goISpii2XB1Xz8F5orKkNCi0MHl5NUj1NP4.jpg',
        ];

        // Sample vehicles data
        $vehicles = [
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
                'featured_image' => $availableImages[0],
            ],
            [
                'brand' => 'BMW',
                'model' => '7 Series',
                'year' => 2024,
                'price' => 520000,
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
                'description' => 'Flagship luxury sedan with cutting-edge technology and premium comfort features.',
                'features' => ['Panoramic Sunroof', 'Bowers & Wilkins Sound System', 'BMW iDrive 8', 'Driver Assistance Package'],
                'featured_image' => $availableImages[1],
            ],
            [
                'brand' => 'BMW',
                'model' => '5 Series',
                'year' => 2023,
                'price' => 380000,
                'currency' => 'AED',
                'mileage' => 25000,
                'status' => 'used',
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
                'description' => 'Executive sedan with perfect balance of luxury and performance.',
                'features' => ['BMW Live Cockpit', 'Gesture Control', 'Comfort Access', 'Parking Assistant'],
                'featured_image' => $availableImages[2],
            ],
            [
                'brand' => 'BMW',
                'model' => '3 Series',
                'year' => 2023,
                'price' => 280000,
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
                'exterior_color' => $blackColor,
                'interior_color' => $blackInterior,
                'description' => 'Sporty sedan perfect for export markets with excellent performance.',
                'features' => ['BMW Live Cockpit', 'Comfort Access', 'Parking Assistant', 'Backup Camera'],
                'featured_image' => $availableImages[3],
            ],
            [
                'brand' => 'BMW',
                'model' => '1 Series',
                'year' => 2024,
                'price' => 220000,
                'currency' => 'AED',
                'mileage' => 0,
                'status' => 'new',
                'body_type' => $sedanBody,
                'seats_count' => $fiveSeats,
                'fuel_type' => $petrolFuel,
                'transmission_type' => $automaticTrans,
                'engine_capacity_range' => $engine2_0,
                'horsepower_range' => $hp200_300,
                'cylinders_count' => $sixCylinders,
                'steering_side' => $leftHand,
                'exterior_color' => $whiteColor,
                'interior_color' => $blackInterior,
                'description' => 'Compact luxury sedan with sporty design and modern technology.',
                'features' => ['BMW Live Cockpit', 'Comfort Access', 'Parking Assistant', 'LED Headlights'],
                'featured_image' => $availableImages[4],
            ],
            [
                'brand' => 'BMW',
                'model' => '7 Series',
                'year' => 2022,
                'price' => 450000,
                'currency' => 'AED',
                'mileage' => 35000,
                'status' => 'export',
                'body_type' => $sedanBody,
                'seats_count' => $fiveSeats,
                'fuel_type' => $petrolFuel,
                'transmission_type' => $automaticTrans,
                'engine_capacity_range' => $engine3_0,
                'horsepower_range' => $hp300_400,
                'cylinders_count' => $sixCylinders,
                'steering_side' => $leftHand,
                'exterior_color' => $silverColor,
                'interior_color' => $beigeInterior,
                'description' => 'Previous generation flagship sedan with luxury features for export markets.',
                'features' => ['Panoramic Sunroof', 'Bowers & Wilkins Sound System', 'BMW iDrive 7', 'Driver Assistance Package'],
                'featured_image' => $availableImages[5],
            ],
            [
                'brand' => 'BMW',
                'model' => '5 Series',
                'year' => 2022,
                'price' => 320000,
                'currency' => 'AED',
                'mileage' => 40000,
                'status' => 'export',
                'body_type' => $sedanBody,
                'seats_count' => $fiveSeats,
                'fuel_type' => $petrolFuel,
                'transmission_type' => $automaticTrans,
                'engine_capacity_range' => $engine2_0,
                'horsepower_range' => $hp200_300,
                'cylinders_count' => $sixCylinders,
                'steering_side' => $leftHand,
                'exterior_color' => $blackColor,
                'interior_color' => $blackInterior,
                'description' => 'Reliable executive sedan with great value for export markets.',
                'features' => ['BMW Live Cockpit', 'Comfort Access', 'Parking Assistant', 'Backup Camera'],
                'featured_image' => $availableImages[6],
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            $brand = VehicleBrand::where('name', $vehicleData['brand'])->first();
            $model = VehicleModel::where('name', $vehicleData['model'])->where('brand_id', $brand->id)->first();

            if ($brand && $model) {
                // Check if vehicle already exists to prevent duplicates
                $existingVehicle = Vehicle::where('brand_id', $brand->id)
                    ->where('model_id', $model->id)
                    ->where('year', $vehicleData['year'])
                    ->where('status', $vehicleData['status'])
                    ->first();

                if (!$existingVehicle) {
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
                } else {
                    $this->command->info("Vehicle {$vehicleData['brand']} {$vehicleData['model']} {$vehicleData['year']} already exists, skipping...");
                }
            } else {
                $this->command->warn("Brand {$vehicleData['brand']} or Model {$vehicleData['model']} not found, skipping vehicle...");
            }
        }
    }
}
