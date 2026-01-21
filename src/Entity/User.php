<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
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

    #[ORM\Column(length: 255)]
    private ?string $MotDePasse = null;

    #[ORM\Column]
    private ?int $NombreFollowers = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];
    private ?int $NombreFollowing = null;

    #[ORM\Column(nullable: true)]
    private ?int $NombreKweeks = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?int $NombreKweeksLikes = null;
    private ?string $password = null;

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

    {
    }

    {

        return $this;
    }

    {
    }

    {

        return $this;
    }

    {

    }

    {
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
/**
 * A visual identifier that represents this user.
 *
 * @see UserInterface
 */
public function getUserIdentifier(): string
{
    return (string) $this->email;
}

/**
 * @see UserInterface
 */
public function getRoles(): array
{
    $roles = $this->roles;
    // guarantee every user at least has ROLE_USER
    $roles[] = 'ROLE_USER';

    return array_unique($roles);
}

/**
 * @param list<string> $roles
 */
public function setRoles(array $roles): static
{
    $this->roles = $roles;

    return $this;
}

/**
 * @see PasswordAuthenticatedUserInterface
 */
public function getPassword(): ?string
{
    return $this->password;
}

public function setPassword(string $password): static
{
    $this->password = $password;

    return $this;
}

/**
 * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
 */
public function __serialize(): array
{
    $data = (array) $this;
    $data["\0".self::class."\0password"] = hash('crc32c', $this->password);

    return $data;
}

#[\Deprecated]
    public function eraseCredentials(): void
{
    // @deprecated, to be removed when upgrading to Symfony 8
}



}
