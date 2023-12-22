<?php
namespace App\Controller;

// src/Controller/ProductController.php
namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends AbstractController
{
	#[Route('/', name: 'default.index', methods: ['GET'])]
	public function index(): Response
	{
		return $this->render('base.html.twig');
	}

	#[Route('/catalogue', name: 'default.catalogue', methods: ['GET'])]
	public function catalogue(): Response
	{
		return $this->forward(CatalogueController::class . '::index');
	}

	#[Route('/produit', name: 'default.produit', methods: ['GET'])]
	public function produit(): Response
	{
		return $this->forward(ProduitController::class . '::index');
	}

	#[Route('/connexion', name: 'default.login', methods: ['GET'])]
	public function login(): Response
	{
		return $this->render('login.html.twig');
	}

	#[Route('/inscription', name: 'default.register', methods: ['GET'])]
	public function register(): Response
	{
		return $this->render('register.html.twig');
	}

	#[Route('/espace_utilisateur', name: 'default.user', methods: ['GET'])]
	public function user(): Response
	{
		return $this->render('base_user.html.twig');
	}

	#[Route('/contact', name: 'default.contact', methods: ['GET'])]
	public function contact(): Response
	{
		return $this->render('contact.html.twig');
	}

	#[Route('/mentions-legales', name: 'default.legal', methods: ['GET'])]
	public function legal(): Response
	{
		return $this->render('legal.html.twig');
	}

	#[Route('/A_propos', name: 'default.about', methods: ['GET'])]
	public function about(): Response
	{
		return $this->render('about.html.twig');
	}

	#[Route('/privacy', name: 'default.privacy', methods: ['GET'])]
	public function privacy(): Response
	{
		return $this->render('privacy.html.twig');
	}

	#[Route('/cgv', name: 'default.cgv', methods: ['GET'])]
	public function cgv(): Response
	{
		return $this->render('cgv.html.twig');
	}

	#[Route('/cookies', name: 'default.cookies', methods: ['GET'])]
	public function cookies(): Response
	{
		return $this->render('cookies.html.twig');
	}

	#[Route('/panier', name: 'default.panier', methods: ['GET'])]
	public function panier(): Response
	{
		return $this->forward(PanierController::class . '::recupererproduitsDuPanier');
	}
}
