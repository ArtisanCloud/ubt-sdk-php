<?php

namespace ArtisanCloud\UBT\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * @method static void debug($msg, $json = [])
 * @method static void info($msg, $json = [])
 * @method static void notice($msg, $json = [])
 * @method static void warning($msg, $json = [])
 * @method static void error($msg, $json = [])
 * @method static void critical($msg, $json = [])
 * @method static void alert($msg, $json = [])
 * @method static void emergency($msg, $json = [])
 * @method static void sendError(\Throwable $e)
 */
class UBT extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ubt';
    }
}