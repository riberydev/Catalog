<?php
namespace Ribery\Service;

use \Exception;
use \Ribery\Infrastructure\UnitOfWork\PdoUnitOfWork;
use \Ribery\Infrastructure\Repository\MakeRepository;
use \Respect\Config\Container;


class MakeService
{
    private $database;

    public function __construct()
    {
        //TODO: Implement a DI container
        $c = new Container(ROOT_PATH . 'Ribery/Config/database.ini');    
        $this->database = new PdoUnitOfWork($c->db_dsn, $c->db_user, $c->db_pass);
    }

    public function getAll()
    {
        try
        {
            $repository = new MakeRepository($this->database);
            $makesList = $repository->getAll();

            return $makesList;

        } catch (Exception $e) {
            throw $e;
        }
    }
}