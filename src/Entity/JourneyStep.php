<?php

namespace App\Entity;
use Doctrine\Common\Annotations\Annotation\Target;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class JourneyStep
 * @ORM\Entity()
 */
class JourneyStep
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="city", type="string", length=250, nullable=false)
     */
    private $city;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(name="step_at", type="datetime", nullable=false)
     */
    private $stepAt;

    /**
     * @var Journey
     * @ORM\ManyToOne(targetEntity="App\Entity\Journey", inversedBy="steps")
     */
    private $journey;

    /**
     * @var JourneyStep
     * @ORM\OneToOne(targetEntity="App\Entity\JourneyStep")
     */
    private $nextStep;
}