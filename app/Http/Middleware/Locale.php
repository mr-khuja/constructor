<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = Session::get('locale');
        if (in_array($lang, \Config::get('app.locales'))) {
            App::setLocale($lang);
        } else {
            $lang = app()->getLocale();
            Session::put('locale', $lang);
        }
        return $next($request);
    }
}
