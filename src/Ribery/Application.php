<?php
namespace Ribery;

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use \Monolog\Formatter\LineFormatter;
use \Respect\Config\Container;
use \Respect\Rest\Router;
use \Ribery\Infrastructure\UnitOfWork\PdoUnitOfWork;
use \Ribery\Service\MakeService;

class Application
{
    private static $instance;
    private $logger;
    private $database;

    private function __construct()
    {
        $this->setLogger();
        $this->setDatabase();
        $this->serviceFactory();
    }

    public static function getInstance()
    {
		if (self::$instance === null)
			self::$instance = new Application();

		return self::$instance;
	}

    public function handle()
    {
        $r3 = new Router('/catalog/api');
        $r3->get('/', 'Ribery\Controller\IndexController');
        $r3->any('/makes', 'Ribery\Controller\MakeController', ['service' => $this->service]);
    }

    public static function start()
    {
        self::getInstance()->handle();
    }

    private function setDatabase()
    {
        $dbConfig = new Container(CONFIG_PATH . 'database.ini');
        $this->database = new PdoUnitOfWork($dbConfig->db_dsn, $dbConfig->db_user, $dbConfig->db_pass);
    }

    private function setLogger()
    {
        $formatter = new LineFormatter("[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n\n", "Y-m-d H:i:s");
        $logHandler = new StreamHandler(sprintf("%smake_%s.log", LOG_PATH, date('ymdhis')));
        $logHandler->setFormatter($formatter);
        $this->logger = new Logger("Application");
        $this->logger->pushHandler($logHandler);
    }

    private function serviceFactory()
    {
        $this->service = new MakeService($this->database, $this->logger);   
    }
}