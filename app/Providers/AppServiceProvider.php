<?php

namespace App\Providers;

use App\Models\Site\Seo;
use App\Models\Site\SeoDefault;
use App\Models\Site\Settings;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;
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
        view()->composer('*', function () {
            $lang = App::getLocale();
            $data = Seo::where('url', Request::url())->where('lang', $lang)->first();
            $def = SeoDefault::where('lang', $lang)->first();
            if (!$def) {
                $def = new SeoDefault;
            }
            View::share('title', isset($data->title) ? $data->title : $def->title);
            View::share('description', isset($data->description) ? $data->description : $def->description);
            View::share('keywords', isset($data->keywords) ? $data->keywords : $def->keywords);

        });

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
