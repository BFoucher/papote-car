<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Message
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Journey
     * @ORM\ManyToOne(targetEntity="App\Entity\Journey", inversedBy="messages")
     */
    private $journey;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(name="sended_at", type="datetime", nullable=false)
     */
    private $sendedAt;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $sender;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $message;

    public function __construct(User $user)
    {
        $this->sendedAt = new \DateTimeImmutable();
        $this->sender = $user;
    }

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
     * @return Journey
     */
    public function getJourney(): ?Journey
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
     * @return \DateTimeInterface
     */
    public function getSendedAt(): \DateTimeInterface
    {
        return $this->sendedAt;
    }

    /**
     * @param \DateTimeInterface $sendedAt
     */
    public function setSendedAt(\DateTimeInterface $sendedAt): void
    {
        $this->sendedAt = $sendedAt;
    }

    /**
     * @return User
     */
    public function getSender(): User
    {
        return $this->sender;
    }

    /**
     * @param User $sender
     */
    public function setSender(User $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}