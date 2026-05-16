<?php

if (! function_exists('media_url')) {
    /**
     * Resolve a public URL for local storage paths or return external URLs unchanged.
     */
    function media_url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        $path = trim($path);

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        return asset('storage/'.$path);
    }
}
