<?php

declare(strict_types=1);

it('renders hero 3D carousel on home', function (): void {
    $response = $this->get(route('home'));

    $response->assertSuccessful();
    $response->assertSee('id="hero3d"', false);
    $response->assertSee('class="carousel"', false);
});
