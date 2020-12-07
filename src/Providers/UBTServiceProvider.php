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
        $this->app->singleton('ubt', function () {
            return new UBT(env('UBT_DRIVER', 'file'));
        });

        include_once(__DIR__ . '/../config/config.php');
    }

    /**
     * 引导服务。
     * @return void
     */
    public function boot()
    {
//        $ubt1 = $this->app->make('ubt');
//        $ubt2 = $this->app->make('ubt');
//        dd($ubt1 === $ubt2);
    }
}
