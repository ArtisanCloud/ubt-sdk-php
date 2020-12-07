<?php


namespace ArtisanCloud\UBT\Providers;

use ArtisanCloud\UBT\UBT;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class UBTServiceProvider extends ServiceProvider
{
    /**
     * 注册服务.
     * @return void
     */
    public function register()
    {
        //
        App::bind('ubt',function() {
            return new UBT(env('','file'));
        });
    }

    /**
     * 引导服务。
     * @return void
     */
    public function boot()
    {

    }
}
