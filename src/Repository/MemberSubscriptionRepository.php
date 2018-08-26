<?php

namespace App\Repository;

use App\Entity\MemberSubscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MemberSubscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberSubscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberSubscription[]    findAll()
 * @method MemberSubscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberSubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MemberSubscription::class);
    }

//    /**
//     * @return MemberSubscription[] Returns an array of MemberSubscription objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MemberSubscription
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
