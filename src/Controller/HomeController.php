<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
	#[Route('/', name: 'index_page')]
	public function showIndexPage()
	{
		return $this->render('index/index.html.twig');
	}
}