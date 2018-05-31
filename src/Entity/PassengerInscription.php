<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PassengerInscription
 * @ORM\Entity()
 */
class PassengerInscription
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $passenger;

    /**
     * @var boolean
     * @ORM\Column(name="confirmed", type="boolean")
     */
    private $confirmed;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\JourneyStep")
     */
    private $stepStart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\JourneyStep")
     */
    private $stepEnd;
}