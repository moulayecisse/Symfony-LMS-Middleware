<?php

namespace App\Repository;

use App\Entity\Testimonial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Testimonial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Testimonial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Testimonial[]    findAll()
 * @method Testimonial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestimonialRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Testimonial::class);
    }
}
