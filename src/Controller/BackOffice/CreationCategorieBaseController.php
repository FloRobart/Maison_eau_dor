<?php

namespace App\Controller\BackOffice; // Pourrait aussi être App\Controller\BackOffice\InsertionBase

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categorie;

class CreationCategorieBaseController extends AbstractController
{
	// Injection de dépendance (permet d'accéder à l'entity manager)
	public function __construct( private EntityManagerInterface $entityManager ) {}

	#[Route('/insertion/base/categorie', name: 'insertion_categorie')]
	public function index(): Response
	{
		return $this->render('insertion_base/affichage.html.twig', [
			'controller_name' => 'InsertionCategorieBaseController',
			'data' => $this->creationCategorieBase(),
		]);
	}


	private function creationCategorieBase(): array
	{
		// Catégorie = Tags (selon schéma)
		// Catégorie :
		// - Parfum
		// - évasion goumande (parfum spécifique)
		// - spray
		// - musc
		// - cosmétique
		// - produit capillaire

		// Création des catégories
		$parfum = new Categorie();
		$parfum->setNomCategorie('parfum');

		$evasionGourmande = new Categorie();
		$evasionGourmande->setNomCategorie('evasion');

		$spray = new Categorie();
		$spray->setNomCategorie('spray');

		$musc = new Categorie();
		$musc->setNomCategorie('musc');

		$cosmetique = new Categorie();
		$cosmetique->setNomCategorie('cosmetique');

		$produitCapillaire = new Categorie();
		$produitCapillaire->setNomCategorie('produit capillaire');

		// Insertion en base
		$entityManager = $this->entityManager;

		$entityManager->persist($parfum);
		$entityManager->persist($evasionGourmande);
		$entityManager->persist($spray);
		$entityManager->persist($musc);
		$entityManager->persist($cosmetique);
		$entityManager->persist($produitCapillaire);

		$entityManager->flush(); // Envoi en base (commenter pour tester la vue)


		// Retour pour affichage dans la vue (obliger de faire un tableau, car la conversiotn json utilise le constructeur de l'objet pour encoder)
		$parfumArray = [
			'id' => $parfum->getId(),
			'nomCategorie' => $parfum->getNomCategorie(),
		];
		$evasionGourmandeArray = [
			'id' => $evasionGourmande->getId(),
			'nomCategorie' => $evasionGourmande->getNomCategorie(),
		];
		$sprayArray = [
			'id' => $spray->getId(),
			'nomCategorie' => $spray->getNomCategorie(),
		];
		$muscArray = [
			'id' => $musc->getId(),
			'nomCategorie' => $musc->getNomCategorie(),
		];
		$cosmetiqueArray = [
			'id' => $cosmetique->getId(),
			'nomCategorie' => $cosmetique->getNomCategorie(),
		];
		$produitCapillaireArray = [
			'id' => $produitCapillaire->getId(),
			'nomCategorie' => $produitCapillaire->getNomCategorie(),
		];
		return [ $parfumArray, $evasionGourmandeArray, $sprayArray, $muscArray, $cosmetiqueArray, $produitCapillaireArray ];
	}
}
