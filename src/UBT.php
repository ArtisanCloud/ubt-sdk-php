<?php

namespace ArtisanCloud\UBT;

use ArtisanCloud\UBT\Drivers\AMQPDriver;
use ArtisanCloud\UBT\Drivers\Driver;
use ArtisanCloud\UBT\Drivers\FileDriver;
use ArtisanCloud\UBT\Drivers\RedisDriver;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Sentry;
use Throwable;
use Monolog\Logger;
use Monolog\Formatter\LineFormatter;

class UBT
{
    private Logger $logger;
    private Driver $driver;

    protected $baseParams = [];
    /**
     * @var LineFormatter
     */
    private $formatter;
    /**
     * @var int
     */
    private $LOG_LEVEL;


    public function __construct(string $driver = 'file')
    {
        try {

            Sentry\init(['dsn' => 'https://74a17d6ba5d7452b8987457ef9904c8b@o484937.ingest.sentry.io/5538818']);

            $this->initLogger();
//            dd($this->logger);

            $this->installDriver($driver);
//            dd($this->driver, $this->logger);

        } catch (Throwable $exception) {
            try {

                Sentry\init(['dsn' => 'https://74a17d6ba5d7452b8987457ef9904c8b@o484937.ingest.sentry.io/5538818']);
                Sentry\captureException($exception);

            } catch (Throwable $e) {
            }
        }

    }

    private function initLogger()
    {
        $this->baseParams = [
//                    'logType' => 'log',
            'appName' => config('ubt.appName'),
            'appVersion' => config('ubt.appVersion'),
            'serverHostname' => gethostname(),
            "ubtVersion" => config('ubt.ubtVersion')
        ];

        $this->LOG_LEVEL = config('ubt.logLevel', 'DEBUG');

        $dateFormat = "c";
        $output = "%datetime% %level_name% %message%\n";
        $this->formatter = new LineFormatter($output, $dateFormat);

        $this->logger = new Logger('logger');
//                dd(config('ubt'));

    }

    private function installDriver($driverName = 'file')
    {
        $LOG_LEVEL = $this->LOG_LEVEL;
        $logLevel = Utils::formatLogLevel($LOG_LEVEL);

        switch ($driverName) {
            case "redis":
                $this->driver = new RedisDriver($this->formatter, $logLevel);
            case "amqp":
                $this->driver = new AMQPDriver($this->formatter, $logLevel);
            default:
                $this->driver = new FileDriver($this->formatter, $logLevel);
        }

        $this->logger->pushHandler($this->driver->getHandler());
    }


    private function base($logLevel, $msg, $json = [])
    {
        try {
            $formatData = Utils::formatMsg($this->baseParams, $msg, $json);
            $this->logger->{$logLevel}($formatData);

        } catch (\Throwable $e) {
            Sentry\captureException($e);
        }
    }

    public function debug($msg, $json = [])
    {
        $this->base('debug', $msg, $json);
    }

    public function info($msg, $json = [])
    {
        $this->base('info', $msg, $json);
    }

    public function notice($msg, $json = [])
    {
        self::base('notice', $msg, $json);
    }

    public function warning($msg, $json = [])
    {
        self::base('warning', $msg, $json);
    }

    public function error($msg, $json = [])
    {
        self::base('error', $msg, $json);
    }

    public function critical($msg, $json = [])
    {
        self::base('critical', $msg, $json);
    }

    public function alert($msg, $json = [])
    {
        self::base('alert', $msg, $json);
    }

    public function emergency($msg, $json = [])
    {
        self::base('emergency', $msg, $json);
    }

    public function sendError(\Throwable $e)
    {
        $this->error('', [
            'error.msg' => $e->getMessage(),
            'error.code' => $e->getCode(),
            'error.stacks' => $e->getTraceAsString(),
            'error.file' => $e->getFile(),
            'error.line' => $e->getLine()
        ]);
    }




}