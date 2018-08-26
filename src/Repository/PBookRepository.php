<?php

namespace App\Repository;

use App\Entity\PBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method PBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method PBook[]    findAll()
 * @method PBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PBookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PBook::class);
    }


    /**
     * @param $libraryId
     *
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countLibraryPbook($libraryId) : int
    {
        try {
            return $this->createQueryBuilder('pbook')
                ->select('COUNT(pbook)')
                ->join(PBook::class, 'pbook')
                ->join(Library::class, 'library')

                ->andWhere('library.id = :library_id')
                ->setParameter('library_id', $libraryId)

                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }
    }

    public function findMostRentedByLibrary($libraryId, $limit = 10, $offset = 0)
    {
        return $this->findBy([ 'library' => $libraryId ], ['id' => 'ASC'], $limit, $offset);
    }
}
