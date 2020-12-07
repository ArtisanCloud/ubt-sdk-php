<?php

namespace ArtisanCloud\UBT\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * @method static void debug($msg, $json = [])
 * @method static void info($msg, $json = [])
 */
class UBT extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ubt';
    }
}