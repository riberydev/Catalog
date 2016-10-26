<?php
namespace Ribery\Infrastructure\UnitOfWork;

use \PDO;
use \Exception;
use \PDOException;
use \Ribery\Infrastructure\UnitOfWork\IUnitOfWork;


class PdoUnitOfWork implements IUnitOfWork
{
    private $connection = null;
    private $stmt;
    private $dsn;
    private $user;
    private $pass;

    public function __construct($dsn, $user, $pass)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->pass = $pass;

        $this->connect();
    }

    public function connect()
    {
        $options = array(
            PDO::ATTR_PERSISTENT            => true,
            PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND    => 'SET NAMES utf8'
        );

        try {
            $this->connection = new PDO($this->dsn, $this->user, $this->pass, $options);

        } catch(PDOException $e) {
            $this->connecloseConnection();
            throw $e;
        }
    }

    public function closeConnection()
    {
        $this->connection = null;
    }

    public function getConnection()
    {
        if ($this->connection instanceof PDO)
            return $this->connection;
        
        throw new Exception('No one connection is active.');
    }

    public function commit()
    {
        return $this->connection->commit();
    }
    
    public function rollback()
    {
        return $this->connection->rollback();
    }

    public function __destruct()
    {
        $this->closeConnection();
    }
}