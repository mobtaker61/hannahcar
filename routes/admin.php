<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\HomepageBlockController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VehicleBrandController;
use App\Http\Controllers\Admin\VehicleModelController;
use App\Http\Controllers\Admin\VehicleSpecificationsController;

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Redirect admin root to dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Users Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', function () {
            $users = \App\Models\User::latest()->paginate(20);
            return view('admin.users.index', compact('users'));
        })->name('index');
        Route::get('/{user}', function (\App\Models\User $user) {
            return view('admin.users.show', compact('user'));
        })->name('show');
        Route::get('/{user}/edit', function (\App\Models\User $user) {
            return view('admin.users.edit', compact('user'));
        })->name('edit');
        Route::put('/{user}', function (\Illuminate\Http\Request $request, \App\Models\User $user) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
            ]);
            $user->update($request->all());
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        })->name('update');
        Route::delete('/{user}', function (\App\Models\User $user) {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        })->name('destroy');
    });

    // Languages Management
    Route::prefix('languages')->name('languages.')->group(function () {
        Route::get('/', [LanguageController::class, 'index'])->name('index');
        Route::get('/create', [LanguageController::class, 'create'])->name('create');
        Route::post('/', [LanguageController::class, 'store'])->name('store');
        Route::get('/{language}', [LanguageController::class, 'show'])->name('show');
        Route::get('/{language}/edit', [LanguageController::class, 'edit'])->name('edit');
        Route::put('/{language}', [LanguageController::class, 'update'])->name('update');
        Route::delete('/{language}', [LanguageController::class, 'destroy'])->name('destroy');
        Route::patch('/{language}/toggle-status', [LanguageController::class, 'toggleStatus'])->name('toggle-status');
        Route::patch('/{language}/set-default', [LanguageController::class, 'setDefault'])->name('set-default');
    });

    // Pages Management
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/', [PageController::class, 'index'])->name('index');
        Route::get('/create', [PageController::class, 'create'])->name('create');
        Route::post('/', [PageController::class, 'store'])->name('store');
        Route::get('/{page}', [PageController::class, 'show'])->name('show');
        Route::get('/{page}/edit', [PageController::class, 'edit'])->name('edit');
        Route::put('/{page}', [PageController::class, 'update'])->name('update');
        Route::delete('/{page}', [PageController::class, 'destroy'])->name('destroy');
        Route::patch('/{page}/toggle-status', [PageController::class, 'toggleStatus'])->name('toggle-status');
    });

    // Hero Sliders Management
    Route::prefix('hero-sliders')->name('hero-sliders.')->group(function () {
        Route::get('/', [HeroSliderController::class, 'index'])->name('index');
        Route::get('/create', [HeroSliderController::class, 'create'])->name('create');
        Route::post('/', [HeroSliderController::class, 'store'])->name('store');
        Route::get('/{heroSlider}', [HeroSliderController::class, 'show'])->name('show');
        Route::get('/{heroSlider}/edit', [HeroSliderController::class, 'edit'])->name('edit');
        Route::put('/{heroSlider}', [HeroSliderController::class, 'update'])->name('update');
        Route::delete('/{heroSlider}', [HeroSliderController::class, 'destroy'])->name('destroy');
        Route::patch('/{heroSlider}/toggle-status', [HeroSliderController::class, 'toggleStatus'])->name('toggle-status');
    });

    // Homepage Blocks Management
    Route::prefix('homepage-blocks')->name('homepage-blocks.')->group(function () {
        Route::get('/', [HomepageBlockController::class, 'index'])->name('index');
        Route::get('/create', [HomepageBlockController::class, 'create'])->name('create');
        Route::post('/', [HomepageBlockController::class, 'store'])->name('store');
        Route::get('/{homepageBlock}', [HomepageBlockController::class, 'show'])->name('show');
        Route::get('/{homepageBlock}/edit', [HomepageBlockController::class, 'edit'])->name('edit');
        Route::put('/{homepageBlock}', [HomepageBlockController::class, 'update'])->name('update');
        Route::delete('/{homepageBlock}', [HomepageBlockController::class, 'destroy'])->name('destroy');
        Route::patch('/{homepageBlock}/toggle-status', [HomepageBlockController::class, 'toggleStatus'])->name('toggle-status');
    });

    // Menus Management
    Route::prefix('menus')->name('menus.')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('index');
        Route::get('/create', [MenuController::class, 'create'])->name('create');
        Route::post('/', [MenuController::class, 'store'])->name('store');
        Route::get('/{menu}', [MenuController::class, 'show'])->name('show');
        Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
        Route::put('/{menu}', [MenuController::class, 'update'])->name('update');
        Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy');
        Route::patch('/{menu}/toggle-status', [MenuController::class, 'toggleStatus'])->name('toggle-status');
        Route::get('/show/{menuName}', [MenuController::class, 'showMenu'])->name('show-menu');
    });

    // Menu Items Management
    Route::prefix('menus/{menu}/menu-items')->name('menu-items.')->group(function () {
        Route::get('/', [MenuItemController::class, 'index'])->name('index');
        Route::get('/create', [MenuItemController::class, 'create'])->name('create');
        Route::post('/', [MenuItemController::class, 'store'])->name('store');
        Route::get('/{menuItem}', [MenuItemController::class, 'show'])->name('show');
        Route::get('/{menuItem}/edit', [MenuItemController::class, 'edit'])->name('edit');
        Route::put('/{menuItem}', [MenuItemController::class, 'update'])->name('update');
        Route::delete('/{menuItem}', [MenuItemController::class, 'destroy'])->name('destroy');
        Route::patch('/{menuItem}/toggle-status', [MenuItemController::class, 'toggleStatus'])->name('toggle-status');
    });

    // Settings Management
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::get('/general', [SettingController::class, 'general'])->name('general');
        Route::put('/general', [SettingController::class, 'updateGeneral'])->name('general.update');
        Route::get('/seo', [SettingController::class, 'seo'])->name('seo');
        Route::put('/seo', [SettingController::class, 'updateSeo'])->name('seo.update');
        Route::get('/social', [SettingController::class, 'social'])->name('social');
        Route::put('/social', [SettingController::class, 'updateSocial'])->name('social.update');
        Route::get('/contact', [SettingController::class, 'contact'])->name('contact');
        Route::put('/contact', [SettingController::class, 'updateContact'])->name('contact.update');
        Route::get('/email', [SettingController::class, 'email'])->name('email');
        Route::put('/email', [SettingController::class, 'updateEmail'])->name('email.update');
        Route::get('/system', [SettingController::class, 'system'])->name('system');
        Route::put('/system', [SettingController::class, 'updateSystem'])->name('system.update');
        Route::get('/export', [SettingController::class, 'export'])->name('export');
        Route::post('/import', [SettingController::class, 'import'])->name('import');
        Route::post('/reset', [SettingController::class, 'reset'])->name('reset');
        Route::get('/create', [SettingController::class, 'create'])->name('create');
        Route::post('/', [SettingController::class, 'store'])->name('store');
        Route::get('/notification', [SettingController::class, 'notification'])->name('notification');
        Route::post('/notification', [SettingController::class, 'updateNotification'])->name('notification.update');
        Route::get('/{setting}', [SettingController::class, 'show'])->name('show');
        Route::get('/{setting}/edit', [SettingController::class, 'edit'])->name('edit');
        Route::put('/{setting}', [SettingController::class, 'update'])->name('update');
        Route::delete('/{setting}', [SettingController::class, 'destroy'])->name('destroy');
        Route::patch('/{setting}/toggle-status', [SettingController::class, 'toggleStatus'])->name('toggle-status');
        Route::get('/group/{group}', [SettingController::class, 'showGroup'])->name('show-group');
        Route::post('/bulk-update', [SettingController::class, 'bulkUpdate'])->name('bulk-update');
    });

    // Article Management
    Route::resource('articles', ArticleController::class);
    Route::post('articles/{article}/toggle-status', [ArticleController::class, 'toggleStatus'])->name('articles.toggle-status');
    Route::post('articles/{article}/toggle-featured', [ArticleController::class, 'toggleFeatured'])->name('articles.toggle-featured');
    Route::post('articles/generate-slug', [ArticleController::class, 'generateSlug'])->name('articles.generate-slug');
    Route::post('articles/upload-image', [ArticleController::class, 'uploadImage'])->name('articles.upload-image');
        // Gallery routes removed - now handled with article save

    // Service Management
    Route::resource('services', ServiceController::class)->parameters(['services' => 'article'])->except(['update']);
    Route::post('services/{article}', [ServiceController::class, 'update'])->name('services.update');
    Route::post('services/{article}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    Route::post('services/{article}/toggle-featured', [ServiceController::class, 'toggleFeatured'])->name('services.toggle-featured');
    Route::post('services/generate-slug', [ServiceController::class, 'generateSlug'])->name('services.generate-slug');
    Route::post('services/upload-image', [ServiceController::class, 'uploadImage'])->name('services.upload-image');

    // Category Management
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
    Route::post('categories/generate-slug', [CategoryController::class, 'generateSlug'])->name('categories.generate-slug');

    // Inquiry Forms Management
Route::resource('inquiry-forms', \App\Http\Controllers\Admin\InquiryFormController::class);
Route::patch('inquiry-forms/{inquiryForm}/toggle-active', [\App\Http\Controllers\Admin\InquiryFormController::class, 'toggleActive'])->name('inquiry-forms.toggle-active');

// Submitted Inquiries
Route::get('inquiries', [\App\Http\Controllers\Admin\InquiryController::class, 'index'])->name('inquiries.index');
Route::get('inquiries/{type}/{id}', [\App\Http\Controllers\Admin\InquiryController::class, 'show'])->name('inquiries.show');
Route::post('inquiries/{type}/{id}/logs', [\App\Http\Controllers\Admin\InquiryController::class, 'logsStore'])->name('inquiries.logs.store');

    Route::resource('inquiries/special_car_purchases', \App\Http\Controllers\Admin\InquirySpecialCarPurchaseController::class)
        ->only(['index', 'show'])
        ->names([
            'index' => 'inquiries.special_car_purchases.index',
            'show' => 'inquiries.special_car_purchases.show',
        ]);
    Route::post('inquiries/special_car_purchases/{inquiry}/logs', [\App\Http\Controllers\Admin\InquirySpecialCarPurchaseController::class, 'logsStore'])->name('inquiries.special_car_purchases.logs.store');

    Route::resource('inquiries/special_spare_parts', \App\Http\Controllers\Admin\InquirySpecialSparePartController::class)
        ->only(['index', 'show'])
        ->names([
            'index' => 'inquiries.special_spare_parts.index',
            'show' => 'inquiries.special_spare_parts.show',
        ]);
    Route::post('inquiries/special_spare_parts/{inquiry}/logs', [\App\Http\Controllers\Admin\InquirySpecialSparePartController::class, 'logsStore'])->name('inquiries.special_spare_parts.logs.store');

    Route::resource('inquiries/vin_checks', \App\Http\Controllers\Admin\InquiryVinCheckController::class)
        ->only(['index', 'show'])
        ->names([
            'index' => 'inquiries.vin_checks.index',
            'show' => 'inquiries.vin_checks.show',
        ]);
    Route::post('inquiries/vin_checks/{inquiry}/logs', [\App\Http\Controllers\Admin\InquiryVinCheckController::class, 'logsStore'])->name('inquiries.vin_checks.logs.store');

    // Vehicle Management
    Route::resource('vehicles', VehicleController::class);
    Route::post('vehicles/{vehicle}/toggle-featured', [VehicleController::class, 'toggleFeatured'])->name('vehicles.toggle-featured');
    Route::post('vehicles/{vehicle}/toggle-available', [VehicleController::class, 'toggleAvailable'])->name('vehicles.toggle-available');
    Route::get('vehicles/get-models/{brandId}', [VehicleController::class, 'getModels'])->name('vehicles.get-models');
    Route::get('vehicles/search-brands', [VehicleController::class, 'searchBrands'])->name('vehicles.search-brands');

    // Vehicle Brand Management
    Route::resource('vehicle-brands', VehicleBrandController::class);
    Route::get('vehicle-brands/select', [VehicleBrandController::class, 'select'])->name('vehicle-brands.select');
    Route::get('brands/select', [VehicleBrandController::class, 'select'])->name('brands.select');
    Route::patch('/{vehicleBrand}/toggle-status', [VehicleBrandController::class, 'toggleStatus'])->name('vehicle-brands.toggle-status');

    // Vehicle Model Management
    Route::resource('vehicle-models', VehicleModelController::class);
    Route::get('vehicle-models/select', [VehicleModelController::class, 'select'])->name('vehicle-models.select');
    Route::patch('/{vehicleModel}/toggle-status', [VehicleModelController::class, 'toggleStatus'])->name('vehicle-models.toggle-status');

        // Vehicle Specifications Management
        Route::get('vehicle-specifications', [VehicleSpecificationsController::class, 'index'])->name('vehicle-specifications.index');

        // Regional Specs
        Route::post('vehicle-specifications/regional-specs', [VehicleSpecificationsController::class, 'storeRegionalSpec'])->name('vehicle-specifications.regional-specs.store');
        Route::get('vehicle-specifications/regional-specs/{regionalSpec}/edit', [VehicleSpecificationsController::class, 'editRegionalSpec'])->name('vehicle-specifications.regional-specs.edit');
        Route::put('vehicle-specifications/regional-specs/{regionalSpec}', [VehicleSpecificationsController::class, 'updateRegionalSpec'])->name('vehicle-specifications.regional-specs.update');
        Route::delete('vehicle-specifications/regional-specs/{regionalSpec}', [VehicleSpecificationsController::class, 'destroyRegionalSpec'])->name('vehicle-specifications.regional-specs.destroy');

        // Body Types
        Route::post('vehicle-specifications/body-types', [VehicleSpecificationsController::class, 'storeBodyType'])->name('vehicle-specifications.body-types.store');
        Route::get('vehicle-specifications/body-types/{bodyType}/edit', [VehicleSpecificationsController::class, 'editBodyType'])->name('vehicle-specifications.body-types.edit');
        Route::put('vehicle-specifications/body-types/{bodyType}', [VehicleSpecificationsController::class, 'updateBodyType'])->name('vehicle-specifications.body-types.update');
        Route::delete('vehicle-specifications/body-types/{bodyType}', [VehicleSpecificationsController::class, 'destroyBodyType'])->name('vehicle-specifications.body-types.destroy');

        // Seats Counts
        Route::post('vehicle-specifications/seats-counts', [VehicleSpecificationsController::class, 'storeSeatsCount'])->name('vehicle-specifications.seats-counts.store');
        Route::get('vehicle-specifications/seats-counts/{seatsCount}/edit', [VehicleSpecificationsController::class, 'editSeatsCount'])->name('vehicle-specifications.seats-counts.edit');
        Route::put('vehicle-specifications/seats-counts/{seatsCount}', [VehicleSpecificationsController::class, 'updateSeatsCount'])->name('vehicle-specifications.seats-counts.update');
        Route::delete('vehicle-specifications/seats-counts/{seatsCount}', [VehicleSpecificationsController::class, 'destroySeatsCount'])->name('vehicle-specifications.seats-counts.destroy');

        // Fuel Types
        Route::post('vehicle-specifications/fuel-types', [VehicleSpecificationsController::class, 'storeFuelType'])->name('vehicle-specifications.fuel-types.store');
        Route::get('vehicle-specifications/fuel-types/{fuelType}/edit', [VehicleSpecificationsController::class, 'editFuelType'])->name('vehicle-specifications.fuel-types.edit');
        Route::put('vehicle-specifications/fuel-types/{fuelType}', [VehicleSpecificationsController::class, 'updateFuelType'])->name('vehicle-specifications.fuel-types.update');
        Route::delete('vehicle-specifications/fuel-types/{fuelType}', [VehicleSpecificationsController::class, 'destroyFuelType'])->name('vehicle-specifications.fuel-types.destroy');

        // Transmission Types
        Route::post('vehicle-specifications/transmission-types', [VehicleSpecificationsController::class, 'storeTransmissionType'])->name('vehicle-specifications.transmission-types.store');
        Route::get('vehicle-specifications/transmission-types/{transmissionType}/edit', [VehicleSpecificationsController::class, 'editTransmissionType'])->name('vehicle-specifications.transmission-types.edit');
        Route::put('vehicle-specifications/transmission-types/{transmissionType}', [VehicleSpecificationsController::class, 'updateTransmissionType'])->name('vehicle-specifications.transmission-types.update');
        Route::delete('vehicle-specifications/transmission-types/{transmissionType}', [VehicleSpecificationsController::class, 'destroyTransmissionType'])->name('vehicle-specifications.transmission-types.destroy');

        // Engine Capacity Ranges
        Route::post('vehicle-specifications/engine-capacity-ranges', [VehicleSpecificationsController::class, 'storeEngineCapacityRange'])->name('vehicle-specifications.engine-capacity-ranges.store');
        Route::get('vehicle-specifications/engine-capacity-ranges/{engineCapacityRange}/edit', [VehicleSpecificationsController::class, 'editEngineCapacityRange'])->name('vehicle-specifications.engine-capacity-ranges.edit');
        Route::put('vehicle-specifications/engine-capacity-ranges/{engineCapacityRange}', [VehicleSpecificationsController::class, 'updateEngineCapacityRange'])->name('vehicle-specifications.engine-capacity-ranges.update');
        Route::delete('vehicle-specifications/engine-capacity-ranges/{engineCapacityRange}', [VehicleSpecificationsController::class, 'destroyEngineCapacityRange'])->name('vehicle-specifications.engine-capacity-ranges.destroy');

        // Horsepower Ranges
        Route::post('vehicle-specifications/horsepower-ranges', [VehicleSpecificationsController::class, 'storeHorsepowerRange'])->name('vehicle-specifications.horsepower-ranges.store');
        Route::get('vehicle-specifications/horsepower-ranges/{horsepowerRange}/edit', [VehicleSpecificationsController::class, 'editHorsepowerRange'])->name('vehicle-specifications.horsepower-ranges.edit');
        Route::put('vehicle-specifications/horsepower-ranges/{horsepowerRange}', [VehicleSpecificationsController::class, 'updateHorsepowerRange'])->name('vehicle-specifications.horsepower-ranges.update');
        Route::delete('vehicle-specifications/horsepower-ranges/{horsepowerRange}', [VehicleSpecificationsController::class, 'destroyHorsepowerRange'])->name('vehicle-specifications.horsepower-ranges.destroy');

        // Cylinders Counts
        Route::post('vehicle-specifications/cylinders-counts', [VehicleSpecificationsController::class, 'storeCylindersCount'])->name('vehicle-specifications.cylinders-counts.store');
        Route::get('vehicle-specifications/cylinders-counts/{cylindersCount}/edit', [VehicleSpecificationsController::class, 'editCylindersCount'])->name('vehicle-specifications.cylinders-counts.edit');
        Route::put('vehicle-specifications/cylinders-counts/{cylindersCount}', [VehicleSpecificationsController::class, 'updateCylindersCount'])->name('vehicle-specifications.cylinders-counts.update');
        Route::delete('vehicle-specifications/cylinders-counts/{cylindersCount}', [VehicleSpecificationsController::class, 'destroyCylindersCount'])->name('vehicle-specifications.cylinders-counts.destroy');

        // Steering Sides
        Route::post('vehicle-specifications/steering-sides', [VehicleSpecificationsController::class, 'storeSteeringSide'])->name('vehicle-specifications.steering-sides.store');
        Route::get('vehicle-specifications/steering-sides/{steeringSide}/edit', [VehicleSpecificationsController::class, 'editSteeringSide'])->name('vehicle-specifications.steering-sides.edit');
        Route::put('vehicle-specifications/steering-sides/{steeringSide}', [VehicleSpecificationsController::class, 'updateSteeringSide'])->name('vehicle-specifications.steering-sides.update');
        Route::delete('vehicle-specifications/steering-sides/{steeringSide}', [VehicleSpecificationsController::class, 'destroySteeringSide'])->name('vehicle-specifications.steering-sides.destroy');

        // Exterior Colors
        Route::post('vehicle-specifications/exterior-colors', [VehicleSpecificationsController::class, 'storeExteriorColor'])->name('vehicle-specifications.exterior-colors.store');
        Route::get('vehicle-specifications/exterior-colors/{exteriorColor}/edit', [VehicleSpecificationsController::class, 'editExteriorColor'])->name('vehicle-specifications.exterior-colors.edit');
        Route::put('vehicle-specifications/exterior-colors/{exteriorColor}', [VehicleSpecificationsController::class, 'updateExteriorColor'])->name('vehicle-specifications.exterior-colors.update');
        Route::delete('vehicle-specifications/exterior-colors/{exteriorColor}', [VehicleSpecificationsController::class, 'destroyExteriorColor'])->name('vehicle-specifications.exterior-colors.destroy');

        // Interior Colors
        Route::post('vehicle-specifications/interior-colors', [VehicleSpecificationsController::class, 'storeInteriorColor'])->name('vehicle-specifications.interior-colors.store');
        Route::get('vehicle-specifications/interior-colors/{interiorColor}/edit', [VehicleSpecificationsController::class, 'editInteriorColor'])->name('vehicle-specifications.interior-colors.edit');
        Route::put('vehicle-specifications/interior-colors/{interiorColor}', [VehicleSpecificationsController::class, 'updateInteriorColor'])->name('vehicle-specifications.interior-colors.update');
        Route::delete('vehicle-specifications/interior-colors/{interiorColor}', [VehicleSpecificationsController::class, 'destroyInteriorColor'])->name('vehicle-specifications.interior-colors.destroy');
    });
