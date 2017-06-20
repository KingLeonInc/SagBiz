<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Ad;
use Carbon\Carbon;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['welcome', 'services', 'events', 'event', 'contact'], function($view){
            $sag_photo_ads = Ad::where('ad_type', 'photo')->where('enabled', '1')
                                 ->where('ad_start_date', '<=', Carbon::now())
                                 ->where('ad_end_date', '>=', Carbon::now())
                                 ->get();
            $sag_video_ads = Ad::where('ad_type', 'video')->where('enabled', '1')
                                 ->where('ad_start_date', '<=', Carbon::now())
                                 ->where('ad_end_date', '>=', Carbon::now())
                                 ->get();
            return $view->with([
                'sag_photo_ads' => $sag_photo_ads,
                'sag_video_ads' => $sag_video_ads,
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
