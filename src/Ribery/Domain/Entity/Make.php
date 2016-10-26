<?php
namespace Ribery\Domain\Entity;

use DateTime;
use \Ribery\Domain\Entity\Entiy;

/**
 * @Entity @Table(name="make")
 **/
class Make extends BaseEntity
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $image;

    public function __construct($name, $description, $website, $image)
    {
        $this->id = 0;
        $this->name = (string) $name;
        $this->description = (string) $description;
        $this->website = (string) $website;
        $this->image = (string) $image;

        $this->validate();
    }

    private function getName()
    {
        return $this->name;
    }

    private function getDescription()
    {
        return $this->description;
    }

    private function getImage()
    {
        return $this->image;
    }

    private function getWebsite()
    {
        return $this->website;
    }

    public function validate()
    {
        if (empty($this->name) || !is_string($this->name) || strlen($this->name) < self::MIN_LENGTH_NAME)
            throw new CompanyException(sprintf('%s is not a valid company name', $this->name), 400);

        if (empty($this->name) || !is_string($this->name) || strlen($this->name) < self::MIN_LENGTH_NAME)
            throw new CompanyException(sprintf('%s is not a valid company name', $this->name), 400);

        if (empty($this->name) || !is_string($this->name) || strlen($this->name) < self::MIN_LENGTH_NAME)
            throw new CompanyException(sprintf('%s is not a valid company name', $this->name), 400);

        $this->_isValid = true;
    }

    public function isValid()
    {
        return (bool) $this->_isValid;
    }
}