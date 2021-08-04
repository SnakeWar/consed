<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('pages.layouts.sections._sidebar', 'App\Http\Views\PostViewComposer@compose');
        view()->composer([
            'pages.layouts.sections.top_banner_mobile',
            'pages.layouts.sections.top_banner_desktop',
        ], 'App\Http\Views\TopBannerViewComposer@compose');

        view()->composer([
            'pages.layouts.blocks._header',
        ], 'App\Http\Views\MenuViewComposer@compose');

        view()->composer([
            'pages.layouts.blocks._footer',
        ], 'App\Http\Views\FooterViewComposer@compose');
    }
}