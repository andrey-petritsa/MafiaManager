<?php

namespace App\Repository;

use App\Entity\ClubAdmin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClubAdmin|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClubAdmin|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClubAdmin[]    findAll()
 * @method ClubAdmin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubAdminRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClubAdmin::class);
    }

    // /**
    //  * @return ClubAdmin[] Returns an array of ClubAdmin objects
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
    public function findOneBySomeField($value): ?ClubAdmin
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
