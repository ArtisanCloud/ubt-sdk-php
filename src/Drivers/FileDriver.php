<?php


namespace ArtisanCloud\UBT\Drivers;


use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class FileDriver implements Driver
{
    protected $streamHandler;

    /**
     * FileDriver constructor.
     *
     * @param LineFormatter $formatter
     * @param int $LOG_LEVEL
     *
     * @return mixed
     */
    public function __construct(LineFormatter $formatter, int $LOG_LEVEL)
    {
        $this->streamHandler = new RotatingFileHandler(storage_path() . '/logs/ubt-redis.log', 7, $LOG_LEVEL);
        $this->streamHandler->setFormatter($formatter);

        return $this;
    }

    public function getHandler()
    {
        return $this->streamHandler;
    }
}