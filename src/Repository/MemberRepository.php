<?php

namespace App\Repository;

use App\Entity\Booking;
use App\Entity\Library;
use App\Entity\Member;
use App\Entity\PBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Member|null find($id, $lockMode = null, $lockVersion = null)
 * @method Member|null findOneBy(array $criteria, array $orderBy = null)
 * @method Member[]    findAll()
 * @method Member[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Member::class);
    }

    public function findLateByLibrary($libraryId)
    {
        return $this->findAll();
//        return $this->createQueryBuilder('member')
//            ->join( Booking::class, 'booking' )
//            ->join( Library::class, 'library' )
//            ->join( PBook::class, 'pbook' )

//            ->where('booking.endDate < CURRENT_DATE()')
//            ->andWhere('member.id = booking.member_id')
//            ->andWhere('booking.returnDate IS NULL')
//            ->andWhere('library.id = :library_id')
//            ->setParameter('library_id', $libraryId)

//            ->getQuery()
//            ->getResult()
//            ;
    }
}
