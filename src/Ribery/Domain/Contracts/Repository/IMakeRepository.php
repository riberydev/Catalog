<?php
namespace Ribery\Domain\Contracts\Repository;

use \Ribery\Domain\Entity\Make;

interface IMakeRepository
{
    public function getAll();

    public function getById($id);

    public function update(Make $make);

    public function create(Make $make);

    public function remove($makeId);
}