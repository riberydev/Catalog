<?php
namespace Ribery\Domain\Entity;

abstract class BaseEntity
{
    protected $id;
    protected $active;
    protected $_isValid = false;
    protected $createdAt;
    protected $updatedAt;

    protected function __construct()
    {
        $this->createdAt = (new \DateTime())->format('Y-m-d H:i:s');
    }

    protected function changeId($id)
    {
        if (empty($id) || false === filter_var($id, FILTER_VALIDATE_NUMBER_INT))
            throw new Exception(sprintf('%s is not a valid ID atribute', $id), 400);

        $this->id = (int) $id;
    }

    protected function changeActive($active)
    {
        if (empty($active) || false === filter_var($active, FILTER_SANITIZE_NUMBER_INT))
            throw new Exception(sprintf('%s is not a valid ACTIVE atribute', $active), 400);

        $this->active = (int) $active;
    }

    protected function changeUpdatedAt(DateTime $updateAt)
    {
        if (empty($updateAt) || !is_a($updateAt, '\DateTime'))
            throw new Exception(sprintf('%s is not a valid UPDATED_AT atribute', $updateAt), 400);

        $this->updateAt = $updateAt;
    }

    protected abstract function validate();
}