<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Journey
 * @ORM\Entity()
 */
class Journey
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Car
     * @ORM\ManyToOne(targetEntity="App\Entity\Car")
     */
    private $car;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $conductor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JourneyStep", mappedBy="journey", cascade={"all"})
     */
    private $steps;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     */
    private $passengers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="journey", cascade={"all"})
     */
    private $messages;
}