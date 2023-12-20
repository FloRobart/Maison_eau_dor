<?php

namespace App\Controller\BackOffice; // Pourrait aussi être App\Controller\BackOffice\InsertionBase

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\Format;
use App\Entity\Photo;

class ProduitInsertionController extends AbstractController
{
	// Entity manager (permet d'accéder à la base de données, vient du MainInsertionController)
	public function __construct( private EntityManagerInterface $entityManager ) {}

	public function ajouterProduits(): void
	{
		// Package path (pour utiliser {{ asset() }} dans un controller)
		$package = new Package(new EmptyVersionStrategy());


		// lecture du fichier JSON des produits
		$produits = file_get_contents($package->getUrl('data/produits.json'));
		// décoder le fichier
		$produits = json_decode($produits, true);
		if ( $produits === null ) {
			throw new \Exception('Erreur lors du décodage du fichier JSON');
		}


		// Trackers
		$createdCategories = []; // Garde en mémoire les catégories créées
		$createdFormats = []; // Garde en mémoire les formats créés

		// Création des parfums
		foreach ( $produits["produits"] as $produit ) {
			//dd($produit, $produit['categorie']);
			// Création d'un produit
			$prod = new Produit();
			$prod->setDescProduit($produit['description']);
			$prod->setTitreProduit($produit['nom']);
			$prod->setPrixProduit($produit['prix']);
			$prod->setStockProduit($produit['stock']);

			// Catégorie
			if (!isset($createdCategories[$produit['categorie']])) { // Si la catégorie n'a pas encore été créée
				// Création d'une catégorie
				$category = new Categorie();
				$category->setNomCategorie($produit['categorie']);
				$category->addProduit($prod);
				$this->entityManager->persist($category);
				$createdCategories[$produit['categorie']] = $category; // Garde en mémoire la catégorie créée
			} else {
				$category = $createdCategories[$produit['categorie']]; // Récupère la catégorie créée à partir de la mémoire
				$category->addProduit($prod);
			}
			$prod->addIdCategorie($category);

			// Format
			if (!isset($createdFormats[$produit['format']])) { // Si le format n'a pas encore été créé
				// Création d'un format
				$format = new Format();
				$format->setFormatProduit($produit['format']);
				$format->addProduit($prod);
				$this->entityManager->persist($format);
				$createdFormats[$produit['format']] = $format; // Garde en mémoire le format créé
			} else {
				$format = $createdFormats[$produit['format']]; // Récupère le format créé à partir de la mémoire
				$format->addProduit($prod);
			}
			$prod->addIdFormat($format);


			// Photo
			// Structure des données
			// public/images : contient les dossiers des photos
			// public/images/produit1 : contient les photos du produit1

			// Boucle sur les produits
			// Pour chaque produit, boucle sur les photos
			// Pour chaque photo, création d'une entité Photo
			// Pour chaque photo, ajout de l'entité Photo en base

			// Chemin des photos 
			$nomProduitTraite = mb_strtolower($produit['nom']); // en minuscule (avec les accents)
			// Remplace les caractères accentués 
			$nomProduitTraite = strtr($nomProduitTraite, [
				"à" => "a", "â" => "a", "ä" => "a", "á" => "a", "ã" => "a", "å" => "a", "æ" => "ae",
				"ç" => "c",
				"è" => "e", "é" => "e", "ê" => "e", "ë" => "e",
				"ì" => "i", "í" => "i", "î" => "i", "ï" => "i",
				"ñ" => "n",
				"ò" => "o", "ô" => "o", "ö" => "o", "ó" => "o", "õ" => "o", "ø" => "o",
				"ù" => "u", "û" => "u", "ü" => "u", "ú" => "u",
				"ý" => "y", "ÿ" => "y",
				"œ" => "oe",
				"À" => "A", "Â" => "A", "Ä" => "A", "Á" => "A", "Ã" => "A", "Å" => "A", "Æ" => "AE",
				"Ç" => "C",
				"È" => "E", "É" => "E", "Ê" => "E", "Ë" => "E",
				"Ì" => "I", "Í" => "I", "Î" => "I", "Ï" => "I",
				"Ñ" => "N",
				"Ò" => "O", "Ô" => "O", "Ö" => "O", "Ó" => "O", "Õ" => "O", "Ø" => "O",
				"Ù" => "U", "Û" => "U", "Ü" => "U", "Ú" => "U",
				"Ý" => "Y",
				"Œ" => "OE",
			]); // Chiant mais Normalizer, iconv et mb_convert_encoding n'ont pas fonctionné 
			$nomProduitTraite = strtr($nomProduitTraite, ["'" => "", " " => "_",]); // Remplace les apostrophes et les espaces
			$dossierCible = 'images/produits/' . $nomProduitTraite . '/';
			// Nom du dossier cible ( "Ahlam"          => "images/produits/ahlam/"           )
			//                        "Nurai Sland"    => "images/produits/nurai_sland/"     
			//                        "Suprême Flower" => "images/produits/supreme_flower/"  (╯°□°）╯︵ ┻━┻
			//                        "Oudy's"         => "images/produits/oudys/"           
			// On pourrait créer le dossier ici si il n'existe pas, mais le créer manuellement evite des problèmes de droits (précédemment vécu sur PortfolioMaker)


			// Boucle sur les images du dossier cible
			$photoEntity = null;
			if (is_dir($dossierCible)) {
				$imagesProd = scandir($dossierCible);
				foreach ($imagesProd as $imageProd) {
					if ($imageProd != '.' && $imageProd != '..') {
						// Création de l'entité Photo
						$photoEntity = new Photo();
						$photoEntity->setPathPhoto($dossierCible . $imageProd);
						$photoEntity->setProduit($prod);
						// Ajout de l'entité Photo en base
						$this->entityManager->persist($photoEntity);
						$prod->addIdPhoto($photoEntity);
					}
				}
				// Si il n'y a pas de photos dans le dossier cible
				if ($photoEntity === null) {
					// Ajout d'une photo placeholder 
					$photoEntity = new Photo();
					$photoEntity->setPathPhoto('images/placeholder.png');
					$photoEntity->setProduit($prod);
					$this->entityManager->persist($photoEntity);
					$prod->addIdPhoto($photoEntity);
				}
			}



			// Persister le produit
			$this->entityManager->persist($prod);
		}

		// Enregistrer les données en base
		$this->entityManager->flush();
	}
}