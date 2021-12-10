<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Program::class, inversedBy="categories")
     * @ORM\JoinTable(name="belong")
     */
    private $belong;

    public function __construct()
    {
        $this->belong = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getBelong(): Collection
    {
        return $this->belong;
    }

    public function addBelong(Program $belong): self
    {
        if (!$this->belong->contains($belong)) {
            $this->belong[] = $belong;
        }

        return $this;
    }

    public function removeBelong(Program $belong): self
    {
        $this->belong->removeElement($belong);

        return $this;
    }
}
