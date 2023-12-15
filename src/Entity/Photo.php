<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idPhoto = null;

    #[ORM\Column(length: 255)]
    private ?string $pathPhoto = null;

    #[ORM\Column]
    private ?int $idProduit = null;

    public function getIdPhoto(): ?int
    {
        return $this->idPhoto;
    }

    public function getPathPhoto(): ?string
    {
        return $this->pathPhoto;
    }

    public function setPathPhoto(string $pathPhoto): static
    {
        $this->pathPhoto = $pathPhoto;

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
