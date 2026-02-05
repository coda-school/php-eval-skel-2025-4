<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $NombreDeLikes = null;

    #[ORM\Column]
    private ?int $NombreDeVues = null;

    #[ORM\Column]
    private ?int $NombreDeCommentaires = null;

    #[ORM\Column(length: 280)]
    private ?string $ContenuDuKweek = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\ManyToMany(targetEntity: User::class)]
    #[ORM\JoinTable(name: "post_likes")]
    private Collection $likes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreDeLikes(): ?int
    {
        return $this->NombreDeLikes;
    }

    public function setNombreDeLikes(int $NombreDeLikes): static
    {
        $this->NombreDeLikes = $NombreDeLikes;
        return $this;
    }

    public function getNombreDeVues(): ?int
    {
        return $this->NombreDeVues;
    }

    public function setNombreDeVues(int $NombreDeVues): static
    {
        $this->NombreDeVues = $NombreDeVues;
        return $this;
    }

    public function getNombreDeCommentaires(): ?int
    {
        return $this->NombreDeCommentaires;
    }

    public function setNombreDeCommentaires(int $NombreDeCommentaires): static
    {
        $this->NombreDeCommentaires = $NombreDeCommentaires;
        return $this;
    }

    public function getContenuDuKweek(): ?string
    {
        return $this->ContenuDuKweek;
    }

    public function setContenuDuKweek(string $ContenuDuKweek): static
    {
        $this->ContenuDuKweek = $ContenuDuKweek;
        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;
        return $this;
    }

    public function addLike(User $user): void
    {
        if (!$this->likes->contains($user)) {
            $this->likes->add($user);
        }
    }

    public function removeLike(User $user): void
    {
        $this->likes->removeElement($user);
    }

    public function isLikedBy(User $user): bool
    {
        return $this->likes->contains($user);
    }

    public function getLikes(): Collection
    {
        return $this->likes;
    }
}
