<?php

namespace App\Repository;

use App\Entity\ClubMembership;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClubMembership|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClubMembership|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClubMembership[]    findAll()
 * @method ClubMembership[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubMembershipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClubMembership::class);
    }

    // /**
    //  * @return ClubMembership[] Returns an array of ClubMembership objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClubMembership
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
