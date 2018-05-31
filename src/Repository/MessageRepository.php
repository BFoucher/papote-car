<?php

namespace App\Repository;

use App\Entity\Message;
use App\Entity\Test;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Test|null find($id, $lockMode = null, $lockVersion = null)
 * @method Test|null findOneBy(array $criteria, array $orderBy = null)
 * @method Test[]    findAll()
 * @method Test[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function findMessageForUser(User $user){
        $qb = $this->createQueryBuilder('message')
            ->leftJoin('message.journey', 'journey')
            ->leftJoin('journey.passengers', 'passengers')
            ->leftJoin('journey.conductor', 'conductor')
            ->where('passengers = :user')
            ->orWhere('conductor = :user')
            ->orderBy('message.sendedAt', 'ASC')
            ->setParameter('user', $user);

        return $qb->getQuery()->getResult();
    }
}
