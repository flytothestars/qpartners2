<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use View;
use Cookie;
use Illuminate\Http\Request;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        if($request->header('Lang') == 'kz')
            $this->app->setLocale($request->header('Lang'),'ru');
        else $this->app->setLocale(Cookie::get('site_lang'),'ru');

        $locale = App::getLocale();
        if($locale == '') {
            $this->app->setLocale('ru');
            $locale = 'ru';
        }
        View::share('lang', $locale);
        View::share('request', $request);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
