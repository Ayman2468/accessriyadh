<?php

namespace App\Http\Middleware;

use App\AppSetting;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the locale from the 'locale' cookie (change 'locale' to your cookie name)
        $locale = $request->cookie('locale');

        // Set the application's locale based on the cookie value
        if ($locale) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
