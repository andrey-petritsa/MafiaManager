<?php

namespace App\Repository;

use App\Entity\Player;
use App\Entity\PlayerResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlayerResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerResult[]    findAll()
 * @method PlayerResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerResult::class);
    }

//	public function getTotalGamesOfPlayer(Player $player) : int
//	{
//		$totalPlayedGames = $this->createQueryBuilder("ps")
//			->select('count(ps.id)')
//			->
//			->setParameter("player_id", $player->getId())
//			->getQuery()
//			->getSingleScalarResult();
//		return $totalPlayedGames;
//    }

    // /**
    //  * @return PlayerResult[] Returns an array of PlayerResult objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlayerResult
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
