<?php

namespace App\Controller;

use App\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class PlayerController extends AbstractController
{
	#[Route('/player', name: 'player', methods: ['GET'])]
	public function index(): Response
	{
		return $this->render('player/index.html.twig', [
			'controller_name' => 'PlayerController',
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
