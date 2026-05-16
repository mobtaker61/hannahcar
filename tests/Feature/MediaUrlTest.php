<?php

declare(strict_types=1);

test('media_url returns external urls unchanged', function () {
    $url = 'https://images.unsplash.com/photo-1555215695-3004980ad54e?ixlib=rb-4.0.3';

    expect(media_url($url))->toBe($url);
});

test('media_url prefixes local storage paths', function () {
    $url = media_url('vehicles/featured/example.jpg');

    expect($url)->toContain('/storage/vehicles/featured/example.jpg');
});

test('media_url returns null for empty values', function () {
    expect(media_url(null))->toBeNull();
    expect(media_url(''))->toBeNull();
});
