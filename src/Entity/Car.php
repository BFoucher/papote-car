<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Car
 * @ORM\Entity()
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cars")
     */
    private $driver;

    /**
     * @var int
     * @Assert\Range(min="1", max="8")
     * @ORM\Column(name="number_of_seat", type="integer", nullable=false)
     */
    private $numberOfSeat;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getDriver(): User
    {
        return $this->driver;
    }

    /**
     * @param User $driver
     */
    public function setDriver(User $driver): void
    {
        $this->driver = $driver;
    }

    /**
     * @return int
     */
    public function getNumberOfSeat(): int
    {
        return $this->numberOfSeat;
    }

    /**
     * @param int $numberOfSeat
     */
    public function setNumberOfSeat(int $numberOfSeat): void
    {
        $this->numberOfSeat = $numberOfSeat;
    }
}