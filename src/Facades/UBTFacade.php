<?php

namespace ArtisanCloud\UBT\Facades;

use ArtisanCloud\UBT\UBT;
use Illuminate\Support\Facades\Facade;


/**
 * @method static void debug($msg, $json = [])
 * @method static void info($msg, $json = [])
 */
class UBTFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UBT::class;
    }
}