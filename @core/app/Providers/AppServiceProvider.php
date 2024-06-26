<?php

namespace App\Providers;


use App\Helpers\InstagramFeedHelper;
use App\Helpers\LanguageHelper;
use App\Models\Language;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        app()->bind('InstagramFeed',function (){
            return new InstagramFeedHelper();
        });

        app()->singleton('GlobalLanguage',function (){
            return  new LanguageHelper();
        });
    }

    public function boot()
    {
        Schema::defaultStringLength(191);

        $all_language = Language::all();
        Paginator::useBootstrap();
        if (get_static_option('site_force_ssl_redirection') === 'on'){
            URL::forceScheme('https');
        }

    }
}
