<?php
namespace Ribery\Service;

use \Exception;
use \Ribery\Infrastructure\Repository\MakeRepository;
use \Ribery\Infrastructure\UnitOfWork\IUnitOfWork;
use \Ribery\Domain\Contracts\Service\IMakeService;
use Psr\Log\LoggerInterface;

class MakeService implements IMakeService
{
    private $database;
    private $logger;

    public function __construct(IUnitOfWork $database, LoggerInterface $logger)
    {
        $this->database = $database;
        $this->logger = $logger;
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