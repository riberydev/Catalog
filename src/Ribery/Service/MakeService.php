<?php
namespace Ribery\Service;

use \Exception;
use \Ribery\Infrastructure\UnitOfWork\PdoUnitOfWork;
use \Ribery\Infrastructure\Repository\MakeRepository;
use \Respect\Config\Container;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use \Monolog\Formatter\LineFormatter;


class MakeService
{
    private $database;
    private $logger;

    public function __construct()
    {
        //TODO: Implement a DI container
        $c = new Container(ROOT_PATH . 'Ribery/Config/database.ini');    
        $this->database = new PdoUnitOfWork($c->db_dsn, $c->db_user, $c->db_pass);

        $dateFormat = "Y-m-d H:i:s";
        $output = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%" . PHP_EOL . PHP_EOL;
        $formatter = new LineFormatter($output, $dateFormat);
        $logHandler = new StreamHandler(sprintf("%smake_%s.log", LOG_PATH, date('ymdhis')));
        $logHandler->setFormatter($formatter);
        $this->logger = new Logger("Make");
        $this->logger->pushHandler($logHandler);
    }

    public function getAll()
    {
        try
        {
            $repository = new MakeRepository($this->database);
            $makesList = $repository->getAll();

            return $makesList;

        } catch (Exception $e) {
            $this->logger->error($e);
            throw $e;
        }
    }

    public function create(Make $make)
    {
        try
        {
            if (false === $make->isValid())
                throw new InvalidArgumentException('Invalid make model');

            $repository = new MakeRepository($this->database);
            $makeId = $repository->create($make);

            if (!empty($makeId))
                $make->setId($makeId);

            return $make;

        } catch (Exception $e) {
            $this->logger->error($e);
            throw $e;
        }
    }
}