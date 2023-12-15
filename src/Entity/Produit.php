<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idProduit = null;

    #[ORM\Column(length: 1000)]
    private ?string $descProduit = null;

    #[ORM\Column(length: 255)]
    private ?string $titreProduit = null;

    #[ORM\Column]
    private ?float $prixProduit = null;

    #[ORM\Column]
    private ?int $stockProduit = null;

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function getDescProduit(): ?string
    {
        return $this->descProduit;
    }

    public function setDescProduit(string $descProduit): static
    {
        $this->descProduit = $descProduit;

        return $this;
    }

    public function getTitreProduit(): ?string
    {
        return $this->titreProduit;
    }

    public function setTitreProduit(string $titreProduit): static
    {
        $this->titreProduit = $titreProduit;

        return $this;
    }

    public function getPrixProduit(): ?float
    {
        return $this->prixProduit;
    }

    public function setPrixProduit(float $prixProduit): static
    {
        $this->prixProduit = $prixProduit;

        return $this;
    }

    public function getStockProduit(): ?int
    {
        return $this->stockProduit;
    }

    public function setStockProduit(int $stockProduit): static
    {
        $this->stockProduit = $stockProduit;

        return $this;
    }
}
