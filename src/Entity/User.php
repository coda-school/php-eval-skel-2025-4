<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bio = null;

    #[ORM\Column(length: 255)]
    private ?string $MotDePasse = null;

    #[ORM\Column]
    private ?int $NombreFollowers = null;

    #[ORM\Column]
    private ?int $NombreFollowing = null;

    #[ORM\Column(nullable: true)]
    private ?int $NombreKweeks = null;

    #[ORM\Column]
    private ?int $NombreKweeksLikes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->MotDePasse;
    }

    public function setMotDePasse(string $MotDePasse): static
    {
        $this->MotDePasse = $MotDePasse;

        return $this;
    }

    public function getNombreFollowers(): ?int
    {
        return $this->NombreFollowers;
    }

    public function setNombreFollowers(int $NombreFollowers): static
    {
        $this->NombreFollowers = $NombreFollowers;

        return $this;
    }

    public function getNombreFollowing(): ?int
    {
        return $this->NombreFollowing;
    }

    public function setNombreFollowing(int $NombreFollowing): static
    {
        $this->NombreFollowing = $NombreFollowing;

        return $this;
    }

    public function getNombreKweeks(): ?int
    {
        return $this->NombreKweeks;
    }

    public function setNombreKweeks(?int $NombreKweeks): static
    {
        $this->NombreKweeks = $NombreKweeks;

        return $this;
    }

    public function getNombreKweeksLikes(): ?int
    {
        return $this->NombreKweeksLikes;
    }

    public function setNombreKweeksLikes(int $NombreKweeksLikes): static
    {
        $this->NombreKweeksLikes = $NombreKweeksLikes;

        return $this;
    }
}
