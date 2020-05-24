<?php

namespace App\Repository;

use App\Entity\CreditCard;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CreditCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreditCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreditCard[]    findAll()
 * @method CreditCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreditCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditCard::class);
    }

    public function findAllByUser(User $user): array
    {
        return $this->createQueryBuilder('c')
            ->select('u')
            ->leftJoin('c.user', 'u')
            ->andWhere('u.id = :userId')
            ->setParameter('userId', $user->getId())
            ->getQuery()
            ->getResult();
    }
}
