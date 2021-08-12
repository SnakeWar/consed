<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Relation::morphMap([
            'consisti_news_tag' => 'App\Models\News',
            'consisti_gallery_tag' => 'App\Models\Gallery',
            'consisti_video_gallery_tag' => 'App\Models\VideoGallery',
        ]);
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);

        Validator::extend('base64_image',function($attribute, $value, $params, $validator) {
            try {
                $value = str_replace('data:image/png;base64,', '', $value);
                $value = str_replace('data:image/jpeg;base64,', '', $value);
                
                $image = base64_decode($value);
                $f = finfo_open();
                $result = finfo_buffer($f, $image, FILEINFO_MIME_TYPE);
                return $result == 'image/png' || $result == 'image/jpeg';
            } catch (\Exception $th) {
                return false;
            }
        });
    }
}
