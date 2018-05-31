<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     */
    private $car;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $conductor;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(name="step_at", type="datetime", nullable=false)
     * @Assert\GreaterThan("now")
     */
    private $startAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JourneyStep", mappedBy="journey", cascade={"all"})
     * @Assert\Count(
     *      min = 2,
     *      minMessage = "Vous devez avoir au moins deux étapes",
     * )
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

    public function __construct()
    {
        $this->steps = new ArrayCollection();
        $this->startAt = new \DateTime('tomorrow');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Car
     */
    public function getCar():? Car
    {
        return $this->car;
    }

    /**
     * @return User
     */
    public function getConductor(): User
    {
        return $this->conductor;
    }

    /**
     * @param User $conductor
     */
    public function setConductor(User $conductor): void
    {
        $this->conductor = $conductor;
    }

    /**
     * @param Car $car
     */
    public function setCar(Car $car): void
    {
        $this->car = $car;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getStartAt():? \DateTimeInterface
    {
        return $this->startAt;
    }

    /**
     * @param \DateTimeInterface $stepAt
     */
    public function setStartAt(\DateTimeInterface $startAt): void
    {
        $this->startAt = $startAt;
    }

    /**
     * @return ArrayCollection|null
     */
    public function getSteps():? ArrayCollection
    {
        return $this->steps;
    }

    /**
     * @param JourneyStep $step
     */
    public function addStep(JourneyStep $step)
    {
        if (!$this->steps->contains($step)) {
            $this->steps->add($step);
            $step->setJourney($this);
        }
    }

    /**
     * @param JourneyStep $step
     */
    public function removeStep(JourneyStep $step)
    {
        if ($this->steps->contains($step)) {
            $this->steps->remove($step);
            $step->setJourney(null);
        }
    }

    public function __toString()
    {
        return 'Journey-'.$this->id;
    }
}