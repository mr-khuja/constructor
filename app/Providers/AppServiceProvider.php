<?php

namespace App\Providers;

use App\Models\Site\Settings;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $sets = Settings::first();
        View::share('settings', $sets);

        Blade::directive('l', function ($expression) {
            $str = $expression;
            $str = substr($str, 1);
            $str = substr($str, 0, -1);
            $locales = \Config::get('app.locales');
            foreach ($locales as $lang) {
                $chars = json_decode(file_get_contents('../resources/lang/' . $lang . '.json'), true);
                if (!isset($chars[$str])) {
                    $chars[$str] = "";
                }
                $data = json_encode($chars);
                file_put_contents('../resources/lang/' . $lang . '.json', $data);
            }
        });
    }
}
