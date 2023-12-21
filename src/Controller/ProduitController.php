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

class ProduitController extends AbstractController
{
	// Injection de dépendance
	public function __construct( private EntityManagerInterface $entityManager ) {}

	#[Route('/produit/{id}', name: 'produit.index', methods: ['GET'])]
	public function index(int $id = null): Response
	{
		# Si l'id n'est pas un nombre ou est vide, on redirige vers le catalogue 
		if (!is_numeric($id) || is_null($id)) {
			return $this->redirectToRoute('catalogue');
		}

		// Récupération du produit
		$produit = $produit = $this->entityManager->getRepository(Produit::class)->find($id);
		$similaires = [];

		if (!is_null($produit)) {
			/* +--------------------------+
			   | Récupération des données |
			   +--------------------------+ */
			// Récupération du format du produit
			$format = $produit->getIdFormat()[0];
			// Récupération de la catégorie du produit
			$categorie = $produit->getIdCategorie()[0];
			// Récupération des produits similaires
			$produitsSimilaires = $categorie->getProduits()->toArray();
		
			// On enlève le produit actuel du tableau des produits similaires
			$pSFiltre = [];
			foreach ($produitsSimilaires as $pS) {
				if ($pS->getId() !== $id) {
					$pSFiltre[] = $pS;
				}
			}

			// Choix aléatoire de 3 produits similaires
			$tmpSimilaires = [];
			if (count($pSFiltre) < 3) {
				// Si on a moins de 3 produits similaires, on prend tous les produits similaires
				foreach ($pSFiltre as $pS) {
					$tmpSimilaires[] = $pS;
				}
			} else {
				while (count($tmpSimilaires) < 3) {
					$rand = floor(rand(0, count($pSFiltre) - 1));
					if (!in_array($pSFiltre[ $rand ], $tmpSimilaires)) { // Si le produit n'est pas déjà dans le tableau
						$tmpSimilaires[] = $pSFiltre[ $rand ];
					}
				}
			}


			// Récupération des photos du produit et des produits similaires
			$photos = $produit->getIdPhoto()->toArray();
			// Similaire 1
			if (count($tmpSimilaires) > 0) {
				$photosPS1 = $tmpSimilaires[0]->getIdPhoto()->toArray();
				
				foreach ($photosPS1 as $photo) {
					if (str_contains($photo->getPathPhoto(), '1') || str_contains($photo->getPathPhoto(), 'placeholder')) {
						$photoPS1 = $photo->getPathPhoto();
					} else { $photoPS1 = ''; }
				}
			}
			// Similaire 2
			if (count($tmpSimilaires) > 1) {
				$photosPS2 = $tmpSimilaires[1]->getIdPhoto()->toArray();
				foreach ($photosPS2 as $photo) {
					if (str_contains($photo->getPathPhoto(), '1') || str_contains($photo->getPathPhoto(), 'placeholder')) {
						$photoPS2 = $photo->getPathPhoto();
					} else { $photoPS2 = ''; }
				}
			}
			// Similaire 3
			if (count($tmpSimilaires) > 2) {
				$photosPS3 = $tmpSimilaires[2]->getIdPhoto()->toArray();
				foreach ($photosPS3 as $photo) {
					if (str_contains($photo->getPathPhoto(), '1') || str_contains($photo->getPathPhoto(), 'placeholder')) {
						$photoPS3 = $photo->getPathPhoto();
					}
					else { $photoPS3 = ''; }
				}
			}
			


			/* +---------------------------+
			   | Réaffectation des données |
			   +---------------------------+ */
			// Réaffectation des données dans le tableau $produit
			$produit = [
					"id" => $produit->getId(),
					"titre" => $produit->getTitreProduit(),
					"prix" => $produit->getPrixProduit(),
					"format" => [
						"id" => $format->getId(),
						"nom" => $format->getFormatProduit()
					],
					"image" => $photos, // Traité dans le template Twig 
					"categorie" => [
						"id" => $categorie->getId(),
						"nom" => $categorie->getNomCategorie()
					],
					"description" => $produit->getDescProduit(),
					"photos" => $photos
				];

			// dd($tmpSimilaires);

			// Réaffectation des données dans le tableau $similaires
			// Similaire 1
			if (count($tmpSimilaires) > 0) {
				array_push( $similaires,
					[
						"id" => $tmpSimilaires[0]->getId(),
						"titre" => $tmpSimilaires[0]->getTitreProduit(),
						"prix" => $tmpSimilaires[0]->getPrixProduit(),
						"image" => $photoPS1, 
						"categorie" => [
							"id" => $tmpSimilaires[0]->getIdCategorie()[0]->getId(),
							"nom" => $tmpSimilaires[0]->getIdCategorie()[0]->getNomCategorie()
						],
						"format" => [
							"id" => $tmpSimilaires[0]->getIdFormat()[0]->getId(),
							"nom" => $tmpSimilaires[0]->getIdFormat()[0]->getFormatProduit()
						]
					]
				);
			}

			// Similaire 2
			if (count($tmpSimilaires) > 1) {
				array_push( $similaires,
					[
						"id" => $tmpSimilaires[1]->getId(),
						"titre" => $tmpSimilaires[1]->getTitreProduit(),
						"prix" => $tmpSimilaires[1]->getPrixProduit(),
						"image" => $photoPS2, 
						"categorie" => [
							"id" => $tmpSimilaires[1]->getIdCategorie()[0]->getId(),
							"nom" => $tmpSimilaires[1]->getIdCategorie()[0]->getNomCategorie()
						],
						"format" => [
							"id" => $tmpSimilaires[1]->getIdFormat()[0]->getId(),
							"nom" => $tmpSimilaires[1]->getIdFormat()[0]->getFormatProduit()
						]
					]
				);
			}

			// Similaire 3
			if (count($tmpSimilaires) > 2) {
				array_push( $similaires,
					[
						"id" => $tmpSimilaires[2]->getId(),
						"titre" => $tmpSimilaires[2]->getTitreProduit(),
						"prix" => $tmpSimilaires[2]->getPrixProduit(),
						"image" => $photoPS3, 
						"categorie" => [
							"id" => $tmpSimilaires[2]->getIdCategorie()[0]->getId(),
							"nom" => $tmpSimilaires[2]->getIdCategorie()[0]->getNomCategorie()
						],
						"format" => [
							"id" => $tmpSimilaires[2]->getIdFormat()[0]->getId(),
							"nom" => $tmpSimilaires[2]->getIdFormat()[0]->getFormatProduit()
						]
					]
				);
			}

			/*$similaires = [
				[
					"id" => $tmpSimilaires[0]->getId(),
					"titre" => $tmpSimilaires[0]->getTitreProduit(),
					"prix" => $tmpSimilaires[0]->getPrixProduit(),
					"image" => $photoPS1, 
					"categorie" => [
						"id" => $tmpSimilaires[0]->getIdCategorie()[0]->getId(),
						"nom" => $tmpSimilaires[0]->getIdCategorie()[0]->getNomCategorie()
					],
					"format" => [
						"id" => $tmpSimilaires[0]->getIdFormat()[0]->getId(),
						"nom" => $tmpSimilaires[0]->getIdFormat()[0]->getFormatProduit()
					]
				],
				[
					"id" => $tmpSimilaires[1]->getId(),
					"titre" => $tmpSimilaires[1]->getTitreProduit(),
					"prix" => $tmpSimilaires[1]->getPrixProduit(),
					"image" => $photoPS2, 
					"categorie" => [
						"id" => $tmpSimilaires[1]->getIdCategorie()[0]->getId(),
						"nom" => $tmpSimilaires[1]->getIdCategorie()[0]->getNomCategorie()
					],
					"format" => [
						"id" => $tmpSimilaires[1]->getIdFormat()[0]->getId(),
						"nom" => $tmpSimilaires[1]->getIdFormat()[0]->getFormatProduit()
					]
				],
				[
					"id" => $tmpSimilaires[2]->getId(),
					"titre" => $tmpSimilaires[2]->getTitreProduit(),
					"prix" => $tmpSimilaires[2]->getPrixProduit(),
					"image" => $photoPS3, 
					"categorie" => [
						"id" => $tmpSimilaires[2]->getIdCategorie()[0]->getId(),
						"nom" => $tmpSimilaires[2]->getIdCategorie()[0]->getNomCategorie()
					],
					"format" => [
						"id" => $tmpSimilaires[2]->getIdFormat()[0]->getId(),
						"nom" => $tmpSimilaires[2]->getIdFormat()[0]->getFormatProduit()
					]
				]
			];*/
		}

		// dd($produit, $similaires);


		// Test
		// $produit = [
		// 	"id" => 1,
		// 	"titre" => "Produit 1",
		// 	"prix" => 10,
		// 	"image" => "https://picsum.photos/200/300",
		// 	"format" => "A4",
		// 	"categorie" => [
		// 		"id" => 1,
		// 		"nom" => "parfum"
		// 	],
		// 	"description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum. Quisquam, ven iatis dolo re",
		// ];

		// dd($produit, $similaires);

		return $this->render('produit.html.twig', 
			[
				"produit" => $produit,
				"similaires" => $similaires
			]
		);
	}
}