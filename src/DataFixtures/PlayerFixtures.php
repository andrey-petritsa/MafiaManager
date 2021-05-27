<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PlayerFixtures extends Fixture
{
	private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
		$adminPlayer = $this->makeAdminUser();

		$manager->persist($adminPlayer);
		$manager->flush();
    }

	public function makeAdminUser() : Player
	{
		$player = new Player();
		$player->setFirstName("Андрей");
		$player->setLastName("Петрица");
		$player->setEmail("andrey@petritsa.ru");
		$player->setSex("man");
		$player->setPassword($this->passwordEncoder->encodePassword($player, '12345'));
		$player->setPatronymicName("Викторович");
		$player->setNickName("Бумажный");
		$player->setRoles(["ROLE_MAIN_ADMIN"]);

		return $player;
    }
}
