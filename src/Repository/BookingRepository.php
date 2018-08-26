<?php

namespace App\Repository;

use App\Entity\Booking;
use App\Entity\Library;
use App\Entity\PBook;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    public function findByLibrary($libraryId)
    {
        return $this->createQueryBuilder('booking')
            ->join(PBook::class, 'pbook')
            ->join(Library::class, 'library')
            ->andWhere('library.id = :library_id')
            ->setParameter('library_id', $libraryId)

            ->getQuery()
            ->getResult();
    }

    /**
     * @param bool $libraryId
     * @param bool $memberId
     * @param bool $currentOnly
     * @param bool $late
     * @param null $date
     *
     * @return QueryBuilder
     */
    private function queryBooking($libraryId = false, $memberId = false, $currentOnly = false, $late = false, $date = null): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('b');

        $date = $date ?? new DateTime('now');

        if ($libraryId && is_int($libraryId)) {
            $queryBuilder->join('b.pBook', 'p');
            $queryBuilder->join('p.library', 'library');
            $queryBuilder->where('library.id = :library_id');
            $queryBuilder->setParameter('library_id', $libraryId);
        }

        if ($memberId && is_int($memberId)) {
            $queryBuilder->join('b.member', 'm');
            $queryBuilder->where('m.id = :member_id');
            $queryBuilder->setParameter('member_id', $memberId);
        }

        if ($currentOnly) {
            $queryBuilder->andWhere('b.returnDate IS NULL');
//            $queryBuilder->andWhere('b.endDate < :date');
//            $queryBuilder->setParameter('date', $date);
        }

        if ($late) {
            $queryBuilder->andWhere('b.returnDate IS NULL');
        }

        return $queryBuilder;
    }

    /**
     * @param bool $libraryId
     * @param bool $memberId
     * @param bool $currentOnly
     * @param bool $late
     * @param null $date
     *
     * @return Booking[]
     */
    public function findBooking($libraryId = false, $memberId = false, $currentOnly = false, $late = false, $date = null): array
    {
        $queryBuilder = $this->queryBooking($libraryId, $memberId, $currentOnly, $late, $date);

        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }

    /**
     * @param bool $libraryId
     * @param bool $memberId
     * @param bool $currentOnly
     * @param bool $late
     * @param null $date
     *
     * @return int
     */
    public function countBooking($libraryId = false, $memberId = false, $currentOnly = false, $late = false, $date = null): int
    {
        $queryBuilder = $this->queryBooking($libraryId, $memberId, $currentOnly, $late, $date);
        $queryBuilder = $queryBuilder->select('COUNT(b)');
        $query = $queryBuilder->getQuery();

        try {
            return $query->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }
    }

    public function findLateByLibrary($libraryId)
    {
        return $this->createQueryBuilder('booking')
            ->join(PBook::class, 'pbook')
            ->join(Library::class, 'library')

            ->where('booking.endDate < CURRENT_DATE()')
            ->andWhere('booking.returnDate IS NULL')
            ->andWhere('library.id = :library_id')
            ->setParameter('library_id', $libraryId)

            ->getQuery()
            ->getResult();
    }

    public function countLateByLibrary($libraryId)
    {
        try {
            return $this->createQueryBuilder('booking')
                ->select('COUNT(booking)')
                ->join(PBook::class, 'pbook')
                ->join(Library::class, 'library')

                ->where('booking.endDate < CURRENT_DATE()')
                ->andWhere('booking.returnDate IS NULL')
                ->andWhere('library.id = :library_id')
                ->setParameter('library_id', $libraryId)

                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }
    }

    /**
     * @param $libraryId
     *
     * @return int
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countByLibrary($libraryId): int
    {
        try {
            return $this->createQueryBuilder('booking')
                ->select('COUNT(booking)')
                ->join(PBook::class, 'pbook')

                ->join(Library::class, 'library')
                ->where('library.id = :library_id')

                ->setParameter('library_id', $libraryId)

                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }
    }

    public function truncate()
    {
        $connection = $this->getEntityManager()->getConnection();
        $platform = $connection->getDatabasePlatform();

        $connection->executeUpdate($platform->getTruncateTableSQL('booking', true));
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function findValueOfBookingForOneMember($value)
    {
        try {
            $count = $this->createQueryBuilder('a')
                ->select('COUNT(a)')
                ->where('a.member = :member_id')
                ->setParameter('member_id', $value)
                ->andWhere('a.endDate > CURRENT_DATE()')
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NonUniqueResultException $e) {
            return 0;
        }

        return $count;
    }

    /**
     * Find top bookings
     *
     * @param $topNumber
     *
     * @return array
     *
     */
    public function findTop($topNumber): array
    {
        $query = $this->createQueryBuilder('book')
            ->join('book.pBooks', 'pbook')
            ->join('pbook.bookings', 'booking')
            ->join('book.image', 'image')
            ->addSelect('COUNT(book.id)')
            ->addSelect('image')
            ->groupBy('book.id')
            ->orderBy('COUNT(book.id)')
            ->setMaxResults($topNumber);
        ;

        return $query
            ->getQuery()
            ->getArrayResult();

    }
}
