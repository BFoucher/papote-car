<?php

namespace App\Entity;

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
     * @var Journey
     * @ORM\ManyToOne(targetEntity="App\Entity\Journey", inversedBy="steps")
     */
    private $journey;

    /**
     * @var JourneyStep
     * @ORM\OneToOne(targetEntity="App\Entity\JourneyStep")
     */
    private $nextStep;

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCity():? string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return Journey
     */
    public function getJourney(): Journey
    {
        return $this->journey;
    }

    /**
     * @param Journey $journey
     */
    public function setJourney(Journey $journey): void
    {
        $this->journey = $journey;
    }

    /**
     * @return JourneyStep
     */
    public function getNextStep(): JourneyStep
    {
        return $this->nextStep;
    }

    /**
     * @param JourneyStep $nextStep
     */
    public function setNextStep(JourneyStep $nextStep): void
    {
        $this->nextStep = $nextStep;
    }
}