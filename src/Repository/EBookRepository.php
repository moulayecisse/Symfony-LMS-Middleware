<?php

namespace App\Repository;

use App\Entity\EBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method EBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method EBook[]    findAll()
 * @method EBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EBookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EBook::class);
    }
}
