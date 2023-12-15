<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomUser = null;

    #[ORM\Column(length: 255)]
    private ?string $prenomUser = null;

    #[ORM\Column(length: 255)]
    private ?string $mailUser = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $dateNaissanceUser = null;

    #[ORM\Column(length: 11, nullable: true)]
    private ?string $telephoneUser = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresseUser = null;

    #[ORM\Column]
    private ?bool $isAdmin = null;

    #[ORM\Column(length: 255)]
    private ?string $mdpUser = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $numCarteUser = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $dateExpCarteUser = null;

    #[ORM\OneToOne(inversedBy: 'utilisateur', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Panier $idPanier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }

    public function setNomUser(string $nomUser): static
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    public function getPrenomUser(): ?string
    {
        return $this->prenomUser;
    }

    public function setPrenomUser(string $prenomUser): static
    {
        $this->prenomUser = $prenomUser;

        return $this;
    }

    public function getMailUser(): ?string
    {
        return $this->mailUser;
    }

    public function setMailUser(string $mailUser): static
    {
        $this->mailUser = $mailUser;

        return $this;
    }

    public function getDateNaissanceUser(): ?\DateTimeImmutable
    {
        return $this->dateNaissanceUser;
    }

    public function setDateNaissanceUser(?\DateTimeImmutable $dateNaissanceUser): static
    {
        $this->dateNaissanceUser = $dateNaissanceUser;

        return $this;
    }

    public function getTelephoneUser(): ?string
    {
        return $this->telephoneUser;
    }

    public function setTelephoneUser(?string $telephoneUser): static
    {
        $this->telephoneUser = $telephoneUser;

        return $this;
    }

    public function getadresseUser(): ?string
    {
        return $this->adresseUser;
    }

    public function setadresseUser(?string $adresseUser): static
    {
        $this->adresseUser = $adresseUser;

        return $this;
    }

    public function isIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): static
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function getMdpUser(): ?string
    {
        return $this->mdpUser;
    }

    public function setMdpUser(string $mdpUser): static
    {
        $this->mdpUser = $mdpUser;

        return $this;
    }

    public function getNumCarteUser(): ?string
    {
        return $this->numCarteUser;
    }

    public function setNumCarteUser(?string $numCarteUser): static
    {
        $this->numCarteUser = $numCarteUser;

        return $this;
    }

    public function getDateExpCarteUser(): ?string
    {
        return $this->dateExpCarteUser;
    }

    public function setDateExpCarteUser(?string $dateExpCarteUser): static
    {
        $this->dateExpCarteUser = $dateExpCarteUser;

        return $this;
    }

    public function getIdPanier(): ?Panier
    {
        return $this->idPanier;
    }

    public function setIdPanier(Panier $idPanier): static
    {
        $this->idPanier = $idPanier;

        return $this;
    }
}
