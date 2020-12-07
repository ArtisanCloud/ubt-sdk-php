<?php


namespace ArtisanCloud\UBT\Providers;

use ArtisanCloud\UBT\Facades\UBTFacade;
use ArtisanCloud\UBT\UBT;
use Illuminate\Support\ServiceProvider;

class UBTProvider extends ServiceProvider
{
    /**
     * 注册服务.
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UBT::class, function ($app) {
            return new UBT(config('ubt.driver'));
        });
    }

    /**
     * 引导服务。
     * @return void
     */
    public function boot()
    {
        //
        App::bind('UBT',function() {
            return new UBTFacade();
        });
    }
}
