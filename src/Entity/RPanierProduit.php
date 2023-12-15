<?php

namespace App\Entity;

use App\Repository\RPanierProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RPanierProduitRepository::class)]
class RPanierProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idPanier = null;

    #[ORM\Column]
    private ?int $idProduit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPanier(): ?int
    {
        return $this->idPanier;
    }

    public function setIdPanier(int $idPanier): static
    {
        $this->idPanier = $idPanier;

        return $this;
    }

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function setIdProduit(int $idProduit): static
    {
        $this->idProduit = $idProduit;

        return $this;
    }
}
