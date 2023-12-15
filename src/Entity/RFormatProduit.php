<?php

namespace App\Entity;

use App\Repository\RFormatProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RFormatProduitRepository::class)]
class RFormatProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idFormat = null;

    #[ORM\Column]
    private ?int $idProduit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFormat(): ?int
    {
        return $this->idFormat;
    }

    public function setIdFormat(int $idFormat): static
    {
        $this->idFormat = $idFormat;

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
