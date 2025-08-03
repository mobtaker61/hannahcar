<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Page;

class DynamicPageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        // Skip if it's a known route
        if ($this->isKnownRoute($path)) {
            return $next($request);
        }

        // Check if this path matches a published page
        $page = Page::where('slug', $path)
            ->where('status', 'published')
            ->first();

        if ($page) {
            // Redirect to the page route
            return redirect()->route('page.show', ['slug' => $page->slug]);
        }

        return $next($request);
    }

    /**
     * Check if the path is a known route
     */
    private function isKnownRoute(string $path): bool
    {
        $knownRoutes = [
            '',
            'admin',
            'login',
            'register',
            'dashboard',
            'profile',
            'language',
            'logout',
            'page',
        ];

        // Check exact matches
        if (in_array($path, $knownRoutes)) {
            return true;
        }

        // Check if path starts with known prefixes
        foreach ($knownRoutes as $route) {
            if ($route && str_starts_with($path, $route . '/')) {
                return true;
            }
        }

        return false;
    }
}
