<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bio = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?int $NombreFollowers = 0;

    #[ORM\Column(options: ["default" => 0])]
    private ?int $NombreFollowing = 0;

    #[ORM\Column(nullable: true)]
    private ?int $NombreKweeks = 0;

    #[ORM\Column(options: ["default" => 0])]
    private ?int $NombreKweeksLikes = 0;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
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

    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // Nettoyage des données sensibles temporaires si nécessaire
    }


    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'followers')]
    private Collection $following;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'following')]
    private Collection $followers;


    public function __construct()
    {
        $this->following = new ArrayCollection();
        $this->followers = new ArrayCollection();
    }

    public function follow(User $user): void
    {
        if (!$this->following->contains($user)) {
            $this->following->add($user);
        }
    }

    public function unfollow(User $user): void
    {
        if ($this->following->contains($user)) {
            $this->following->removeElement($user);
        }
    }

    public function isFollowing(User $user): bool
    {
        return $this->following->contains($user);
    }

}
