<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Collection;

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

    /**
     * @var \Doctrine\Common\Collections\Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'post', orphanRemoval: true)]
    private \Doctrine\Common\Collections\Collection $comments;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

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

    public function getLikes()
    {
        return $this->likes;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection<int, Comment>
     */
    public function getComments(): \Doctrine\Common\Collections\Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }
}
