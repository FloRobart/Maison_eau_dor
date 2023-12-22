<?php
// src/Controller/PanierController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Produit;
use App\Controller\PayController;


class PanierController extends AbstractController
{
	// Injection de dépendance
	public function __construct(private EntityManagerInterface $entityManager) {}

	#[Route('/panier', name: 'recuperer_produits_du_panier', methods: ['POST'])]
	public function recupererproduitsDuPanier(Request $request)
	{
		$data = json_decode($request->getContent(), true);
		$idsDuPanier = $data['idsPanier'];

		// Récupération des produits du panier
		$produitsDuPanier = $this->entityManager->getRepository(Produit::class)->findBy(['id' => $idsDuPanier]);

		// Vous pouvez maintenant renvoyer les produits récupérés en tant que réponse JSON
		$produitsArray = [];
		foreach ($produitsDuPanier as $produit) {
			$produitsArray[] = [
				'id' => $produit->getId(),
				'title' => $produit->getTitreProduit(),
				'prix' => $produit->getPrixProduit(),
				'image' => $produit->getIdPhoto()[0]->getPathPhoto()
			];
		}

		//$paiement = new PayController($this->entityManager);
		//$paiement->stripeCheckoutCart($produitsArray);

		return new JsonResponse($produitsArray);
	}
}
