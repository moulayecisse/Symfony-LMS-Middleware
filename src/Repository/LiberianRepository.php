<?php

namespace App\Repository;

use App\Entity\Librarian;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Librarian|null find($id, $lockMode = null, $lockVersion = null)
 * @method Librarian|null findOneBy(array $criteria, array $orderBy = null)
 * @method Librarian[]    findAll()
 * @method Librarian[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LiberianRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Librarian::class);
    }
}
