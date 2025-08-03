<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if locale is set in session
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }

        // Check if locale is set in URL parameter
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            if (in_array($locale, ['en', 'fa', 'ar'])) {
                app()->setLocale($locale);
                session()->put('locale', $locale);
            }
        }

        return $next($request);
    }
}
