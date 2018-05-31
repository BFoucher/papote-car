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

    public function __construct(User $user)
    {
        $this->driver = $user;
    }

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
     * @var string
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

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
    public function getNumberOfSeat(): ?int
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

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


}