<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UsersRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:User']]
)]
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:User','read:Program'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:User' , 'read:Program'])]
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:User'])]
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:User'])]
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:User'])]
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity=Program::class, mappedBy="favorite")
     * @ORM\JoinTable(name="fav")
     */
    #[Groups(['read:User'])]
    private $programs;

    public function __construct()
    {
        $this->programs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->programs->contains($program)) {
            $this->programs[] = $program;
            $program->addFavorite($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        if ($this->programs->removeElement($program)) {
            $program->removeFavorite($this);
        }

        return $this;
    }
}
