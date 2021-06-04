<?php

namespace App\DataFixtures;

use App\Entity\Club;
use App\Entity\Game;
use App\Entity\GameSession;
use App\Entity\Player;
use App\Entity\PlayerResult;
use App\Entity\Role;
use App\Repository\PlayerRepository;
use App\Repository\RoleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class AppFixtures extends Fixture
{
	private $passwordEncoder;
	private $package;
	private $playerRepository;
	private $clubRepositoy;
	private $gameSesssionRepository;
	private $playerResultRepository;
	private $gameRepository;
	//TODO Сделать DI

	public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $manager)
	{
		$this->passwordEncoder = $passwordEncoder;
		$this->package = new Package(new EmptyVersionStrategy());
		$this->playerRepository = $manager->getRepository(Player::class);
		$this->clubRepositoy = $manager->getRepository(Club::class);
		$this->gameSesssionRepository = $manager->getRepository(GameSession::class);
		$this->gameRepository = $manager->getRepository(Game::class);
		$this->playerResultRepository = $manager->getRepository(PlayerResult::class);
	}

    public function load(ObjectManager $manager)
    {
		$dummyUsers = $this->makeDummyUsers();
		foreach ($dummyUsers as $dummuUser) {
			$manager->persist($dummuUser);
		}
		$manager->flush();


		$dummyClubs = $this->makeDummyClubs();
		foreach ($dummyClubs as $dummyClub) {
			$manager->persist($dummyClub);
		}
		$manager->flush();

		$dummyGameSessions = $this->makeDummyGameSessions();
		foreach ($dummyGameSessions as $dummyGameSession) {
			$manager->persist($dummyGameSession);
		}
		$manager->flush();

		$dummyGames = $this->makeDummyGames();
		foreach ($dummyGames as $dummyGame) {
			$manager->persist($dummyGame);
		}
		$manager->flush();

		$dummyPlayerResults = $this->makeDummyPlayerResults();
		foreach ($dummyPlayerResults as $dummyPlayerResult) {
			$manager->persist($dummyPlayerResult);
		}
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

	public function makeDummyUsers() : array
	{
		$i = 0;
		$playersJson = json_decode(file_get_contents(__DIR__ . "/dummy_user.json"), true);
		$playerEntitys = [];

		foreach ($playersJson["users"] as $player) {
			$newPlayer = new Player();
			$newPlayer->setFirstName($player["firstName"]);
			$newPlayer->setLastName($player["lastName"]);
			$newPlayer->setPatronymicName($player["patronymicName"]);
			$newPlayer->setNickName($player["nickName"]);
			$newPlayer->setEmail($playersJson["shared"][0]["email"] . $i);
			$newPlayer->setPassword($this->passwordEncoder->encodePassword($newPlayer, $playersJson["shared"][0]["password"]));
			$newPlayer->setSex($playersJson["shared"][0]["sex"]);
			$newPlayer->setAvatar($playersJson["shared"][0]["avatar"]);

			$playerEntitys[] = $newPlayer;
			$i++;
		}

		return $playerEntitys;
	}

	public function makeDummyClubs() : array
	{
		$clubJson = json_decode(file_get_contents(__DIR__ . "/dummy_clubs.json"), true);
		$clubEntities = [];
		$allPlayers = $this->playerRepository->findAll();

		foreach ($clubJson as $club) {
			$newClub = new Club();
			$newClub->setName($club['name']);

			$organisatorPlayer = $allPlayers[$club["organisator"]];
			$newClub->setOrganisator($organisatorPlayer);
			$newClub->setCity($club['city']);
			$newClub->setLogo($club['logo']);

			$clubEntities[] = $newClub;
		}

		return $clubEntities;
	}

	public function makeDummyGameSessions() : array
	{
		$gameSessionEntities = [];
		$gameEntities = [];
		$allClubs = $this->clubRepositoy->findAll();
		$gameSessionsAmount = 20;
		for ($i = 0; $i < $gameSessionsAmount; $i++) {
			$gameSession = new GameSession();
			$gameSession->setDate($this->generateRandomDate());
			$gameSession->setGameType("game");
			$randomClub = $allClubs[array_rand($allClubs)];
			$gameSession->setClub($randomClub);
			$gameSessionEntities[] = $gameSession;
		}

		return $gameSessionEntities;
	}

	public function makeDummyGames() : array
	{
		$gameEntities = [];
		$gamesAmount = 500;
		$allGameSessions = $this->gameSesssionRepository->findAll();

		for($i = 0; $i < $gamesAmount; $i++) {
			$game = new Game();
			$randomGameSession = $allGameSessions[array_rand($allGameSessions)];
			$game->setGameSession($randomGameSession);
			$gameEntities[] = $game;
		}

		return $gameEntities;
	}

	public function makeDummyPlayerResults() : array
	{
		$playerResultEntities = [];
		$allPlayers = $this->playerRepository->findAll();
		$allGames = $this->gameRepository->findAll();
		$playerResultAmount = 1000;
		$roles = ["Мафия", "Мирный житель", "Дон", "Шериф"];

		for( $i = 0; $i < $playerResultAmount; $i++) {
		    $playerResult = new PlayerResult();

		    $randomRole = $roles[array_rand($roles)];
		    $randomGame = $allGames[array_rand($allGames)];
		    $randomPlayer = $allPlayers[ array_rand($allPlayers) ];
		    $randomBonus = rand(0, 2);
		    $randomWin = boolval(rand(0, 1));

		    $playerResult->setPlayer($randomPlayer);
		    $playerResult->setRole($randomRole);
		    $playerResult->setGame($randomGame);
		    $playerResult->setBonus($randomBonus);
		    $playerResult->setIsWin($randomWin);

		    $playerResultEntities[] = $playerResult;
		}

		return $playerResultEntities;
	}

	public function generateRandomDate()
	{
		$firstDateStamp = 1591238758;
		$lastDateStamp = 1622785558;

		$randomDateStamp = rand($firstDateStamp, $lastDateStamp);
		$date = new \DateTime();
		$date->setTimestamp($randomDateStamp);
		return $date;
	}

}
