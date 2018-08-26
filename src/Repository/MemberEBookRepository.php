<?php

namespace App\Repository;

use App\Entity\MemberEBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MemberEBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberEBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberEBook[]    findAll()
 * @method MemberEBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberEBookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MemberEBook::class);
    }

//    /**
//     * @return MemberEBook[] Returns an array of MemberEBook objects
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
    public function findOneBySomeField($value): ?MemberEBook
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
