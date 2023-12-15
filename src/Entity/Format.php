<?php

namespace App\Entity;

use App\Repository\FormatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormatRepository::class)]
class Format
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idFormat = null;

    #[ORM\Column(nullable: true)]
    private ?int $formatProduit = null;

    public function getId(): ?int
    {
        return $this->idFormat;
    }

    public function getFormatProduit(): ?int
    {
        return $this->formatProduit;
    }

    public function setFormatProduit(?int $formatProduit): static
    {
        $this->formatProduit = $formatProduit;

        return $this;
    }
}
