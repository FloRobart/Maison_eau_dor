<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
	#[Route('/catalogue', name: 'catalogue', methods: ['GET'])]
	public function index(): Response
	{
		// Faites vos actions spécifiques ici

		return $this->render('catalogue.html.twig');
	}
}
