<?php


namespace ArtisanCloud\UBT\Drivers;


use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Psr\Log\LogLevel;

interface Driver
{
    /**
     * Driver constructor.
     *
     * @param LineFormatter $formatter
     * @param int $LOG_LEVEL - 100-700， 100表示debug，如果是200表示不包含debug的log
     *
     * @return mixed
     */
    public function __construct(LineFormatter $formatter, int $LOG_LEVEL);
    
    function getHandler();


}