<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\Format;
use App\Entity\Photo;

class CatalogueController extends AbstractController
{
	// Injection de dépendance
	public function __construct( private EntityManagerInterface $entityManager ) {}

	#[Route('/catalogue', name: 'catalogue', methods: ['GET'])]
	public function index(): Response
	{
		// Rédirection vers bonne page si %3F dans l'url (car ? est encodé en %3F depuis routes.yaml)
		if (strpos($_SERVER['REQUEST_URI'], '%3F') !== false) {
			$url = str_replace('%3F', '?', $_SERVER['REQUEST_URI']);
			header('Location: ' . $url);
			exit();
		}

		// Récupération des paramètres de la requête (GET)
		$data = $this->traiteParametres();

		//dd($data);

		return $this->render('catalogue.html.twig', 
			[
				'produits' => $data['produits'],
				'nbPages' => $data['nbPages'],
				'photos' => $data['photos']
			]
		);
	}

	// Traite les paramètres de la requête
	private function traiteParametres(): array
	{
		// Récupération, validation et sanitization des paramètres de la requête
		$search = filter_input(INPUT_GET, 'search');
		$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
		$sort = filter_input(INPUT_GET, 'sortField');
		$order = filter_input(INPUT_GET, 'sortDirection');
		$categorie = filter_input(INPUT_GET, 'categorie');

		// dd($page, $sort, $order, $search);
		
		// Si les paramètres sont invalides, on les remplace par des valeurs par défaut
		if ( $page === false || $page === null || $page < 1 ) {
			$page = 1;
		}

		// Changement de la valeur de $sort pour correspondre à l'objet Produit 
		switch ( $sort ) {
			case 'id':
				$sort = 'id';
				break;
			case 'name':
				$sort = 'titreProduit';
				break;
			case 'prix':
				$sort = 'prixProduit';
				break;
			case 'stock':
				$sort = 'stockProduit';
				break;
			default:
				$sort = null;
				break;
		}

		// Récupération de la catégorie pour filtrer les produits
		$idCategorie = null;
		if ( $categorie !== null ) {
			// Récupération de l'id de la catégorie
			$categorie = $this->entityManager->getRepository(Categorie::class)->findOneBy(['nomCategorie' => $categorie]);
			if ( $categorie !== null ) {
				$idCategorie = $categorie->getId();
			}
		}

		// dd($ids, $categorie);

		
		// Récupération des produits
		$produits = $this->entityManager->getRepository(Produit::class)->findProduitSimilarByName(
			$search ?? '',                           // Si $search est null, on recherche tous les produits
			$idCategorie,                            // Si $idCategorie est null, on ne filtre pas par idCategorie
			[($sort ?? 'id') => ($order ?? 'ASC')],  // Si $sort est null, on trie par id
			16,                                      // Limite de 16 produits par page
			($page - 1) * 16                         // Offset (décalage) pour la pagination
		);

		// dd($produits);

		// Récupérations des images
		$photosBase = $this->entityManager->getRepository(Photo::class)->findAll();
		$photosBase = array_reverse($photosBase); // On inverse l'ordre des photos pour avoir les plus récentes en premier

		// Recreer un tableau avec les photos correspondant à chaque produit
		// parcours à l'envers (car les photos sont enregistrées dans l'ordre inverse)
		// pour chaque photo, on récupère le produit correspondant et on ajoute idProduit et pathPhoto dans un tableau
		$photos = [];
		$idProduitTracklist = []; // tableau qui va contenir les idProduit déjà traités (on prend qu'une photo par produit)
		foreach ($photosBase as $photo) {
			$idProduit = $photo->getProduit()->getId();
			$pathPhoto = $photo->getPathPhoto();
			if (!in_array($idProduit, $idProduitTracklist)) {
				$idProduitTracklist[] = $idProduit;
				$photos[$idProduit] = $pathPhoto;
			}
		}

		// dd($photosBase, $photos, $idProduitTracklist);
		
		// Test pour récupérer les produits d'une catégorie
		$test = $this->entityManager->getRepository(Categorie::class)->findOneBy(['nomCategorie' => 'parfum']);
		$test2 = $test->getProduits()->toArray();
		
		// dd($test, $test2);

		// dd($search ?? '', [$sort => $order ?? 'ASC'], 16, ($page - 1) * 16, $produits);

		
		// Pagination
		$nbProduits = count( $this->entityManager->getRepository(Produit::class)->findProduitSimilarByName(
			$search ?? '',
			$idCategorie
		) ); // Nb prod avec search (surtout sans limit et offset)
		$nbPages = (int) ceil($nbProduits / 16);

		$data = [
			'produits' => $produits,
			'nbPages' => $nbPages,
			'photos' => $photos
		];
		
		// dd($nbProduits, $produits, $search, $data);


		return $data;
	}
}
