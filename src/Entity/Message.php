<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Message
 * @ORM\Entity()
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
}