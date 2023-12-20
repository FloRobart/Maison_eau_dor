<?php

namespace App\Controller\BackOffice; // Pourrait aussi être App\Controller\BackOffice\InsertionBase

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\BackOffice\ProduitInsertionController;
use App\Entity\Categorie;
use App\Entity\Format;
use App\Entity\Produit;
use App\Entity\Photo;

class MainInsertionController extends AbstractController
{
	// Injection de dépendance 
	public function __construct( 
		private EntityManagerInterface $entityManager,
		private ProduitInsertionController $produitController,
		) {}

	#[Route('/insertion/base/all', name: 'insertion_base')]
	public function index(): Response
	{
		// Suppression des données en base
		$this->suppressionDonneesBase();

		// Créer et ajouter des entités
		$this->produitController->ajouterProduits();


		// Récupération des données en base (Objets)
		$categoriesEnBase = $this->entityManager->getRepository(Categorie::class)->findAll();
		$produitsEnBase = $this->entityManager->getRepository(Produit::class)->findAll();
		$formatsEnBase = $this->entityManager->getRepository(Format::class)->findAll();
		$photosEnBase = $this->entityManager->getRepository(Photo::class)->findAll();

		//dd($categoriesEnBase, $produitsEnBase, $formatsEnBase, $photosEnBase);

		/* ##############################################
		   Transforamtion des données en base en tableau 
		   ############################################## */
		// Les catégories
		$categoriesArray = [];
		foreach ($categoriesEnBase as $categorie) {
			$categoriesArray[] = [
				'id' => $categorie->getId(),
				'nom' => $categorie->getNomCategorie(),
			];
		}

		// Les produits
		$produitsArray = [];
		foreach ($produitsEnBase as $produit) {
			// Transforme les objets en string pour l'affichage dans les produits (catégorie, format, photo)
			// Categorie
			$categoriesString = '';
			$categoriesArrayProd = $produit->getIdCategorie()->toArray(); // Convert PersistentCollection to array
			$lastKey = key(array_slice($categoriesArrayProd, -1, 1, true)); // Dernière clé du tableau
			foreach ($categoriesArrayProd as $key => $categorie) {
				$categoriesString .= $categorie->getId();
			
				if ($key !== $lastKey) {
					$categoriesString .= ', ';
				}
			}

			// Format
			$formatsString = '';
			$formatsArray = $produit->getIdFormat()->toArray(); // Convert PersistentCollection to array
			$lastKey = key(array_slice($formatsArray, -1, 1, true)); // Dernière clé du tableau
			foreach ($formatsArray as $key => $format) {
				$formatsString .= $format->getId();
			
				if ($key !== $lastKey) {
					$formatsString .= ', ';
				}
			}

			// Photo
			$photosString = '';
			$photosArray = $produit->getIdPhoto()->toArray(); // Convert PersistentCollection to array
			$lastKey = key(array_slice($photosArray, -1, 1, true)); // Dernière clé du tableau
			foreach ($photosArray as $key => $photo) {
				$photosString .= $photo->getId();
			
				if ($key !== $lastKey) {
					$photosString .= ', ';
				}
			}

			// Array de produits
			$produitsArray[] = [
				'id' => $produit->getId(),
				'titre' => $produit->getTitreProduit(),
				'prix' => $produit->getPrixProduit(),
				'categorieIds' => $categoriesString,
				'formatIds' => $formatsString,
				'photoIds' => $photosString,
			];
		}
		
		// Les formats
		$formatsArray = [];
		foreach ($formatsEnBase as $format) {
			$formatsArray[] = [
				'id' => $format->getId(),
				'format' => $format->getFormatProduit(),
			];
		}

		// Les photos
		$photosArray = [];
		foreach ($photosEnBase as $photo) {
			$photosArray[] = [
				'id' => $photo->getId(),
				'produitId' => $photo->getProduit()->getId(),
				'chemin' => $photo->getPathPhoto(),
			];
		}

		// dd($categoriesArray, $produitsArray, $formatsArray, $photosArray);


		// Affichage des données en base
		return $this->render('insertion_base/affichage.html.twig', [
			'controller_name' => 'InsertionBaseController',
			'data' => [
				'categories' => $categoriesArray,
				'produits' => $produitsArray,
				"formats" => $formatsArray,
				"photos" => $photosArray,
			],
		]);
	}

	private function suppressionDonneesBase(): void
	{
		// Entity manager (permet d'accéder à la base de données)
		$entityManager = $this->entityManager;

		// Récupération des données en base
		$categoriesEnBase = $entityManager->getRepository(Categorie::class)->findAll();
		$produitsEnBase = $entityManager->getRepository(Produit::class)->findAll();
		$formatsEnBase = $entityManager->getRepository(Format::class)->findAll();
		$photosEnBase = $entityManager->getRepository(Photo::class)->findAll();

		// photo
		foreach ($photosEnBase as $photo) {
			$entityManager->remove($photo);
		}
		// produit
		foreach ( $produitsEnBase as $produitEnBase ) {
			$entityManager->remove($produitEnBase);
		}
		// format
		foreach ($formatsEnBase as $format) {
			$entityManager->remove($format);
		}
		// catégorie
		foreach ($categoriesEnBase as $categorie) {
			$entityManager->remove($categorie);
		}

		// Suppression des données en base 
		$entityManager->flush(); 
		
		// Réinitialisation des auto-incrémentation des tables
		$entityManager->getConnection()->executeStatement('ALTER TABLE photo AUTO_INCREMENT = 1;');
		$entityManager->getConnection()->executeStatement('ALTER TABLE format AUTO_INCREMENT = 1;');
		$entityManager->getConnection()->executeStatement('ALTER TABLE produit AUTO_INCREMENT = 1;');
		$entityManager->getConnection()->executeStatement('ALTER TABLE categorie AUTO_INCREMENT = 1;');
	}

}