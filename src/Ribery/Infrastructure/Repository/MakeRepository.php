<?php
namespace Ribery\Infrastructure\Repository;

use \PDO;
use \Ribery\Infrastructure\UnitOfWork\PdoUnitOfWork;
use \Ribery\Infrastructure\UnitOfWork\IUnitOfWork;
use \Ribery\Domain\Entity\Make;
use \Ribery\Domain\Contracts\Repository\IMakeRepository;


class MakeRepository implements IMakeRepository  
{
    private $database;

    public function __construct(IUnitOfWork $database)
    {
        $this->database = $database->getConnection();
    }

    public function getAll()
    {
        try {

            $stmt = $this->database->prepare("
                SELECT `id`, `name`
                FROM `tb_make`
                WHERE `active` = 1
            ");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            if ($stmt->execute())
                return $stmt->fetchAll();   

        } catch (Exception $e) {
            throw $e;
        }

        return array();
    }

    public function getById($id)
    {
        try {

            $stmt = $this->database->prepare("
                SELECT `id`, `name`
                FROM `tb_make`
                WHERE `active` = 1
                    AND `id` = :makeId;
            ");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(":makeId", $id, PDO::PARAM_INT);        
            
            if ($stmt->execute())
                return $stmt->fetch();

        } catch (Exception $e) {
            throw $e;
        }
        
        return null;
    }

    public function update(Make $make){}

    public function create(Make $make){}

    public function remove($makeId){}
}