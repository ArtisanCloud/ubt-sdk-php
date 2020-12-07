<?php


namespace ArtisanCloud\UBT\Drivers;


use ArtisanCloud\UBT\Utils;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RedisHandler;
use Monolog\Logger;
use Predis\Client;
use Psr\Log\LogLevel;

class RedisDriver implements Driver
{
    protected $redisHandler;

    /**
     * RedisDriver constructor.
     *
     * @param LineFormatter $formatter
     * @param int $LOG_LEVEL
     *
     * @return mixed
     * 
     */
    public function __construct(LineFormatter $formatter, int $LOG_LEVEL)
    {
        $this->redishandler = new RedisHandler(new Client(env('UBT_REDIS')), "ubt-logs", $LOG_LEVEL);
        $this->redishandler->setFormatter($formatter);

        return $this;

    }

    public function getHandler()
    {
        return $this->redishandler;
    }

}