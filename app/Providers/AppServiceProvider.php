<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\SocialMedia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Schema::defaultStringLength(191);

        $social_media = SocialMedia::select(['link_facebook','link_twitter','link_instagram'])->get()->first();
        $facebook = $social_media->link_facebook;
        $twitter = $social_media->link_twitter;
        $instagram = $social_media->link_instagram;

        view()->share(['facebook'=>$facebook,'twitter'=>$twitter,'instagram'=>$instagram]);

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
