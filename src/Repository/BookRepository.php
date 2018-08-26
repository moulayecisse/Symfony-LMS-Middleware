<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\EBook;
use App\Entity\Library;
use App\Entity\PBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @param $libraryId
     *
     * @return array
     */
    public function findByLibrary($libraryId): array
    {
        return $this->createQueryBuilder('book')
            ->join(PBook::class, 'pbook')
            ->where('pbook.book_id = book.id')
            ->distinct('pbook.book_id')

            ->join(Library::class, 'library')
            ->where('library.id = :library_id')
            ->setParameter('library_id', $libraryId)

            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function findBestSellers($limit = 10): array
    {
        return $this->createQueryBuilder('b')
            //->join(EBook::class, 'eb')
            //->where('eb.book_id = b.id')
            //->groupBy('eb.book_id')
            //->orderBy('eb.book_id')

            ->setMaxResults($limit)

            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $libraryId
     *
     * @return int
     */
    public function countByLibrary($libraryId)
    {
        $count = 0;

        try {
            $query = $this->createQueryBuilder('book')
                ->select('Count( book )')
                ->distinct('book')
                ->join(PBook::class, 'pbook', 'WITH', 'pbook.library_id = :library.id')
                ->setParameter('library_id', $libraryId)
                ->addSelect('pbook')
//                ->where( 'pbook = book.id' )
//                ->andWhere( 'pbook.library_id = :library_id' )

                ->getQuery()
//                ->getSingleScalarResult()
                ;

//            dd( $query );

//            $count = $query;

            $count = 0;
        } catch (NonUniqueResultException $e) {
            $count = 0;
        }

        return $count;
    }

    public function findTop($topNumber): array
    {
        $myQuery = $this->createQueryBuilder('book')
            ->join('book.pBooks', 'pbook')
            ->join('pbook.bookings', 'booking')
            ->join('book.image', 'image')
            ->addSelect('COUNT(book.id)')
            ->addSelect('image')
            ->groupBy('book.id')
            ->orderBy('COUNT(book.id)')
            ->setMaxResults($topNumber);

        return $myQuery
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * Compte le nombre de livres dans la BDD.
     *
     * @return int|mixed
     */
    public function findTotalBooks()
    {
        try {
            return $this->createQueryBuilder('a')
                ->select('COUNT(a)')
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
        }
    }
}
