<?php
namespace Ribery\Infrastructure\UnitOfWork;

interface IUnitOfWork
{
    public function connect();
    public function closeConnection();
    public function commit();
    public function rollback();
}