<?php

namespace App\Model;

# Produits
use App\Entity\Produit;
use App\Repository\ProduitRepository;

# Categories
use App\Entity\Categorie;
use App\Repository\CategorieRepository;

# Formats
use App\Entity\Format;
use App\Repository\FormatRepository;

# Doctrine
use Doctrine\ORM\EntityManagerInterface;


class ParseProduitFiles {

    private $produitRepository;
    private $categorieRepository;
    private $formatRepository;

    private $em;

    public function __construct(ProduitRepository $produitRepository, CategorieRepository $categorieRepository, FormatRepository $formatRepository, EntityManagerInterface $em)
    {
        $this->produitRepository = $produitRepository;
        $this->categorieRepository = $categorieRepository;
        $this->formatRepository = $formatRepository;
        $this->em = $em;
    }

    public function createFormat()
    {
        $formats = [50, 100, 500];

        foreach($formats as $format) {
            $form = new Format();
            $form->setNomFormat($format);
            $this->em->persist($form);
        }
        $this->em->flush();
    }

    public function createCategorie()
    {
        $categories = ['Parfum'];

        foreach($categories as $categorie) {
            $categ = new Categorie();
            $categ->setNomCategorie($categorie);
            $this->em->persist($categ);
        }
        $this->em->flush();
    }

    public function parseProduitFiles()
    {
        $lines = file('public/produits/tous_les_parfums.txt');
        foreach($lines as $line) {
            $line = explode(';', $line);
            $produit = new Produit();
            $produit->setTitreProduit($line[0]);
            $produit->setPrixProduit($line[2]);
            $produit->setDescProduit($line[3]);
            $produit->setStockProduit(100);
            $produit->addIdCategorie($this->categorieRepository->find($line[4]));
            $produit->addIdFormat($this->formatRepository->find($line[1]));
            $this->em->persist($produit);
        }
        $this->em->flush();
    }
}
?>