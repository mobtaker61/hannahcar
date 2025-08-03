<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use App\Models\Page;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Route model bindings
        Route::model('engineCapacityRange', \App\Models\EngineCapacityRange::class);
        Route::model('horsepowerRange', \App\Models\HorsepowerRange::class);

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Dynamic page routes
            $this->registerDynamicPageRoutes();
        });
    }

    /**
     * Register dynamic page routes
     */
    protected function registerDynamicPageRoutes(): void
    {
        // Get all published pages
        $pages = Page::where('status', 'published')->get();

        foreach ($pages as $page) {
            Route::get('/' . $page->slug, function () use ($page) {
                return app(\App\Http\Controllers\HomeController::class)->showPage($page->slug);
            })->name('page.' . $page->slug);
        }
    }
}
