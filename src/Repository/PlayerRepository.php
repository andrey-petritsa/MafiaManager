<?php

namespace App\Repository;

use App\Entity\Player;
use App\Entity\PlayerResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Player::class);
	}

	/**
	 * Used to upgrade (rehash) the user's password automatically over time.
	 */
	public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
	{
		if (!$user instanceof Player) {
			throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
		}

		$user->setPassword($newEncodedPassword);
		$this->_em->persist($user);
		$this->_em->flush();
	}

	public function getAllPlayerResultForGames(Player $player): array
	{
		$totalPlayedGames = $this->getEntityManager()->createQueryBuilder()
			->select( 'plr')
			->from(PlayerResult::class, "plr")
			->join('plr.player', 'p')
			->where("p = :player")
			->setParameter('player', $player)
			->getQuery()
			->getResult()
		;
		return $totalPlayedGames;
    }

	public function getAllPlayerResultForWinGames(Player $player)
	{
		$totalGamesThatPlayerWin = $this->getEntityManager()->createQueryBuilder()
			->select( 'plr')
			->from(PlayerResult::class, "plr")
			->join('plr.player', 'p')
			->where("p = :player")
			->andWhere("plr.is_win = true")
			->setParameter('player', $player)
			->getQuery()
			->getResult()
		;
		return $totalGamesThatPlayerWin;
    }

	// /**
	//  * @return Player[] Returns an array of Player objects
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
	public function findOneBySomeField($value): ?Player
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
