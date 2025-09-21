<?php

declare(strict_types=1);

use App\Models\InquiryForm;

it('renders inquiry cards on home page', function () {
    InquiryForm::query()->create([
        'slug' => 'vin-check',
        'title' => 'VIN Check',
        'description' => 'Check VIN history',
        'route_name' => 'inquiry-forms.show',
        'icon' => 'vin-check',
        'color' => 'blue',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->get(route('home'));

    $response->assertSuccessful();
    $response->assertSeeLivewire('service-cards');
});
