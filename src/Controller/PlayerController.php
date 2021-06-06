<?php

namespace App\Controller;

use App\Entity\Player;
use App\Repository\PlayerResultRepository;
use App\Entity\PlayerResult;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Security;
use App\Repository\PlayerRepository;
use App\Helper\PlayerStatisticHelper;


class PlayerController extends AbstractController
{
	private $security;
	private $playerRepository;

	public function __construct(Security $security)
	{
		$this->security = $security;
	}

	#[Route('/player', name: 'player', methods: ['GET'])]
	public function index(): Response
	{
		$loggedPlayer = $this->security->getUser();
		$totalPlayedGames = $this->getDoctrine()->getRepository(Player::class)->getAllPlayerResultForGames($loggedPlayer);
		$playerStatisitcHelper = new PlayerStatisticHelper($totalPlayedGames);
		$playerStatistic = $playerStatisitcHelper->getPlayerStatistic();
		return $this->render('player/index.html.twig', [
			'player_statistic' => $playerStatistic,
			'game_results' => $totalPlayedGames,
		]);
	}

	#[Route('/player/{id}', name: 'player_show', methods: ['GET'])]
	public function show(Player $player): Response
	{
		return new Response($player->getFullName() . " " . $player->getEmail() . " " . $player->getPassword());
	}

	#[Route('/player/{id}', name: 'player_update', methods: ['UPDATE'])]
	public function update(Player $player): Response
	{
		$entityManager = $this->getDoctrine()->getManager();
		$player->setFirstName("Изменено");
		$entityManager->flush();

		return $this->redirectToRoute("player_show", [
			"id" => $player->getId()
		]);
	}
}
