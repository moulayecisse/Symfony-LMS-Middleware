<?php

namespace App\Repository;

use App\Entity\SuperAdmin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SuperAdmin|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuperAdmin|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuperAdmin[]    findAll()
 * @method SuperAdmin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuperAdminRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SuperAdmin::class);
    }
}
