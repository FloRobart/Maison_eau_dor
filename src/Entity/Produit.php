<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1000)]
    private ?string $descProduit = null;

    #[ORM\Column(length: 255)]
    private ?string $titreProduit = null;

    #[ORM\Column]
    private ?float $prixProduit = null;

    #[ORM\Column]
    private ?int $stockProduit = null;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'produits')]
    private Collection $idCategorie;

    #[ORM\ManyToMany(targetEntity: Format::class, inversedBy: 'produits')]
    private Collection $idFormat;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Photo::class)]
    private Collection $idPhoto;

    #[ORM\ManyToMany(targetEntity: Panier::class, inversedBy: 'produits')]
    private Collection $idPanier;

    public function __construct()
    {
        $this->idCategorie = new ArrayCollection();
        $this->idFormat = new ArrayCollection();
        $this->idPhoto = new ArrayCollection();
        $this->idPanier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Categorie>
     */
    public function getIdCategorie(): Collection
    {
        return $this->idCategorie;
    }

    public function addIdCategorie(Categorie $idCategorie): static
    {
        if (!$this->idCategorie->contains($idCategorie)) {
            $this->idCategorie->add($idCategorie);
        }

        return $this;
    }

    public function removeIdCategorie(Categorie $idCategorie): static
    {
        $this->idCategorie->removeElement($idCategorie);

        return $this;
    }

    /**
     * @return Collection<int, Format>
     */
    public function getIdFormat(): Collection
    {
        return $this->idFormat;
    }

    public function addIdFormat(Format $idFormat): static
    {
        if (!$this->idFormat->contains($idFormat)) {
            $this->idFormat->add($idFormat);
        }

        return $this;
    }

    public function removeIdFormat(Format $idFormat): static
    {
        $this->idFormat->removeElement($idFormat);

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getIdPhoto(): Collection
    {
        return $this->idPhoto;
    }

    public function addIdPhoto(Photo $idPhoto): static
    {
        if (!$this->idPhoto->contains($idPhoto)) {
            $this->idPhoto->add($idPhoto);
            $idPhoto->setProduit($this);
        }

        return $this;
    }

    public function removeIdPhoto(Photo $idPhoto): static
    {
        if ($this->idPhoto->removeElement($idPhoto)) {
            // set the owning side to null (unless already changed)
            if ($idPhoto->getProduit() === $this) {
                $idPhoto->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getIdPanier(): Collection
    {
        return $this->idPanier;
    }

    public function addIdPanier(Panier $idPanier): static
    {
        if (!$this->idPanier->contains($idPanier)) {
            $this->idPanier->add($idPanier);
        }

        return $this;
    }

    public function removeIdPanier(Panier $idPanier): static
    {
        $this->idPanier->removeElement($idPanier);

        return $this;
    }
}
