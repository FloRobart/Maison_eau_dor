<?php

namespace App\Controller\BackOffice; // Pourrait aussi être App\Controller\BackOffice\InsertionBase

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Photo;
use App\Entity\Categorie;
use App\Entity\Produit;

class CreationProduitsBaseController extends AbstractController
{
	// Injection de dépendance (permet d'accéder à l'entity manager)
	public function __construct( private EntityManagerInterface $entityManager ) {}

	#[Route('/insertion/base/produits', name: 'insertion_produits')]
	public function index(): Response
	{
		return $this->render('insertion_base/affichage.html.twig', [
			'controller_name' => 'InsertionProduitsBaseController',
			'data' => $this->creationProduitsBase(),
		]);
	}


	private function creationProduitsBase(): array
	{
		// Entity manager
		$entityManager = $this->entityManager;

		// Création des produits

		/*
		   ##############
		   # AFRICA BAY #
		   ##############
		*/
		$africa_bayArray = [
			'titre' => 'Africa Bay',
			'desc' => 'Parfum',
			'prix' => 30.00,
			'stock' => 100,
			'categorie' => ['parfum'],
			'format' => ['50ml'],
			'image' => 'africa_bay.jpg',
		];
		$africa_bay = new Produit();
		$africa_bay->setTitreProduit('Africa Bay');
		$africa_bay->setDescProduit(
			'Découvrez Africa Bay, un parfum envoûtant qui mêle des notes fraîches de citron et de cassis, des accords floraux de violette et de jasmin, '.
			'et des notes sensuelles de musc et d\'ambre. Une fragrance qui capture l\'esprit exotique et ensoleillé de l\'Afrique'
		);
		$africa_bay->setPrixProduit(30.00);
		$africa_bay->setStockProduit(100); // ¯\_(ツ)_/¯ 
		$africa_bay->addIdCategorie($entityManager->getRepository(Categorie::class)->findOneBy(['nom_categorie' => 'parfum']));
		//$africa_bay->addIdFormat($entityManager->getRepository(Format::class)->findOneBy(['nom_format' => '50ml']));
		$image = $entityManager->getRepository(Photo::class)->findOneBy(['nom_photo' => 'africa_bay.jpg']);
		if ($image) $africa_bay->addIdPhoto($image);
		else        $africa_bay->addIdPhoto($entityManager->getRepository(Photo::class)->findOneBy(['nom_photo' => 'placeholder.jpg']));

		
		/*
		   ##############
		   # Ahlam      #
		   ##############
		*/
		$ahlamArray = [
			'titre' => 'Ahlam',
			'desc' => 'Parfum',
			'prix' => 30.00,
			'stock' => 100,
			'categorie' => ['parfum'],
			'format' => ['50ml'],
			'image' => 'ahlam.jpg',
		];
		$ahlam = new Produit();
		$ahlam->setTitreProduit('Ahlam');
		$ahlam->setDescProduit(
			'Plongez dans un voyage olfactif envoûtant avec Ahlam, un extrait de parfum qui éveille les sens et laisse un sillage inoubliable.'
		);
		$ahlam->setPrixProduit(30.00);
		$ahlam->setStockProduit(100); // ¯\_(ツ)_/¯
		$ahlam->addIdCategorie($entityManager->getRepository(Categorie::class)->findOneBy(['nom_categorie' => 'parfum']));
		//$ahlam->addIdFormat($entityManager->getRepository(Format::class)->findOneBy(['nom_format' => '50ml']));
		$image = $entityManager->getRepository(Photo::class)->findOneBy(['nom_photo' => 'ahlam.jpg']);
		if ($image) $ahlam->addIdPhoto($image);
		else        $ahlam->addIdPhoto($entityManager->getRepository(Photo::class)->findOneBy(['nom_photo' => 'placeholder.jpg']));
		

		/*
		   ##############
		   # Al layl    #
		   ##############
		*/
		$al_laylArray = [
			'titre' => 'Al layl',
			'desc' => 'Parfum',
			'prix' => 30.00,
			'stock' => 100,
			'categorie' => ['parfum'],
			'format' => ['50ml'],
			'image' => 'al_layl.jpg',
		];
		$al_layl = new Produit();
		$al_layl->setTitreProduit('Al layl');
		$al_layl->setDescProduit(
			'Découvrez Al Layl, le parfum de la nuit. La vanille et l\'ambre s\'unissent pour créer une harmonie envoûtante et mystérieuse.'+
			' Laissez-vous captiver par cette fragrance qui révèle la beauté sombre et séduisante de la nuit.'
		);
		$al_layl->setPrixProduit(30.00);
		$al_layl->setStockProduit(100); // ¯\_(ツ)_/¯
		$al_layl->addIdCategorie($entityManager->getRepository(Categorie::class)->findOneBy(['nom_categorie' => 'parfum']));
		//$al_layl->addIdFormat($entityManager->getRepository(Format::class)->findOneBy(['nom_format' => '50ml']));
		$image = $entityManager->getRepository(Photo::class)->findOneBy(['nom_photo' => 'al_layl.jpg']);
		if ($image) $al_layl->addIdPhoto($image);
		else        $al_layl->addIdPhoto($entityManager->getRepository(Photo::class)->findOneBy(['nom_photo' => 'placeholder.jpg']));

		return [];
	}
}
